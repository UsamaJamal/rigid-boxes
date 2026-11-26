@extends('admin.layout')
@section('title', 'Redirections')
@section('heading', 'Redirections')

@section('content')
<style>
    .redir-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; align-items: start; }
    .redir-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; align-items: start; margin-top: 16px; }
    .redir-field { display: flex; flex-direction: column; gap: 6px; }
    .redir-field label { font-size: 13px; font-weight: 700; color: var(--text); }
    .redir-field input, .redir-field select { height: 44px; padding: 0 13px; border: 1px solid #ddd8df; border-radius: 9px; background: #fff; font: inherit; color: var(--text); }
    .redir-field input:disabled { background: #f6f4f7; color: var(--muted); cursor: not-allowed; }
    .redir-badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 99px; font-size: 12px; font-weight: 700; }
    .redir-badge.code-301, .redir-badge.code-308 { background: #e8f7ee; color: #1f7a44; }
    .redir-badge.code-302, .redir-badge.code-307 { background: #fff6e5; color: #9c6500; }
    .redir-badge.code-410, .redir-badge.code-404 { background: #fdecec; color: #a52b2b; }
    .redir-type { display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; background: #f3f1f4; color: #5b5562; }
    .redir-type.prefix { background: #eef4ff; color: #2b59b5; }
    .redir-type.regex { background: #f5edff; color: #6e32b5; }
    .toggle-pill { border: 0; cursor: pointer; padding: 5px 11px; border-radius: 99px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; transition: .15s; }
    .toggle-pill.on { background: #eaf8ef; color: #287a45; }
    .toggle-pill.on:hover { background: #d6f1e0; }
    .toggle-pill.off { background: #f2f1f3; color: #77737c; }
    .toggle-pill.off:hover { background: #e5e3e7; }
    .url-cell { max-width: 300px; white-space: normal !important; word-break: break-word; }
    .url-text { font-size: 13.5px; font-weight: 600; color: var(--text); }
    .error-alert { padding: 12px 16px; border-radius: 10px; background: #fdecec; color: #9d2424; border: 1px solid #f6caca; margin-bottom: 18px; font-weight: 600; }
    .form-footer { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; padding: 16px 22px; background: #fbfafb; border-top: 1px solid var(--line); }
    .toolbar-row { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; justify-content: space-between; }
    .toolbar-filters { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .toolbar-filters input, .toolbar-filters select { width: auto; height: 40px; padding: 0 12px; font-size: 13px; }
    .test-result { margin-top: 10px; padding: 10px 14px; border-radius: 9px; font-size: 13px; font-weight: 600; display: none; }
    .test-result.hit { background: #eaf8ef; color: #1f6b3b; border: 1px solid #c3ebd1; display: block; }
    .test-result.miss { background: #f5f4f7; color: #524d58; border: 1px solid #e1dee6; display: block; }
    .test-result.warn { background: #fff6e5; color: #8c5a00; border: 1px solid #f4dfb3; display: block; }
    .modal-backdrop { position: fixed; inset: 0; background: rgba(20, 12, 15, .55); display: none; align-items: center; justify-content: center; z-index: 100; padding: 20px; }
    .modal-backdrop.open { display: flex; }
    .modal-card { background: #fff; border-radius: 16px; max-width: 620px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 24px 60px rgba(0, 0, 0, .25); }
    @media(max-width: 900px) {
        .redir-grid, .redir-grid-3 { grid-template-columns: 1fr; }
    }
</style>

@if($errors->any())
    <div class="error-alert">
        <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
    </div>
@endif

<!-- Summary Cards -->
<div class="grid">
    <div class="card stat">
        <div>
            <span style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Total Rules</span>
            <b style="margin-top:4px;line-height:1.1;">{{ $stats['total'] }}</b>
        </div>
        <div class="icon"><i class="fa-solid fa-route"></i></div>
    </div>
    <div class="card stat">
        <div>
            <span style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Active</span>
            <b style="margin-top:4px;line-height:1.1;color:#287a45;">{{ $stats['active'] }}</b>
        </div>
        <div class="icon" style="background:#eaf8ef;color:#287a45;"><i class="fa-solid fa-bolt"></i></div>
    </div>
    <div class="card stat">
        <div>
            <span style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">301 / 308 Rules</span>
            <b style="margin-top:4px;line-height:1.1;">{{ $stats['permanent'] }}</b>
        </div>
        <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
    </div>
    <div class="card stat">
        <div>
            <span style="font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">Total Hits</span>
            <b style="margin-top:4px;line-height:1.1;">{{ number_format($stats['hits']) }}</b>
        </div>
        <div class="icon"><i class="fa-solid fa-chart-line"></i></div>
    </div>
</div>

<!-- Add / Edit Redirection -->
<div class="panel" id="redirectFormPanel">
    <div class="panel-head">
        <h2 id="formHeading"><i class="fa-solid fa-plus-circle" style="color:var(--primary);margin-right:6px;"></i> Add Redirection</h2>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <button type="button" class="btn light" onclick="openBulkModal()"><i class="fa-solid fa-file-import"></i> Bulk Import</button>
            <a href="{{ route('admin.redirects.export') }}" class="btn light"><i class="fa-solid fa-file-export"></i> Export CSV</a>
            <button type="button" id="cancelEditBtn" class="btn danger" style="display:none;" onclick="resetRedirectForm()"><i class="fa-solid fa-xmark"></i> Cancel Edit</button>
        </div>
    </div>

    <form id="redirectForm" method="POST" action="{{ route('admin.redirects.store') }}">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">

        <div style="padding:22px;">
            <div class="redir-grid">
                <div class="redir-field">
                    <label for="source_url">Old / Source URL <span style="color:#b83232">*</span></label>
                    <input type="text" id="source_url" name="source_url" value="{{ old('source_url') }}" placeholder="/old-url/" required>
                </div>

                <div class="redir-field">
                    <label for="target_url">New / Target URL <span id="targetReqStar" style="color:#b83232">*</span></label>
                    <input type="text" id="target_url" name="target_url" value="{{ old('target_url') }}" placeholder="/new-url/">
                </div>
            </div>

            <div class="redir-grid-3">
                <div class="redir-field">
                    <label for="status_code">Status Code</label>
                    <select id="status_code" name="status_code" onchange="handleStatusChange()">
                        @foreach($statusCodes as $code => $label)
                            <option value="{{ $code }}" {{ (int) old('status_code', 301) === $code ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="redir-field">
                    <label for="match_type">Match Type</label>
                    <select id="match_type" name="match_type" onchange="handleMatchTypeChange()">
                        @foreach($matchTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('match_type', 'exact') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="redir-field">
                    <label for="notes">Note (Optional)</label>
                    <input type="text" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Reason or reference">
                </div>
            </div>
        </div>

        <div class="form-footer">
            <div class="checks">
                <label class="check">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                    <span>Active</span>
                </label>
                <label class="check">
                    <input type="hidden" name="preserve_query" value="0">
                    <input type="checkbox" id="preserve_query" name="preserve_query" value="1" {{ old('preserve_query', '1') ? 'checked' : '' }}>
                    <span>Preserve Query Params</span>
                </label>
            </div>
            <button type="submit" class="btn" id="submitBtn"><i class="fa-solid fa-check"></i> Save Redirection</button>
        </div>
    </form>
</div>

<!-- URL Tester -->
<div class="panel">
    <div class="panel-head">
        <h2><i class="fa-solid fa-flask" style="color:var(--primary);margin-right:6px;"></i> Test URL</h2>
    </div>
    <div style="padding:18px 22px;">
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <input type="text" id="testUrlInput" placeholder="/old-url/" style="flex:1;min-width:240px;height:44px;padding:0 13px;">
            <button type="button" class="btn" style="height:44px;" onclick="runUrlTest()"><i class="fa-solid fa-play"></i> Test</button>
        </div>
        <div id="testResultBox" class="test-result"></div>
    </div>
</div>

<!-- All Redirections Table -->
<div class="panel">
    <div class="panel-head" style="flex-direction:column;align-items:stretch;gap:14px;">
        <div class="toolbar-row">
            <h2>All Redirections ({{ count($redirects) }})</h2>
            <div class="toolbar-filters">
                <input type="text" id="searchInput" placeholder="Search..." style="min-width:200px;">
                <select id="statusFilter">
                    <option value="">All Status</option>
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="307">307</option>
                    <option value="308">308</option>
                    <option value="410">410</option>
                    <option value="404">404</option>
                </select>
                <select id="stateFilter">
                    <option value="">All States</option>
                    <option value="active">Active</option>
                    <option value="paused">Paused</option>
                </select>
            </div>
        </div>

        @if($redirects)
        <form id="bulkActionForm" method="POST" action="{{ route('admin.redirects.bulk') }}" style="display:none;align-items:center;gap:10px;padding:10px 14px;background:var(--soft);border-radius:10px;">
            @csrf
            <span id="selectedCountLabel" style="font-weight:700;color:var(--primary);font-size:13px;">0 selected</span>
            <select name="bulk_action" style="width:auto;height:36px;padding:0 10px;font-size:13px;">
                <option value="enable">Enable Selected</option>
                <option value="pause">Pause Selected</option>
                <option value="delete">Delete Selected</option>
            </select>
            <button type="submit" class="btn" style="padding:7px 14px;font-size:12px;" onclick="return confirmBulkAction()">Apply</button>
        </form>
        @endif
    </div>

    @if(!$redirects)
        <div class="empty">
            <i class="fa-solid fa-route" style="font-size:30px;color:#c9bfc4;margin-bottom:10px;"></i>
            <h3 style="margin:0 0 6px;">No redirections yet</h3>
            <p style="margin:0;">Add a rule above or use Bulk Import.</p>
        </div>
    @else
        <div class="table-wrap">
            <table id="redirectsTable">
                <thead>
                    <tr>
                        <th style="width:36px;"><input type="checkbox" id="selectAllCheckbox" style="width:auto;"></th>
                        <th>Source URL</th>
                        <th>Target URL</th>
                        <th>Status</th>
                        <th>State</th>
                        <th>Hits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($redirects as $r)
                    @php
                        $code = (int) $r['status_code'];
                        $type = $r['match_type'] ?? 'exact';
                        $isActive = !empty($r['is_active']);
                    @endphp
                    <tr class="redir-row"
                        data-search="{{ strtolower(($r['source_url'] ?? '') . ' ' . ($r['target_url'] ?? '') . ' ' . ($r['notes'] ?? '')) }}"
                        data-status="{{ $code }}"
                        data-state="{{ $isActive ? 'active' : 'paused' }}">
                        <td>
                            <input type="checkbox" class="row-check" value="{{ $r['id'] }}" style="width:auto;">
                        </td>
                        <td class="url-cell">
                            <div class="url-text">{{ $r['source_url'] }}</div>
                            <div style="margin-top:4px;display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
                                <span class="redir-type {{ $type }}">{{ $type }}</span>
                                @if(!empty($r['notes']))
                                    <span style="font-size:12px;color:var(--muted);">{{ $r['notes'] }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="url-cell">
                            @if(in_array($code, [410, 404], true) || empty($r['target_url']))
                                <span style="color:var(--muted);font-size:12.5px;">— ({{ $code }} Response)</span>
                            @else
                                <div class="url-text">{{ $r['target_url'] }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="redir-badge code-{{ $code }}">{{ $code }}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.redirects.toggle', $r['id']) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="toggle-pill {{ $isActive ? 'on' : 'off' }}">
                                    <i class="fa-solid {{ $isActive ? 'fa-circle-check' : 'fa-circle-pause' }}"></i>
                                    {{ $isActive ? 'Active' : 'Paused' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <strong>{{ number_format((int) ($r['hits'] ?? 0)) }}</strong>
                            @if(!empty($r['last_hit_at']))
                                <div style="font-size:11px;color:var(--muted);">{{ \Carbon\Carbon::parse($r['last_hit_at'])->diffForHumans() }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <button type="button" class="btn light" style="padding:7px 10px;font-size:12px;" title="Test"
                                    onclick='quickTestUrl(@json($r["source_url"]))'>
                                    <i class="fa-solid fa-play"></i>
                                </button>
                                <button type="button" class="btn light" style="padding:7px 11px;font-size:12px;"
                                    onclick='editRedirect(@json($r))'>
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                                <form method="POST" action="{{ route('admin.redirects.destroy', $r['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn danger" style="padding:7px 11px;font-size:12px;" onclick="return confirm('Delete this redirection rule?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="noFilterResults" style="display:none;padding:34px;text-align:center;color:var(--muted);">
                No matching redirection rules found.
            </div>
        </div>
    @endif
</div>

<!-- Bulk Import Modal -->
<div class="modal-backdrop" id="bulkImportModal">
    <div class="modal-card">
        <div class="panel-head">
            <h2>Bulk Import</h2>
            <button type="button" class="btn light" style="padding:6px 10px;" onclick="closeBulkModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form method="POST" action="{{ route('admin.redirects.import') }}">
            @csrf
            <div style="padding:20px 22px;display:grid;gap:14px;">
                <div class="redir-field">
                    <label for="bulk_lines">One rule per line (`/old-url/, /new-url/` or `Redirect 301 /old /new`)</label>
                    <textarea id="bulk_lines" name="bulk_lines" rows="8" required placeholder="/old-url/, /new-url/&#10;Redirect 301 /old-page/ /new-page/"></textarea>
                </div>

                <div class="redir-grid">
                    <div class="redir-field">
                        <label for="default_status">Default Status</label>
                        <select id="default_status" name="default_status">
                            @foreach($statusCodes as $code => $label)
                                <option value="{{ $code }}" {{ $code === 301 ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="redir-field" style="justify-content:flex-end;">
                        <label class="check" style="height:44px;">
                            <input type="checkbox" name="overwrite_existing" value="1">
                            <span>Update existing duplicates</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="actions" style="border-top:1px solid var(--line);">
                <button type="button" class="btn light" onclick="closeBulkModal()">Cancel</button>
                <button type="submit" class="btn"><i class="fa-solid fa-upload"></i> Import</button>
            </div>
        </form>
    </div>
</div>

<script>
    const storeUrl = @json(route('admin.redirects.store'));
    const updateUrlTemplate = @json(route('admin.redirects.update', ['id' => '__ID__']));
    const testUrlEndpoint = @json(route('admin.redirects.test'));

    function handleStatusChange() {
        const code = parseInt(document.getElementById('status_code').value, 10);
        const targetInput = document.getElementById('target_url');
        const targetStar = document.getElementById('targetReqStar');
        const noTarget = (code === 410 || code === 404);

        targetInput.disabled = noTarget;
        targetInput.required = !noTarget;
        targetStar.style.display = noTarget ? 'none' : 'inline';
        targetInput.placeholder = noTarget ? 'Not required for ' + code : '/new-url/';
    }

    function handleMatchTypeChange() {
        const type = document.getElementById('match_type').value;
        const src = document.getElementById('source_url');
        if (type === 'prefix') {
            src.placeholder = '/old-category/*';
        } else if (type === 'regex') {
            src.placeholder = '^/product/([a-z0-9-]+)/?$';
        } else {
            src.placeholder = '/old-url/';
        }
    }

    function editRedirect(rule) {
        document.getElementById('redirectForm').action = updateUrlTemplate.replace('__ID__', rule.id);
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('formHeading').innerHTML = '<i class="fa-solid fa-pen-to-square" style="color:var(--primary);margin-right:6px;"></i> Edit Redirection #' + rule.id;
        document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update Redirection';
        document.getElementById('cancelEditBtn').style.display = 'inline-flex';

        document.getElementById('source_url').value = rule.source_url || '';
        document.getElementById('target_url').value = rule.target_url || '';
        document.getElementById('status_code').value = rule.status_code || 301;
        document.getElementById('match_type').value = rule.match_type || 'exact';
        document.getElementById('notes').value = rule.notes || '';
        document.getElementById('is_active').checked = !!Number(rule.is_active);
        document.getElementById('preserve_query').checked = !!Number(rule.preserve_query);

        handleStatusChange();
        handleMatchTypeChange();
        document.getElementById('redirectFormPanel').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function resetRedirectForm() {
        document.getElementById('redirectForm').action = storeUrl;
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('formHeading').innerHTML = '<i class="fa-solid fa-plus-circle" style="color:var(--primary);margin-right:6px;"></i> Add Redirection';
        document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-check"></i> Save Redirection';
        document.getElementById('cancelEditBtn').style.display = 'none';

        document.getElementById('source_url').value = '';
        document.getElementById('target_url').value = '';
        document.getElementById('status_code').value = '301';
        document.getElementById('match_type').value = 'exact';
        document.getElementById('notes').value = '';
        document.getElementById('is_active').checked = true;
        document.getElementById('preserve_query').checked = true;

        handleStatusChange();
        handleMatchTypeChange();
    }

    function quickTestUrl(url) {
        const clean = url.replace(/\*.*$/, 'sample-page/');
        document.getElementById('testUrlInput').value = clean;
        runUrlTest();
        document.getElementById('testUrlInput').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    async function runUrlTest() {
        const input = document.getElementById('testUrlInput').value.trim();
        const box = document.getElementById('testResultBox');
        if (!input) {
            box.className = 'test-result warn';
            box.textContent = 'Enter a URL or path to test.';
            return;
        }

        box.className = 'test-result miss';
        box.textContent = 'Testing...';

        try {
            const resp = await fetch(testUrlEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ test_url: input })
            });
            const data = await resp.json();

            if (data.matched) {
                box.className = 'test-result hit';
                if (data.status_code === 410 || data.status_code === 404 || !data.location) {
                    box.textContent = 'Rule #' + data.rule_id + ' (' + data.match_type + ') -> HTTP ' + data.status_code;
                } else {
                    box.textContent = 'Rule #' + data.rule_id + ' (' + data.match_type + ') -> HTTP ' + data.status_code + ' -> ' + data.location;
                }
            } else if (data.paused_match) {
                box.className = 'test-result warn';
                box.textContent = data.message;
            } else {
                box.className = 'test-result miss';
                box.textContent = data.message || 'No matching rule found.';
            }
        } catch (err) {
            box.className = 'test-result warn';
            box.textContent = 'Failed to run test request.';
        }
    }

    function openBulkModal() {
        document.getElementById('bulkImportModal').classList.add('open');
    }

    function closeBulkModal() {
        document.getElementById('bulkImportModal').classList.remove('open');
    }

    function confirmBulkAction() {
        const action = document.querySelector('#bulkActionForm select[name="bulk_action"]').value;
        if (action === 'delete') {
            return confirm('Delete all selected redirection rules?');
        }
        return true;
    }

    document.addEventListener('DOMContentLoaded', function () {
        handleStatusChange();
        handleMatchTypeChange();

        @if(session('edit_id'))
            const editRule = @json(collect($redirects)->firstWhere('id', session('edit_id')));
            if (editRule) {
                editRedirect(editRule);
                document.getElementById('source_url').value = @json(old('source_url', ''));
                document.getElementById('target_url').value = @json(old('target_url', ''));
                document.getElementById('status_code').value = @json(old('status_code', 301));
                document.getElementById('match_type').value = @json(old('match_type', 'exact'));
                document.getElementById('notes').value = @json(old('notes', ''));
                document.getElementById('is_active').checked = @json((bool) old('is_active', false));
                document.getElementById('preserve_query').checked = @json((bool) old('preserve_query', false));
                handleStatusChange();
                handleMatchTypeChange();
            }
        @endif

        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const stateFilter = document.getElementById('stateFilter');
        const rows = document.querySelectorAll('.redir-row');
        const table = document.getElementById('redirectsTable');
        const noRes = document.getElementById('noFilterResults');

        function applyFilters() {
            const q = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const st = statusFilter ? statusFilter.value : '';
            const state = stateFilter ? stateFilter.value : '';
            let visible = 0;

            rows.forEach(function (row) {
                const matchText = !q || row.dataset.search.includes(q);
                const matchStatus = !st || row.dataset.status === st;
                const matchState = !state || row.dataset.state === state;
                const show = matchText && matchStatus && matchState;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (table && noRes) {
                table.style.display = visible > 0 ? '' : 'none';
                noRes.style.display = visible > 0 ? 'none' : 'block';
            }
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (statusFilter) statusFilter.addEventListener('change', applyFilters);
        if (stateFilter) stateFilter.addEventListener('change', applyFilters);

        const selectAll = document.getElementById('selectAllCheckbox');
        const checks = document.querySelectorAll('.row-check');
        const bulkForm = document.getElementById('bulkActionForm');
        const countLabel = document.getElementById('selectedCountLabel');

        function syncBulkBar() {
            if (!bulkForm) return;
            bulkForm.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
            const checked = Array.from(checks).filter(c => c.checked);
            checked.forEach(c => {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'ids[]';
                hidden.value = c.value;
                bulkForm.appendChild(hidden);
            });
            bulkForm.style.display = checked.length > 0 ? 'flex' : 'none';
            if (countLabel) countLabel.textContent = checked.length + ' selected';
        }

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checks.forEach(c => {
                    if (c.closest('tr').style.display !== 'none') {
                        c.checked = selectAll.checked;
                    }
                });
                syncBulkBar();
            });
        }
        checks.forEach(c => c.addEventListener('change', syncBulkBar));
    });
</script>
@endsection
