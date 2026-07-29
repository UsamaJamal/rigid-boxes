@extends('admin.layout')

@section('title', 'Footer & Company Settings - Admin')
@section('heading', 'Footer & Company Settings')

@section('content')

<style>
    .custom-multiselect-container {
        position: relative;
        width: 100%;
        z-index: 50;
    }
    .multiselect-trigger {
        min-height: 48px;
        padding: 8px 14px;
        background: #ffffff;
        border: 1px solid #ddd8df;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .multiselect-trigger:hover, .custom-multiselect-container.open .multiselect-trigger {
        border-color: #8d4445;
        box-shadow: 0 0 0 3px rgba(141,68,69,0.1);
    }
    .selected-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
        flex: 1;
        margin-right: 10px;
    }
    .tag-chip {
        background: #fbfafb;
        color: #8d4445;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 1px solid #f0dddd;
    }
    .tag-chip i {
        cursor: pointer;
        font-size: 11px;
    }
    .dropdown-placeholder {
        color: #888;
        font-size: 13px;
        font-weight: 500;
    }
    .multiselect-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #ddd8df;
        border-radius: 8px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.18);
        z-index: 9999;
        padding: 12px;
    }
    .custom-multiselect-container.open .multiselect-dropdown {
        display: block;
    }
    .dropdown-search {
        position: relative;
        margin-bottom: 8px;
    }
    .dropdown-search input {
        width: 100%;
        padding: 9px 12px 9px 34px;
        font-size: 13px;
        border-radius: 6px;
        border: 1px solid #ddd8df;
        background: #fbfafb;
    }
    .dropdown-search i.search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 12px;
    }
    .dropdown-actions {
        display: flex;
        justify-content: space-between;
        padding: 4px 6px 8px;
        font-size: 11px;
        font-weight: 700;
        border-bottom: 1px solid #ddd8df;
        margin-bottom: 6px;
    }
    .dropdown-actions span {
        color: #8d4445;
        cursor: pointer;
    }
    .dropdown-actions span:hover {
        text-decoration: underline;
    }
    .dropdown-options-list {
        max-height: 220px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .dropdown-option-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.15s ease;
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }
    .dropdown-option-item:hover {
        background: #fbfafb;
    }
    .dropdown-option-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #8d4445;
        cursor: pointer;
    }
</style>

<div class="card" style="max-width: 900px;">
    <div class="card-header">
        <h2 class="card-title">Manage Global Settings</h2>
    </div>
    
    @if(session('success'))
        <div style="padding:15px; background:#d4edda; color:#155724; border-radius:6px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.footer.update') }}" method="POST">
        @csrf
        
        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">Company Information</h3>
            <p style="font-size:13px; color:#666; margin-bottom:15px;">These details will automatically update across the Header, Footer, and Contact pages.</p>
            
            <div class="form-group">
                <label class="form-label">Company Email</label>
                <input type="email" name="company_email" class="form-input" value="{{ old('company_email', $settings['company_email'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Company Phone Number</label>
                <input type="text" name="company_phone" class="form-input" value="{{ old('company_phone', $settings['company_phone'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Company Address</label>
                <textarea name="company_address" class="form-input" rows="3">{{ old('company_address', $settings['company_address'] ?? '') }}</textarea>
                <small style="color:#666; font-size:12px;">You can use &lt;br&gt; to add line breaks.</small>
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">1. Social Media Links</h3>
            
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="social_facebook" class="form-input" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Twitter URL</label>
                <input type="url" name="social_twitter" class="form-input" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="social_instagram" class="form-input" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Pinterest URL</label>
                <input type="url" name="social_pinterest" class="form-input" value="{{ old('social_pinterest', $settings['social_pinterest'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="social_linkedin" class="form-input" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">YouTube URL</label>
                <input type="url" name="social_youtube" class="form-input" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}">
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">Footer Settings</h3>
            
            <div class="form-group">
                <label class="form-label">Footer Categories (Multiple)</label>
                @php $selectedCats = (array) ($settings['footer_categories'] ?? []); @endphp
                <div class="custom-multiselect-container" id="categoryMultiselect">
                    <div class="multiselect-trigger" onclick="toggleDropdown('categoryMultiselect')">
                        <div class="selected-tags" id="categorySelectedTags"></div>
                        <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: #888;"></i>
                    </div>

                    <div class="multiselect-dropdown">
                        <div class="dropdown-search">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" placeholder="Search categories..." onkeyup="filterOptions(this, 'categoryOptionsList')">
                        </div>
                        <div class="dropdown-actions">
                            <span onclick="selectAllOptions('categoryMultiselect', true)">Select All</span>
                            <span onclick="selectAllOptions('categoryMultiselect', false)">Clear All</span>
                        </div>
                        <div class="dropdown-options-list" id="categoryOptionsList">
                            @forelse($categories as $category)
                                <label class="dropdown-option-item">
                                    <input type="checkbox" name="footer_categories[]" value="{{ $category['id'] }}" data-title="{{ $category['title'] ?? $category['name'] ?? '' }}" {{ in_array($category['id'], $selectedCats) ? 'checked' : '' }} onchange="updateMultiselectDisplay('categoryMultiselect')">
                                    <span>{{ $category['title'] ?? $category['name'] ?? '' }}</span>
                                </label>
                            @empty
                                <p style="color: #888; padding: 8px; font-size: 12px;">No categories available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Footer Quick Links</label>
                <div id="quick-links-container">
                    @php $quickLinks = $settings['footer_quick_links'] ?? []; @endphp
                    
                    @if(empty($quickLinks))
                        <div class="quick-link-row" style="display:flex; gap:10px; margin-bottom:10px;">
                            <input type="text" name="footer_quick_links_names[]" class="form-input" placeholder="Link Name (e.g. About Us)">
                            <input type="text" name="footer_quick_links_urls[]" class="form-input" placeholder="URL (e.g. /about-us)">
                            <button type="button" class="btn btn-danger remove-link-btn" style="padding:0 15px;">&times;</button>
                        </div>
                    @else
                        @foreach($quickLinks as $link)
                        <div class="quick-link-row" style="display:flex; gap:10px; margin-bottom:10px;">
                            <input type="text" name="footer_quick_links_names[]" class="form-input" value="{{ $link['name'] ?? '' }}" placeholder="Link Name (e.g. About Us)">
                            <input type="text" name="footer_quick_links_urls[]" class="form-input" value="{{ $link['url'] ?? '' }}" placeholder="URL (e.g. /about-us)">
                            <button type="button" class="btn btn-danger remove-link-btn" style="padding:0 15px;">&times;</button>
                        </div>
                        @endforeach
                    @endif
                </div>
                
                <button type="button" id="add-quick-link-btn" class="btn" style="background:#f0f0f0; color:#333; margin-top:10px;">
                    + Add Quick Link
                </button>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 16px;">Save Settings</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('quick-links-container');
        const addBtn = document.getElementById('add-quick-link-btn');
        
        if(addBtn) {
            addBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'quick-link-row';
                row.style = 'display:flex; gap:10px; margin-bottom:10px;';
                row.innerHTML = `
                    <input type="text" name="footer_quick_links_names[]" class="form-input" placeholder="Link Name (e.g. About Us)">
                    <input type="text" name="footer_quick_links_urls[]" class="form-input" placeholder="URL (e.g. /about-us)">
                    <button type="button" class="btn btn-danger remove-link-btn" style="padding:0 15px;">&times;</button>
                `;
                container.appendChild(row);
            });
            
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-link-btn')) {
                    const row = e.target.closest('.quick-link-row');
                    if (container.children.length > 1) {
                        row.remove();
                    } else {
                        // Just clear the inputs if it's the last row
                        row.querySelectorAll('input').forEach(input => input.value = '');
                    }
                }
            });
        }

        // Initialize multiselect
        updateMultiselectDisplay('categoryMultiselect');
    });

    function toggleDropdown(containerId) {
        const container = document.getElementById(containerId);
        container.classList.toggle('open');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-multiselect-container')) {
            document.querySelectorAll('.custom-multiselect-container').forEach(c => c.classList.remove('open'));
        }
    });

    function updateMultiselectDisplay(containerId) {
        const container = document.getElementById(containerId);
        const tagsBox = container.querySelector('.selected-tags');
        const checkedInputs = container.querySelectorAll('.dropdown-options-list input[type="checkbox"]:checked');
        
        tagsBox.innerHTML = '';
        if (checkedInputs.length === 0) {
            tagsBox.innerHTML = '<span class="dropdown-placeholder">Click to select categories...</span>';
        } else {
            checkedInputs.forEach(cb => {
                const title = cb.getAttribute('data-title');
                const val = cb.value;
                const chip = document.createElement('span');
                chip.className = 'tag-chip';
                chip.innerHTML = `${title} <i class="fa-solid fa-xmark" onclick="event.stopPropagation(); uncheckOption('${containerId}', '${val}')"></i>`;
                tagsBox.appendChild(chip);
            });
        }
    }

    function uncheckOption(containerId, val) {
        const container = document.getElementById(containerId);
        const cb = container.querySelector(`input[value="${val}"]`);
        if (cb) {
            cb.checked = false;
            updateMultiselectDisplay(containerId);
        }
    }

    function filterOptions(searchInput, listId) {
        const filter = searchInput.value.toLowerCase();
        const list = document.getElementById(listId);
        const items = list.querySelectorAll('.dropdown-option-item');
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? 'flex' : 'none';
        });
    }

    function selectAllOptions(containerId, selectAll) {
        const container = document.getElementById(containerId);
        const cbs = container.querySelectorAll('.dropdown-options-list input[type="checkbox"]');
        cbs.forEach(cb => {
            if (cb.closest('.dropdown-option-item').style.display !== 'none') {
                cb.checked = selectAll;
            }
        });
        updateMultiselectDisplay(containerId);
    }
</script>
@endsection
