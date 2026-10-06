<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class QuoteProductOptions
{
    /**
     * Return one de-duplicated list for every quote-form Box Style field.
     * The imported names are quote options only; they do not create pages.
     */
    public function all(): Collection
    {
        static $options;

        if ($options instanceof Collection) {
            return $options;
        }

        $path = resource_path('data/quote-product-options.json');
        $imported = File::exists($path)
            ? json_decode(File::get($path), true)
            : [];

        $siteProducts = DB::table('admin_products')
            ->where('status', 'published')
            ->pluck('title')
            ->all();

        return $options = collect(array_merge($siteProducts, is_array($imported) ? $imported : []))
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->unique(fn ($name) => Str::lower(preg_replace('/[^a-z0-9]+/i', '', $name)))
            ->sort(SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
    }
}
