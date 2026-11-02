<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Moves media inserted through the admin editor from the old
 * /storage/admin/tinymce/ path to the site root, so images are served as
 * https://therigidboxes.com/<image-name>.webp. Updates every link to it in
 * saved content and fills in alt text for the known blog images that have none.
 *
 * Old files are left in place, so URLs already indexed keep working.
 * Safe to run more than once.
 *
 * Run with:  php artisan db:seed --class=Database\\Seeders\\EditorMediaUrlSeeder
 */
class EditorMediaUrlSeeder extends Seeder
{
    /** Alt text for images already used in blog posts (new filename => alt). */
    private $altText = [
        'anatomy-of-a-rigid-box-packaging-components.webp' => 'Anatomy of a rigid box showing its packaging components',
        'rigid-box-packaging-manufacturing.webp' => 'Rigid box packaging manufacturing process',
        'rigid-boxes-vs-other-types-of-packaging.webp' => 'Rigid boxes compared with other types of packaging',
    ];

    /** Columns that can hold editor HTML (table => columns). */
    private $columns = [
        'admin_blogs' => ['content', 'excerpt'],
        'admin_products' => ['description', 'long_description'],
        'admin_categories' => ['description', 'hero_description', 'products_description', 'why_choose_description'],
        'admin_pages' => ['content'],
        'homepage_contents' => ['value'],
    ];

    /**
     * Folders that may hold editor media: [where, folder, URL prefix in content].
     * "disk" is the public storage disk; "public" is the public/ directory.
     */
    private const SOURCES = [
        ['disk', 'admin/tinymce', 'storage/admin/tinymce/'],
        ['public', 'uploads/images', 'uploads/images/'],
        ['public', 'uploads/videos', 'uploads/videos/'],
    ];

    public function run(): void
    {
        $moved = 0;
        $linksUpdated = 0;
        $found = false;

        foreach (self::SOURCES as [$where, $dir, $urlPrefix]) {
            $oldDir = $where === 'disk' ? Storage::disk('public')->path($dir) : public_path($dir);
            if (!is_dir($oldDir)) {
                continue;
            }
            $found = true;

            foreach (scandir($oldDir) as $oldName) {
                $oldFile = $oldDir . DIRECTORY_SEPARATOR . $oldName;
                if (!is_file($oldFile)) {
                    continue;
                }

                $extension = strtolower(pathinfo($oldName, PATHINFO_EXTENSION));
                $newName = $this->targetName($oldFile, $oldName, $extension);
                $newFile = public_path($newName);

                if (!is_file($newFile)) {
                    if (!copy($oldFile, $newFile)) {
                        $this->command->warn("Could not copy {$oldName}; its links were left unchanged.");
                        continue;
                    }
                    $moved++;
                }

                // Content may hold the name as typed or URL-encoded (spaces as %20).
                foreach (array_unique([$oldName, rawurlencode($oldName), str_replace(' ', '%20', $oldName)]) as $variant) {
                    $linksUpdated += $this->replaceEverywhere($urlPrefix . $variant, $newName);
                }
            }
        }

        if (!$found) {
            $this->command->line('No old editor media folders here; nothing to move.');
        }

        $altsSet = $this->fillMissingAltText();

        $this->command->info("EditorMediaUrlSeeder: copied {$moved} file(s) to the site root, updated {$linksUpdated} content field(s), set alt text on {$altsSet} image(s).");
    }

    /** A clean, unique name in the site root; reuses an identical file already there. */
    private function targetName(string $oldFile, string $oldName, string $extension): string
    {
        $base = Str::slug(pathinfo($oldName, PATHINFO_FILENAME)) ?: 'image';
        $name = $base . '.' . $extension;

        for ($i = 2; is_file(public_path($name)); $i++) {
            if (md5_file(public_path($name)) === md5_file($oldFile)) {
                return $name;
            }
            $name = $base . '-' . $i . '.' . $extension;
        }

        return $name;
    }

    /** Replaces $old with $new in every content column; returns rows changed. */
    private function replaceEverywhere(string $old, string $new): int
    {
        $changed = 0;
        foreach ($this->columns as $table => $columns) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            foreach ($columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }
                $changed += DB::update(
                    "UPDATE `{$table}` SET `{$column}` = REPLACE(`{$column}`, ?, ?) WHERE `{$column}` LIKE ?",
                    [$old, $new, '%' . $old . '%']
                );
            }
        }

        return $changed;
    }

    /** Sets alt text on the known images where it is missing or empty. */
    private function fillMissingAltText(): int
    {
        $count = 0;

        foreach ($this->columns as $table => $columns) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                DB::table($table)->where($column, 'like', '%<img%')->get(['id', $column])->each(function ($row) use ($table, $column, &$count) {
                    $html = (string) $row->{$column};

                    $updated = preg_replace_callback('/<img\b[^>]*>/i', function ($match) use (&$count) {
                        $tag = $match[0];
                        if (!preg_match('/\ssrc="([^"]+)"/i', $tag, $src)) {
                            return $tag;
                        }
                        $file = basename(parse_url($src[1], PHP_URL_PATH) ?: '');
                        if (!isset($this->altText[$file])) {
                            return $tag;
                        }

                        $alt = e($this->altText[$file]);
                        if (preg_match('/\salt="\s*"/i', $tag)) {
                            $count++;
                            return preg_replace('/\salt="\s*"/i', ' alt="' . $alt . '"', $tag, 1);
                        }
                        if (!preg_match('/\salt=/i', $tag)) {
                            $count++;
                            return preg_replace('/^<img\b/i', '<img alt="' . $alt . '"', $tag, 1);
                        }

                        return $tag; // Already has real alt text: keep it.
                    }, $html);

                    if ($updated !== $html) {
                        DB::table($table)->where('id', $row->id)->update([$column => $updated]);
                    }
                });
            }
        }

        return $count;
    }
}
