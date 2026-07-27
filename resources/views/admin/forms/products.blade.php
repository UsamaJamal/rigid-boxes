@extends('admin.layout')
@section('title', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('heading', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

@php
    $v = fn($key, $default = '') => old($key, $item[$key] ?? $default);
    $editing = (bool)$item;
    $resolveImg = fn($path) => empty($path) ? '' : (\Illuminate\Support\Str::startsWith($path, ['storage/', 'uploads/', 'images/']) ? asset($path) : asset('storage/' . $path));
    $selectedCats = (array) old('categories', json_decode($item['categories'] ?? '[]', true) ?? []);
    $selectedRelated = (array) old('related', json_decode($item['related'] ?? '[]', true) ?? []);
    $productFaqs = $productFaqs ?? [];
    // Also check pivot table if no categories stored on product itself
@endphp

<style>
    .custom-multiselect-container { position: relative; width: 100%; z-index: 50; }
    .multiselect-trigger {
        min-height: 48px; padding: 8px 14px; background: #ffffff;
        border: 1.5px solid #ddd8df; border-radius: 10px;
        display: flex; align-items: center; justify-content: space-between;
        cursor: pointer; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .multiselect-trigger:hover, .custom-multiselect-container.open .multiselect-trigger {
        border-color: var(--primary); box-shadow: 0 0 0 3px rgba(141,68,69,0.1);
    }
    .selected-tags { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; flex: 1; margin-right: 10px; }
    .tag-chip {
        background: var(--soft); color: var(--primary); font-size: 12px;
        font-weight: 700; padding: 4px 10px; border-radius: 6px;
        display: inline-flex; align-items: center; gap: 6px; border: 1px solid #f0dddd;
    }
    .tag-chip i { cursor: pointer; font-size: 11px; }
    .tag-chip i:hover { color: var(--primary-dark); }
    .dropdown-placeholder { color: var(--muted); font-size: 13px; font-weight: 500; }
    .multiselect-dropdown {
        display: none; position: absolute; top: calc(100% + 6px); left: 0; right: 0;
        background: #ffffff; border: 1.5px solid #ddd8df; border-radius: 12px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.18); z-index: 9999; padding: 12px;
    }
    .custom-multiselect-container.open .multiselect-dropdown { display: block; }
    .dropdown-search { position: relative; margin-bottom: 8px; }
    .dropdown-search input {
        width: 100%; padding: 9px 12px 9px 34px; font-size: 13px;
        border-radius: 8px; border: 1px solid var(--line); background: #fbfafb;
    }
    .dropdown-search i.search-icon { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 12px; }
    .dropdown-actions {
        display: flex; justify-content: space-between; padding: 4px 6px 8px;
        font-size: 11px; font-weight: 700; border-bottom: 1px solid var(--line); margin-bottom: 6px;
    }
    .dropdown-actions span { color: var(--primary); cursor: pointer; }
    .dropdown-actions span:hover { text-decoration: underline; }
    .dropdown-options-list { max-height: 220px; overflow-y: auto; display: flex; flex-direction: column; gap: 4px; }
    .dropdown-option-item {
        display: flex; align-items: center; gap: 10px; padding: 8px 10px;
        border-radius: 6px; cursor: pointer; transition: background 0.15s ease;
        font-size: 13px; font-weight: 600; color: var(--text);
    }
    .dropdown-option-item:hover { background: var(--soft); }
    .dropdown-option-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer; }
</style>

@if($errors->any())
    <div class="alert" style="background:#fff0f0; color:#9c2828">
        {{ $errors->first() }}
    </div>
@endif

<form class="panel" style="margin-top:0" method="post" enctype="multipart/form-data" action="{{ $editing ? route('admin.module.update', [$module, $item['id']]) : route('admin.module.store', $module) }}">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <div class="section">
        <h3>Basic Information</h3>
        <div class="form-grid">
            <div class="field">
                <label>Title / Name *</label>
                <input name="title" required value="{{ $v('title') }}" placeholder="Enter {{ strtolower($meta['singular']) }} title">
            </div>
            <div class="field">
                <label>URL Slug</label>
                <input name="slug" value="{{ $v('slug') }}" placeholder="auto-generated-from-title">
            </div>
            <div class="field">
                <label>Status</label>
                <select name="status">
                    <option value="draft" @selected($v('status') === 'draft')>Draft</option>
                    <option value="published" @selected($v('status') === 'published')>Published</option>
                    <option value="inactive" @selected($v('status') === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="field">
                <label>Featured Image</label>
                @if($editing && !empty($item['image']))
                    <div style="margin-bottom:8px">
                        <img src="{{ $resolveImg($item['image']) }}" style="height:60px; border-radius:4px; border:1px solid #ddd">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*">
            </div>
        </div>
    </div>

    <div class="section" style="overflow:visible; position:relative; z-index:30;">
        <h3>Product Organization</h3>
        <div class="form-grid" style="overflow:visible;">

            {{-- Categories Multiselect --}}
            <div class="field full" style="overflow:visible; position:relative; z-index:30;">
                <label>Categories (multiple allowed)</label>
                @php
                    $editingCatIds = [];
                    if ($editing && !empty($item['id'])) {
                        $editingCatIds = \Illuminate\Support\Facades\DB::table('admin_category_product')
                            ->where('product_id', $item['id'])->pluck('category_id')->toArray();
                    }
                @endphp
                <div class="custom-multiselect-container" id="categoryMultiselect">
                    <div class="multiselect-trigger" onclick="toggleDropdown('categoryMultiselect')">
                        <div class="selected-tags" id="categorySelectedTags"></div>
                        <i class="fa-solid fa-chevron-down" style="font-size:12px; color:var(--muted);"></i>
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
                            @foreach($categories as $cat)
                                <label class="dropdown-option-item">
                                    <input type="checkbox" name="categories[]" value="{{ $cat['id'] }}"
                                        data-title="{{ $cat['title'] }}"
                                        {{ in_array($cat['id'], $editingCatIds) ? 'checked' : '' }}
                                        onchange="updateMultiselectDisplay('categoryMultiselect')">
                                    <span>{{ $cat['title'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <small style="margin-top:6px; display:block;">First selected category becomes the primary category.</small>
            </div>

            {{-- Related Products Multiselect --}}
            <div class="field full" style="overflow:visible; position:relative; z-index:20;">
                <label>Related Products</label>
                @php
                    $editingRelatedIds = [];
                    if ($editing && !empty($item['related'])) {
                        $rel = is_string($item['related']) ? json_decode($item['related'], true) : $item['related'];
                        $editingRelatedIds = (array) ($rel ?? []);
                    }
                @endphp
                <div class="custom-multiselect-container" id="productMultiselect">
                    <div class="multiselect-trigger" onclick="toggleDropdown('productMultiselect')">
                        <div class="selected-tags" id="productSelectedTags"></div>
                        <i class="fa-solid fa-chevron-down" style="font-size:12px; color:var(--muted);"></i>
                    </div>
                    <div class="multiselect-dropdown">
                        <div class="dropdown-search">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" placeholder="Search products..." onkeyup="filterOptions(this, 'productOptionsList')">
                        </div>
                        <div class="dropdown-actions">
                            <span onclick="selectAllOptions('productMultiselect', true)">Select All</span>
                            <span onclick="selectAllOptions('productMultiselect', false)">Clear All</span>
                        </div>
                        <div class="dropdown-options-list" id="productOptionsList">
                            @foreach($products as $prod)
                                @if(!$editing || empty($item['id']) || $prod['id'] != ($item['id'] ?? null))
                                <label class="dropdown-option-item">
                                    <input type="checkbox" name="related[]" value="{{ $prod['id'] }}"
                                        data-title="{{ $prod['title'] }}"
                                        {{ in_array($prod['id'], $editingRelatedIds) ? 'checked' : '' }}
                                        onchange="updateMultiselectDisplay('productMultiselect')">
                                    <span>{{ $prod['title'] }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section">
        <h3>Product Content & Media</h3>
        <div class="form-grid">
            <div class="field full">
                <label>Short Description</label>
                <textarea name="description">{{ $v('description') }}</textarea>
            </div>
            <div class="field full">
                <label>Long Description</label>
                <textarea name="long_description" style="min-height:220px">{{ $v('long_description') }}</textarea>
            </div>
            <div class="field">
                <label>Image Alt Text</label>
                <input name="alt_text" value="{{ $v('alt_text') }}">
            </div>
            <div class="field">
                <label>Product Gallery</label>
                @if($editing && !empty($item['images']))
                    @php $imgs = is_string($item['images']) ? json_decode($item['images'], true) : $item['images']; @endphp
                    @if(is_array($imgs))
                        <div style="display:flex; gap:8px; margin-bottom:8px; flex-wrap:wrap">
                            @foreach($imgs as $img)
                                <img src="{{ $resolveImg($img) }}" style="height:60px; border-radius:4px; border:1px solid #ddd">
                            @endforeach
                        </div>
                    @endif
                @endif
                <input type="hidden" name="existing_images" value="{{ json_encode($imgs ?? []) }}">
                <input type="file" name="images[]" accept="image/*" multiple>
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Product Specifications</h3>
        <div class="form-grid">
            @foreach(['box_style' => 'Box Style', 'material' => 'Material / Stock', 'printing' => 'Printing Method', 'finishing' => 'Finishing', 'dimensions' => 'Dimensions', 'moq' => 'Minimum Order Quantity', 'turnaround' => 'Turnaround Time'] as $key => $label)
                <div class="field">
                    <label>{{ $label }}</label>
                    <input name="{{ $key }}" value="{{ $v($key) }}">
                </div>
            @endforeach
        </div>
    </div>

    <div class="section">
        <h3>Product FAQs</h3>
        <div class="form-grid">
            @for($i = 0; $i < 4; $i++)
                <div class="field">
                    <label>Question {{ $i + 1 }}</label>
                    <input name="faq_question[]" value="{{ old('faq_question.' . $i, $productFaqs[$i]['question'] ?? '') }}">
                </div>
                <div class="field">
                    <label>Answer {{ $i + 1 }}</label>
                    <textarea name="faq_answer[]" style="min-height:70px">{{ old('faq_answer.' . $i, $productFaqs[$i]['answer'] ?? '') }}</textarea>
                </div>
            @endfor
        </div>
    </div>

    <div class="section">
        <h3>SEO & Search Visibility</h3>
        <div class="form-grid">
            <div class="field">
                <label>Meta Title</label>
                <input name="meta_title" value="{{ $v('meta_title') }}">
            </div>
            <div class="field">
                <label>Robots</label>
                <select name="robots">
                    <option value="index,follow" @selected($v('robots') === 'index,follow')>index, follow</option>
                    <option value="noindex,nofollow" @selected($v('robots') === 'noindex,nofollow')>noindex, nofollow</option>
                </select>
            </div>
            <div class="field full">
                <label>Meta Description</label>
                <textarea name="meta_description">{{ $v('meta_description') }}</textarea>
            </div>
            <div class="field full">
                <label>Meta Keywords / Tags</label>
                <input name="meta_keywords" value="{{ $v('meta_keywords') }}">
            </div>
            <div class="field full">
                <label>Schema JSON-LD</label>
                <textarea name="schema" placeholder='{"@context":"https://schema.org"}'>{{ $v('schema') }}</textarea>
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Visibility</h3>
        <div class="checks">
            <label class="check">
                <input type="checkbox" name="show_home" value="1" @checked($v('show_home'))>
                Show on home page
            </label>
        </div>
    </div>

    <div class="actions">
        <a class="btn light" href="{{ route('admin.module.index', $module) }}">Cancel</a>
        <button class="btn" type="submit">Save {{ $meta['singular'] }}</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                ...window.tinyMceUploadConfig,
                selector: 'textarea[name="description"], textarea[name="long_description"]',
                height: 420,
                plugins: 'code advlist autolink lists link image charmap preview anchor searchreplace visualblocks fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code fullscreen preview',
                block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
                branding: false,
                promotion: false,
                content_style: 'body { font-family:"DM Sans",sans-serif; font-size:14px; line-height:1.6; }'
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        updateMultiselectDisplay('categoryMultiselect');
        updateMultiselectDisplay('productMultiselect');
    });

    function toggleDropdown(containerId) {
        const container = document.getElementById(containerId);
        const isOpen = container.classList.contains('open');
        document.querySelectorAll('.custom-multiselect-container').forEach(c => c.classList.remove('open'));
        if (!isOpen) container.classList.add('open');
    }

    document.addEventListener('click', function (e) {
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
            tagsBox.innerHTML = '<span class="dropdown-placeholder">Click to select items...</span>';
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
        if (cb) { cb.checked = false; updateMultiselectDisplay(containerId); }
    }

    function filterOptions(searchInput, listId) {
        const filter = searchInput.value.toLowerCase();
        const list = document.getElementById(listId);
        list.querySelectorAll('.dropdown-option-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(filter) ? 'flex' : 'none';
        });
    }

    function selectAllOptions(containerId, selectAll) {
        const container = document.getElementById(containerId);
        container.querySelectorAll('.dropdown-options-list input[type="checkbox"]').forEach(cb => {
            if (cb.closest('.dropdown-option-item').style.display !== 'none') cb.checked = selectAll;
        });
        updateMultiselectDisplay(containerId);
    }
</script>

@endsection
