<?php

namespace App\Http\Controllers;

use App\Support\RedirectManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRedirectController extends Controller
{
    public function index()
    {
        RedirectManager::ensureTable();

        $redirects = DB::table('admin_redirects')
            ->orderByDesc('id')
            ->get()
            ->map(fn ($r) => (array) $r)
            ->all();

        $stats = [
            'total' => count($redirects),
            'active' => count(array_filter($redirects, fn ($r) => !empty($r['is_active']))),
            'permanent' => count(array_filter($redirects, fn ($r) => in_array((int) $r['status_code'], [301, 308], true))),
            'temporary_or_gone' => count(array_filter($redirects, fn ($r) => in_array((int) $r['status_code'], [302, 307, 410, 404], true))),
            'hits' => array_sum(array_map(fn ($r) => (int) ($r['hits'] ?? 0), $redirects)),
        ];

        return view('admin.redirects.index', [
            'redirects' => $redirects,
            'stats' => $stats,
            'statusCodes' => RedirectManager::STATUS_CODES,
            'matchTypes' => RedirectManager::MATCH_TYPES,
        ]);
    }

    public function store(Request $request)
    {
        RedirectManager::ensureTable();

        $request->validate([
            'source_url' => 'required|string|max:500',
            'target_url' => 'nullable|string|max:500',
            'status_code' => 'required|integer',
            'match_type' => 'required|string|in:exact,prefix,regex',
            'notes' => 'nullable|string|max:1000',
        ]);

        $matchType = (string) $request->input('match_type', 'exact');
        $statusCode = (int) $request->input('status_code', 301);
        $sourceUrl = RedirectManager::normalizeSource((string) $request->input('source_url'), $matchType);

        if ($matchType === 'prefix' && $sourceUrl !== '' && strpos($sourceUrl, '*') === false) {
            $sourceUrl = rtrim($sourceUrl, '/') . '/*';
        }

        $targetUrl = RedirectManager::normalizeTarget($request->input('target_url'), $statusCode);

        $error = RedirectManager::validateRule($sourceUrl, $targetUrl, $statusCode, $matchType);
        if ($error !== null) {
            return back()->withInput()->withErrors(['redirect' => $error]);
        }

        DB::table('admin_redirects')->insert([
            'source_url' => $sourceUrl,
            'target_url' => $targetUrl,
            'status_code' => $statusCode,
            'match_type' => $matchType,
            'is_active' => $request->boolean('is_active', true),
            'preserve_query' => $request->boolean('preserve_query', true),
            'notes' => trim((string) $request->input('notes', '')) ?: null,
            'hits' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        RedirectManager::syncCache();

        return redirect()->route('admin.redirects.index')->with('success', 'Redirection rule created and activated.');
    }

    public function update(Request $request, int $id)
    {
        RedirectManager::ensureTable();

        $existing = DB::table('admin_redirects')->where('id', $id)->first();
        abort_unless($existing, 404);

        $request->validate([
            'source_url' => 'required|string|max:500',
            'target_url' => 'nullable|string|max:500',
            'status_code' => 'required|integer',
            'match_type' => 'required|string|in:exact,prefix,regex',
            'notes' => 'nullable|string|max:1000',
        ]);

        $matchType = (string) $request->input('match_type', 'exact');
        $statusCode = (int) $request->input('status_code', 301);
        $sourceUrl = RedirectManager::normalizeSource((string) $request->input('source_url'), $matchType);

        if ($matchType === 'prefix' && $sourceUrl !== '' && strpos($sourceUrl, '*') === false) {
            $sourceUrl = rtrim($sourceUrl, '/') . '/*';
        }

        $targetUrl = RedirectManager::normalizeTarget($request->input('target_url'), $statusCode);

        $error = RedirectManager::validateRule($sourceUrl, $targetUrl, $statusCode, $matchType, $id);
        if ($error !== null) {
            return back()->withInput()->with('edit_id', $id)->withErrors(['redirect' => $error]);
        }

        DB::table('admin_redirects')->where('id', $id)->update([
            'source_url' => $sourceUrl,
            'target_url' => $targetUrl,
            'status_code' => $statusCode,
            'match_type' => $matchType,
            'is_active' => $request->boolean('is_active'),
            'preserve_query' => $request->boolean('preserve_query'),
            'notes' => trim((string) $request->input('notes', '')) ?: null,
            'updated_at' => now(),
        ]);

        RedirectManager::syncCache();

        return redirect()->route('admin.redirects.index')->with('success', 'Redirection rule updated successfully.');
    }

    public function toggle(Request $request, int $id)
    {
        RedirectManager::ensureTable();

        $existing = DB::table('admin_redirects')->where('id', $id)->first();
        abort_unless($existing, 404);

        $newState = !$existing->is_active;

        DB::table('admin_redirects')->where('id', $id)->update([
            'is_active' => $newState,
            'updated_at' => now(),
        ]);

        RedirectManager::syncCache();

        if ($request->expectsJson()) {
            return response()->json(['ok' => true, 'is_active' => $newState]);
        }

        return redirect()->route('admin.redirects.index')->with(
            'success',
            $newState ? 'Redirection enabled.' : 'Redirection paused.'
        );
    }

    public function destroy(int $id)
    {
        RedirectManager::ensureTable();

        DB::table('admin_redirects')->where('id', $id)->delete();
        RedirectManager::syncCache();

        return redirect()->route('admin.redirects.index')->with('success', 'Redirection rule deleted.');
    }

    public function bulkAction(Request $request)
    {
        RedirectManager::ensureTable();

        $ids = array_values(array_filter(array_map('intval', (array) $request->input('ids', []))));
        $action = (string) $request->input('bulk_action', '');

        if (empty($ids)) {
            return back()->withErrors(['redirect' => 'Please select at least one redirection rule.']);
        }

        if ($action === 'enable') {
            DB::table('admin_redirects')->whereIn('id', $ids)->update(['is_active' => true, 'updated_at' => now()]);
            $msg = count($ids) . ' redirection(s) enabled.';
        } elseif ($action === 'pause') {
            DB::table('admin_redirects')->whereIn('id', $ids)->update(['is_active' => false, 'updated_at' => now()]);
            $msg = count($ids) . ' redirection(s) paused.';
        } elseif ($action === 'delete') {
            DB::table('admin_redirects')->whereIn('id', $ids)->delete();
            $msg = count($ids) . ' redirection(s) deleted.';
        } else {
            return back()->withErrors(['redirect' => 'Invalid bulk action selected.']);
        }

        RedirectManager::syncCache();

        return redirect()->route('admin.redirects.index')->with('success', $msg);
    }

    public function bulkImport(Request $request)
    {
        RedirectManager::ensureTable();

        $request->validate([
            'bulk_lines' => 'required|string',
            'default_status' => 'required|integer|in:301,302,307,308,410,404',
        ]);

        $defaultStatus = (int) $request->input('default_status', 301);
        $overwriteExisting = $request->boolean('overwrite_existing');
        $parsed = RedirectManager::parseBulkLines((string) $request->input('bulk_lines'), $defaultStatus);

        if (empty($parsed)) {
            return back()->withErrors(['redirect' => 'No valid redirection lines were found in your input.']);
        }

        $existingRules = DB::table('admin_redirects')->get()->map(fn ($r) => (array) $r)->all();
        $added = 0;
        $updated = 0;
        $skipped = [];

        foreach ($parsed as $row) {
            $source = $row['source_url'];
            $target = $row['target_url'];
            $status = $row['status_code'];
            $type = $row['match_type'];

            $matchedExisting = null;
            foreach ($existingRules as $ex) {
                if (
                    ($ex['match_type'] ?? 'exact') === $type
                    && strcasecmp(rtrim((string) $ex['source_url'], '/'), rtrim($source, '/')) === 0
                ) {
                    $matchedExisting = $ex;
                    break;
                }
            }

            if ($matchedExisting !== null && $overwriteExisting) {
                $err = RedirectManager::validateRule($source, $target, $status, $type, (int) $matchedExisting['id'], $existingRules);
                if ($err !== null) {
                    $skipped[] = "Line {$row['line']}: {$err}";
                    continue;
                }

                DB::table('admin_redirects')->where('id', $matchedExisting['id'])->update([
                    'source_url' => $source,
                    'target_url' => $target,
                    'status_code' => $status,
                    'match_type' => $type,
                    'is_active' => true,
                    'updated_at' => now(),
                ]);
                $updated++;
                continue;
            }

            $err = RedirectManager::validateRule($source, $target, $status, $type, null, $existingRules);
            if ($err !== null) {
                $skipped[] = "Line {$row['line']}: {$err}";
                continue;
            }

            $newId = DB::table('admin_redirects')->insertGetId([
                'source_url' => $source,
                'target_url' => $target,
                'status_code' => $status,
                'match_type' => $type,
                'is_active' => true,
                'preserve_query' => true,
                'hits' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $existingRules[] = [
                'id' => $newId,
                'source_url' => $source,
                'target_url' => $target,
                'status_code' => $status,
                'match_type' => $type,
                'is_active' => true,
            ];
            $added++;
        }

        RedirectManager::syncCache();

        $summary = "Bulk import complete: {$added} added, {$updated} updated.";
        if (!empty($skipped)) {
            $summary .= ' Skipped ' . count($skipped) . ': ' . implode(' | ', array_slice($skipped, 0, 3));
        }

        return redirect()->route('admin.redirects.index')->with('success', $summary);
    }

    public function testUrl(Request $request)
    {
        RedirectManager::ensureTable();

        $raw = trim((string) $request->input('test_url', ''));
        if ($raw === '') {
            return response()->json(['matched' => false, 'message' => 'Enter a URL or path to test.']);
        }

        $testPath = RedirectManager::normalizeSource($raw, 'exact');
        $fakeRequest = Request::create($testPath, 'GET');

        $activeRules = RedirectManager::syncCache();
        $match = RedirectManager::matchRequest($fakeRequest, $activeRules);

        if ($match === null) {
            // Also check if an inactive rule matches so SEO knows it's paused
            $allRules = DB::table('admin_redirects')->get()->map(fn ($r) => (array) $r)->all();
            $forcedRules = array_map(function ($r) {
                $r['is_active'] = true;
                return $r;
            }, $allRules);
            $pausedMatch = RedirectManager::matchRequest($fakeRequest, $forcedRules);

            if ($pausedMatch !== null) {
                return response()->json([
                    'matched' => false,
                    'paused_match' => true,
                    'message' => 'Matches a PAUSED rule (#' . ($pausedMatch['id'] ?? '') . '). Enable it to activate.',
                ]);
            }

            return response()->json([
                'matched' => false,
                'message' => 'No active redirection rule matches "' . $testPath . '". It will load normally.',
            ]);
        }

        return response()->json([
            'matched' => true,
            'rule_id' => $match['id'],
            'status_code' => $match['status_code'],
            'location' => $match['location'],
            'match_type' => $match['rule']['match_type'] ?? 'exact',
            'source_url' => $match['rule']['source_url'] ?? '',
        ]);
    }

    public function exportCsv()
    {
        RedirectManager::ensureTable();

        $rows = DB::table('admin_redirects')->orderByDesc('id')->get();
        $filename = 'therigidboxes-redirections-' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Source URL', 'Target URL', 'Status Code', 'Match Type', 'Active', 'Preserve Query', 'Hits', 'Last Hit At', 'Notes']);
            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->id,
                    $r->source_url,
                    $r->target_url,
                    $r->status_code,
                    $r->match_type,
                    $r->is_active ? 'Yes' : 'No',
                    $r->preserve_query ? 'Yes' : 'No',
                    $r->hits,
                    $r->last_hit_at,
                    $r->notes,
                ]);
            }
            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
