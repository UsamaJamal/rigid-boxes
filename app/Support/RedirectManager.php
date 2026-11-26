<?php

namespace App\Support;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RedirectManager
{
    public const STATUS_CODES = [
        301 => '301 — Permanent Redirect (SEO)',
        302 => '302 — Temporary Redirect',
        307 => '307 — Temporary Redirect (Keep Method)',
        308 => '308 — Permanent Redirect (Keep Method)',
        410 => '410 — Gone (Page Permanently Removed)',
        404 => '404 — Not Found',
    ];

    public const MATCH_TYPES = [
        'exact' => 'Exact URL Match',
        'prefix' => 'Wildcard / Prefix (*)',
        'regex' => 'Regex Pattern',
    ];

    public const NO_TARGET_STATUSES = [410, 404];

    public static function cachePath(): string
    {
        return storage_path('app/seo-redirects.json');
    }

    public static function ensureTable(): void
    {
        try {
            if (!Schema::hasTable('admin_redirects')) {
                Schema::create('admin_redirects', function (Blueprint $table) {
                    $table->id();
                    $table->string('source_url', 500)->index();
                    $table->string('target_url', 500)->nullable();
                    $table->unsignedSmallInteger('status_code')->default(301);
                    $table->string('match_type', 20)->default('exact');
                    $table->boolean('is_active')->default(true);
                    $table->boolean('preserve_query')->default(true);
                    $table->unsignedBigInteger('hits')->default(0);
                    $table->timestamp('last_hit_at')->nullable();
                    $table->text('notes')->nullable();
                    $table->timestamps();
                });
            }
        } catch (\Throwable $e) {
            // Defer cleanly if DB is temporarily unreachable
        }
    }

    public static function getCachedRules(): array
    {
        $path = self::cachePath();
        if (is_file($path)) {
            $raw = @file_get_contents($path);
            if ($raw !== false) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            }
        }

        try {
            if (Schema::hasTable('admin_redirects')) {
                return self::syncCache();
            }
        } catch (\Throwable $e) {
            // Never allow redirect lookup failure to crash public pages
        }

        return [];
    }

    public static function syncCache(): array
    {
        try {
            if (!Schema::hasTable('admin_redirects')) {
                return [];
            }

            $rules = DB::table('admin_redirects')
                ->where('is_active', 1)
                ->orderBy('id')
                ->get()
                ->map(fn ($row) => [
                    'id' => (int) $row->id,
                    'source_url' => (string) $row->source_url,
                    'target_url' => $row->target_url !== null ? (string) $row->target_url : null,
                    'status_code' => (int) $row->status_code,
                    'match_type' => (string) $row->match_type,
                    'is_active' => (bool) $row->is_active,
                    'preserve_query' => (bool) $row->preserve_query,
                ])
                ->all();

            $cacheFile = self::cachePath();
            $dir = dirname($cacheFile);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @file_put_contents($cacheFile, json_encode($rules, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX);

            return $rules;
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function normalizeSource(string $raw, string $matchType = 'exact'): string
    {
        $raw = trim($raw);
        if ($raw === '') {
            return '';
        }

        if ($matchType === 'regex') {
            return $raw;
        }

        if (preg_match('#^https?://#i', $raw)) {
            $parsed = parse_url($raw);
            $path = $parsed['path'] ?? '/';
            $query = isset($parsed['query']) && $parsed['query'] !== '' ? '?' . $parsed['query'] : '';
            $raw = $path . $query;
        }

        if (strpos($raw, '?') === 0) {
            $raw = '/' . $raw;
        } elseif (strpos($raw, '/') !== 0) {
            $raw = '/' . $raw;
        }

        $parts = explode('?', $raw, 2);
        $pathPart = preg_replace('#/+#', '/', $parts[0]);
        if ($pathPart === '') {
            $pathPart = '/';
        }

        return isset($parts[1]) && $parts[1] !== ''
            ? $pathPart . '?' . $parts[1]
            : $pathPart;
    }

    public static function normalizeTarget(?string $raw, int $statusCode): ?string
    {
        if (in_array($statusCode, self::NO_TARGET_STATUSES, true)) {
            return null;
        }

        $raw = trim((string) $raw);
        if ($raw === '') {
            return null;
        }

        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }

        if (strpos($raw, '/') !== 0) {
            $raw = '/' . $raw;
        }

        return $raw;
    }

    public static function compileRegex(string $pattern): string
    {
        $pattern = trim($pattern);
        if ($pattern === '') {
            return '~^$~';
        }

        if (strlen($pattern) >= 2 && $pattern[0] === '~' && preg_match('/~[imsuxADSUXJ]*$/', $pattern)) {
            return $pattern;
        }

        $escaped = str_replace('~', '\~', $pattern);
        return '~' . $escaped . '~i';
    }

    public static function isValidRegex(string $pattern): bool
    {
        $compiled = self::compileRegex($pattern);
        return @preg_match($compiled, '') !== false;
    }

    public static function isProtectedSource(string $source, string $matchType): bool
    {
        if ($matchType === 'regex') {
            $compiled = self::compileRegex($source);
            if (@preg_match($compiled, '') === false) {
                return false;
            }
            return @preg_match($compiled, '/') === 1
                || @preg_match($compiled, '/admin') === 1
                || @preg_match($compiled, '/admin/redirects') === 1;
        }

        $pathOnly = explode('?', $source, 2)[0];
        if ($pathOnly === '/' && strpos($source, '?') === false) {
            return true;
        }

        $trimmed = rtrim(strtolower($pathOnly), '/');
        if ($trimmed === '/admin' || strpos($trimmed, '/admin/') === 0) {
            return true;
        }
        if (strpos($trimmed, '/submit-') === 0 || strpos($trimmed, '/human-check') === 0) {
            return true;
        }
        if ($matchType === 'prefix') {
            $prefixBase = rtrim(str_replace('*', '', $trimmed), '/');
            if ($prefixBase === '' || $prefixBase === '/admin') {
                return true;
            }
        }

        return false;
    }

    public static function validateRule(
        string $source,
        ?string $target,
        int $statusCode,
        string $matchType,
        ?int $ignoreId = null,
        ?array $existingRules = null
    ): ?string {
        if (!array_key_exists($statusCode, self::STATUS_CODES)) {
            return 'Please select a valid HTTP status code (301, 302, 307, 308, 410, or 404).';
        }

        if (!array_key_exists($matchType, self::MATCH_TYPES)) {
            return 'Please select a valid match type.';
        }

        if ($source === '') {
            return 'Source URL is required.';
        }

        if ($matchType === 'regex' && !self::isValidRegex($source)) {
            return 'The Regex pattern is invalid. Please check your expression syntax.';
        }

        if ($matchType === 'prefix' && strpos($source, '*') === false) {
            // Auto-append * only via UI/controller or warn here
            return 'Wildcard / Prefix source URL must contain an asterisk (*), e.g. /old-category/*.';
        }

        if (self::isProtectedSource($source, $matchType)) {
            return 'Protected system paths (like homepage "/", "/admin", or "/submit-*") cannot be redirected.';
        }

        if (!in_array($statusCode, self::NO_TARGET_STATUSES, true)) {
            if ($target === null || $target === '') {
                return 'Target URL is required for redirect status codes (301, 302, 307, 308).';
            }

            if (!preg_match('#^(https?://|/)#i', $target)) {
                return 'Target URL must start with "/" (internal path) or "https://" (external URL).';
            }

            if ($matchType === 'exact') {
                $comparableTarget = self::extractComparablePath($target);
                $comparableSource = self::extractComparablePath($source);
                if ($comparableTarget !== null && strcasecmp($comparableTarget, $comparableSource) === 0) {
                    return 'Source URL and Target URL cannot point to the same URL (self-redirect loop).';
                }
            }
        }

        $rules = $existingRules;
        if ($rules === null) {
            try {
                if (Schema::hasTable('admin_redirects')) {
                    $rules = DB::table('admin_redirects')->get()->map(fn ($r) => (array) $r)->all();
                } else {
                    $rules = [];
                }
            } catch (\Throwable $e) {
                $rules = [];
            }
        }

        foreach ($rules as $rule) {
            if ($ignoreId !== null && (int) ($rule['id'] ?? 0) === $ignoreId) {
                continue;
            }

            $existingSource = (string) ($rule['source_url'] ?? '');
            $existingType = (string) ($rule['match_type'] ?? 'exact');

            if ($existingType === $matchType) {
                $same = $matchType === 'regex'
                    ? $existingSource === $source
                    : strcasecmp(self::stripTrailingSlashKeepRoot($existingSource), self::stripTrailingSlashKeepRoot($source)) === 0;

                if ($same) {
                    return 'A redirection rule for this Source URL ("' . $source . '") already exists.';
                }
            }

            // Detect direct 2-step circular redirect (A -> B and B -> A)
            if (
                $matchType === 'exact'
                && $existingType === 'exact'
                && !empty($rule['is_active'])
                && $target !== null
                && !empty($rule['target_url'])
            ) {
                $existingTargetComp = self::extractComparablePath((string) $rule['target_url']);
                $newSourceComp = self::extractComparablePath($source);
                $existingSourceComp = self::extractComparablePath($existingSource);
                $newTargetComp = self::extractComparablePath($target);

                if (
                    $existingTargetComp !== null
                    && $newTargetComp !== null
                    && strcasecmp($existingTargetComp, $newSourceComp) === 0
                    && strcasecmp($existingSourceComp, $newTargetComp) === 0
                ) {
                    return 'Circular redirect detected: "' . $existingSource . '" already redirects to "' . $source . '".';
                }
            }
        }

        return null;
    }

    private static function stripTrailingSlashKeepRoot(string $url): string
    {
        $parts = explode('?', $url, 2);
        $path = $parts[0] === '/' ? '/' : rtrim($parts[0], '/');
        if ($path === '') {
            $path = '/';
        }
        return isset($parts[1]) ? $path . '?' . $parts[1] : $path;
    }

    private static function extractComparablePath(string $url): ?string
    {
        if (preg_match('#^https?://([^/]+)(.*)$#i', $url, $m)) {
            $host = strtolower($m[1]);
            $hostNoWww = preg_replace('/^www\./', '', $host);
            $siteHost = strtolower((string) (parse_url((string) config('app.url'), PHP_URL_HOST) ?: 'therigidboxes.com'));
            $siteHostNoWww = preg_replace('/^www\./', '', $siteHost);

            if ($hostNoWww !== $siteHostNoWww && $hostNoWww !== 'therigidboxes.com') {
                return null; // External domain cannot self-loop locally
            }
            $url = $m[2] !== '' ? $m[2] : '/';
        }

        return self::stripTrailingSlashKeepRoot($url);
    }

    public static function matchRequest(Request $request, ?array $rules = null): ?array
    {
        if (!in_array($request->method(), ['GET', 'HEAD'], true)) {
            return null;
        }

        $rawUri = $request->getRequestUri();
        $path = parse_url($rawUri, PHP_URL_PATH) ?: '/';
        $query = (string) (parse_url($rawUri, PHP_URL_QUERY) ?? '');

        if (preg_match('#^/(?:admin|submit-|human-check)(?:/|$)#i', $path)) {
            return null;
        }

        $rules = $rules !== null ? $rules : self::getCachedRules();
        if (empty($rules)) {
            return null;
        }

        $activeRules = array_values(array_filter($rules, fn ($r) => !isset($r['is_active']) || (bool) $r['is_active']));

        // 1. Exact matches with explicit query string first
        foreach ($activeRules as $rule) {
            if (($rule['match_type'] ?? 'exact') !== 'exact') {
                continue;
            }
            $source = (string) ($rule['source_url'] ?? '');
            if (strpos($source, '?') === false) {
                continue;
            }

            list($srcPath, $srcQuery) = explode('?', $source, 2);
            if ($query !== '' && strcasecmp($query, $srcQuery) === 0 && self::pathsMatch($path, $srcPath)) {
                return self::buildMatchResult($rule, $rule['target_url'] ?? null, $query, true);
            }
        }

        // 2. Exact matches on path
        foreach ($activeRules as $rule) {
            if (($rule['match_type'] ?? 'exact') !== 'exact') {
                continue;
            }
            $source = (string) ($rule['source_url'] ?? '');
            if (strpos($source, '?') !== false) {
                continue;
            }

            if (self::pathsMatch($path, $source)) {
                return self::buildMatchResult($rule, $rule['target_url'] ?? null, $query, false);
            }
        }

        // 3. Prefix / Wildcard matches (longest prefix first)
        $prefixRules = array_values(array_filter($activeRules, fn ($r) => ($r['match_type'] ?? '') === 'prefix'));
        usort($prefixRules, function ($a, $b) {
            return strlen((string) $b['source_url']) <=> strlen((string) $a['source_url']);
        });

        foreach ($prefixRules as $rule) {
            $source = (string) $rule['source_url'];
            $starPos = strpos($source, '*');
            $prefix = $starPos !== false ? substr($source, 0, $starPos) : $source;
            if ($prefix === '' || $prefix === '/') {
                continue;
            }

            // Match both "/old-cat/" and "/old-cat" when prefix is "/old-cat/"
            $matched = false;
            $rest = '';
            if (stripos($path, $prefix) === 0) {
                $matched = true;
                $rest = (string) substr($path, strlen($prefix));
            } elseif (substr($prefix, -1) === '/' && strcasecmp(rtrim($path, '/'), rtrim($prefix, '/')) === 0) {
                $matched = true;
                $rest = '';
            }

            if ($matched) {
                $target = $rule['target_url'] ?? null;
                if ($target !== null && strpos($target, '*') !== false) {
                    $target = str_replace('*', ltrim($rest, '/'), $target);
                }
                return self::buildMatchResult($rule, $target, $query, false);
            }
        }

        // 4. Regex matches
        foreach ($activeRules as $rule) {
            if (($rule['match_type'] ?? '') !== 'regex') {
                continue;
            }
            $pattern = (string) ($rule['source_url'] ?? '');
            $compiled = self::compileRegex($pattern);
            if (@preg_match($compiled, '') === false) {
                continue;
            }

            $matchesQuery = strpos($pattern, '\?') !== false;
            $subject = $matchesQuery && $query !== ''
                ? $path . '?' . $query
                : $path;

            if (@preg_match($compiled, $subject, $matches) === 1) {
                $target = $rule['target_url'] ?? null;
                if ($target !== null) {
                    $target = preg_replace_callback('/(?:\$|\\\\)(\d+)/', function ($m) use ($matches) {
                        $idx = (int) $m[1];
                        return isset($matches[$idx]) ? $matches[$idx] : '';
                    }, $target);
                }
                return self::buildMatchResult($rule, $target, $query, $matchesQuery);
            }
        }

        return null;
    }

    private static function pathsMatch(string $incomingPath, string $rulePath): bool
    {
        if ($rulePath === '/') {
            return $incomingPath === '/';
        }

        if (strcasecmp($incomingPath, $rulePath) === 0) {
            return true;
        }

        // Ignore trailing slash mismatch unless either path explicitly has a file extension
        $incomingExt = pathinfo(rtrim($incomingPath, '/'), PATHINFO_EXTENSION);
        $ruleExt = pathinfo(rtrim($rulePath, '/'), PATHINFO_EXTENSION);
        if ($incomingExt === '' && $ruleExt === '') {
            return strcasecmp(rtrim($incomingPath, '/'), rtrim($rulePath, '/')) === 0;
        }

        return false;
    }

    private static function buildMatchResult(array $rule, ?string $target, string $incomingQuery, bool $sourceHadQuery): array
    {
        $statusCode = (int) ($rule['status_code'] ?? 301);
        $preserveQuery = !array_key_exists('preserve_query', $rule) || (bool) $rule['preserve_query'];

        if (in_array($statusCode, self::NO_TARGET_STATUSES, true) || $target === null || $target === '') {
            return [
                'id' => $rule['id'] ?? null,
                'status_code' => in_array($statusCode, self::NO_TARGET_STATUSES, true) ? $statusCode : 410,
                'location' => null,
                'rule' => $rule,
            ];
        }

        if ($preserveQuery && !$sourceHadQuery && $incomingQuery !== '') {
            $fragment = '';
            $hashPos = strpos($target, '#');
            if ($hashPos !== false) {
                $fragment = substr($target, $hashPos);
                $target = substr($target, 0, $hashPos);
            }
            $separator = strpos($target, '?') !== false ? '&' : '?';
            $target .= $separator . $incomingQuery . $fragment;
        }

        return [
            'id' => $rule['id'] ?? null,
            'status_code' => $statusCode,
            'location' => $target,
            'rule' => $rule,
        ];
    }

    public static function recordHit(?int $id): void
    {
        if (!$id) {
            return;
        }

        try {
            if (Schema::hasTable('admin_redirects')) {
                DB::table('admin_redirects')
                    ->where('id', $id)
                    ->update([
                        'hits' => DB::raw('hits + 1'),
                        'last_hit_at' => now(),
                    ]);
            }
        } catch (\Throwable $e) {
            // Do not interrupt redirect response if hit counter DB update fails
        }
    }

    public static function parseBulkLines(string $rawText, int $defaultStatus = 301): array
    {
        $lines = preg_split('/\r\n|\r|\n/', $rawText) ?: [];
        $parsed = [];

        foreach ($lines as $index => $line) {
            $lineNum = $index + 1;
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            $matchType = 'exact';
            $status = $defaultStatus;
            $source = '';
            $target = null;

            // Format 1: Apache .htaccess "Redirect 301 /old /new" or "RedirectMatch 301 ^/old /new"
            if (preg_match('/^Redirect(?:Match)?\s+(?:(301|302|307|308|410|404|permanent|temp|gone)\s+)?(\S+)(?:\s+(\S+))?$/i', $line, $m)) {
                $codeToken = strtolower((string) ($m[1] ?? ''));
                if ($codeToken === 'permanent') {
                    $status = 301;
                } elseif ($codeToken === 'temp') {
                    $status = 302;
                } elseif ($codeToken === 'gone') {
                    $status = 410;
                } elseif (is_numeric($codeToken)) {
                    $status = (int) $codeToken;
                }

                $source = $m[2];
                $target = $m[3] ?? null;
                if (stripos($line, 'RedirectMatch') === 0) {
                    $matchType = 'regex';
                } elseif (strpos($source, '*') !== false) {
                    $matchType = 'prefix';
                }
            } elseif (strpos($line, '->') !== false) {
                // Format 2: "/old -> /new" or "/old -> /new [301]"
                $parts = explode('->', $line, 2);
                $source = trim($parts[0]);
                $right = trim($parts[1]);
                if (preg_match('/^(\S+)\s*[\[(]?(301|302|307|308|410|404)[\])]?$/', $right, $rm)) {
                    $target = trim($rm[1]);
                    $status = (int) $rm[2];
                } else {
                    $target = $right;
                }
                if (strpos($source, '*') !== false) {
                    $matchType = 'prefix';
                }
            } else {
                // Format 3: CSV / Tab / Pipe: "source, target[, status[, match_type]]"
                $cols = str_getcsv($line);
                if (count($cols) === 1 && strpos($line, "\t") !== false) {
                    $cols = explode("\t", $line);
                } elseif (count($cols) === 1 && strpos($line, '|') !== false) {
                    $cols = explode('|', $line);
                }

                $source = trim((string) ($cols[0] ?? ''));
                $target = isset($cols[1]) ? trim((string) $cols[1]) : null;
                if (isset($cols[2]) && is_numeric(trim($cols[2])) && array_key_exists((int) trim($cols[2]), self::STATUS_CODES)) {
                    $status = (int) trim($cols[2]);
                }
                if (isset($cols[3]) && array_key_exists(strtolower(trim($cols[3])), self::MATCH_TYPES)) {
                    $matchType = strtolower(trim($cols[3]));
                } elseif (strpos($source, '*') !== false) {
                    $matchType = 'prefix';
                }
            }

            $parsed[] = [
                'line' => $lineNum,
                'source_url' => self::normalizeSource($source, $matchType),
                'target_url' => self::normalizeTarget($target, $status),
                'status_code' => $status,
                'match_type' => $matchType,
            ];
        }

        return $parsed;
    }
}
