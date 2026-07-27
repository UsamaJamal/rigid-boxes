@extends('admin.layout')

@section('title', 'Home Page Settings')
@section('heading', 'Home Page Settings')

@section('content')

<!-- TinyMCE Rich Text & HTML Code Editor CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

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
        border: 1.5px solid #ddd8df;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .multiselect-trigger:hover, .custom-multiselect-container.open .multiselect-trigger {
        border-color: var(--primary);
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
        background: var(--soft);
        color: var(--primary);
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
    .tag-chip i:hover {
        color: var(--primary-dark);
    }
    .dropdown-placeholder {
        color: var(--muted);
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
        border: 1.5px solid #ddd8df;
        border-radius: 12px;
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
        border-radius: 8px;
        border: 1px solid var(--line);
        background: #fbfafb;
    }
    .dropdown-search i.search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 12px;
    }
    .dropdown-actions {
        display: flex;
        justify-content: space-between;
        padding: 4px 6px 8px;
        font-size: 11px;
        font-weight: 700;
        border-bottom: 1px solid var(--line);
        margin-bottom: 6px;
    }
    .dropdown-actions span {
        color: var(--primary);
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
        color: var(--text);
    }
    .dropdown-option-item:hover {
        background: var(--soft);
    }
    .dropdown-option-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--primary);
        cursor: pointer;
    }
</style>

<form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- SECTION 1: SEO META SETTINGS -->
    <div class="panel">
        <div class="panel-head">
            <h2 style="font-size: 17px;"><i class="fa-solid fa-globe" style="color:var(--primary); margin-right: 8px;"></i> 1. Search Engine Optimization (SEO)</h2>
            <span style="color:var(--muted); font-size: 12px;">Manage Meta Title & Meta Description for Google & search engines</span>
        </div>
        <div class="section">
            <div class="form-grid">
                <div class="field full">
                    <label for="meta_title">Homepage Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? '') }}" placeholder="e.g. Custom Printed Boxes & Packaging - The Rigid Boxes" maxlength="255">
                    <small>Recommended length: 50-60 characters for optimal Google display.</small>
                </div>
                
                <div class="field full">
                    <label for="meta_description">Homepage Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" placeholder="e.g. Custom printed rigid packaging boxes at wholesale rates. Premium luxury boxes for retail, cosmetic, and gift packaging." maxlength="1000">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                    <small>Recommended length: 150-160 characters describing your homepage content.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: HERO SECTION -->
    <div class="panel">
        <div class="panel-head">
            <h2 style="font-size: 17px;"><i class="fa-solid fa-star" style="color:var(--primary); margin-right: 8px;"></i> 2. Hero Banner Section</h2>
            <span style="color:var(--muted); font-size: 12px;">Configure main banner title, description & hero image</span>
        </div>
        <div class="section">
            <div class="form-grid">
                <div class="field full">
                    <label for="hero_title">Hero Title (H1)</label>
                    <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" placeholder="e.g. Custom Printed Boxes & Packaging Manufacturer" required>
                </div>
                
                <div class="field full">
                    <label for="hero_description">Hero Description</label>
                    <textarea id="hero_description" name="hero_description" rows="3" placeholder="Enter brief hero paragraph text...">{{ old('hero_description', $settings['hero_description'] ?? '') }}</textarea>
                </div>

                <div class="field full">
                    <label for="hero_image">Hero Image</label>
                    @if(!empty($settings['hero_image']))
                        <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 12px; background: var(--soft); padding: 10px 14px; border-radius: 10px; width: fit-content;">
                            <img src="{{ asset('storage/' . $settings['hero_image']) }}" alt="Current Hero Image" style="height: 60px; object-fit: contain; border-radius: 6px;">
                            <span style="font-size: 12px; color: var(--muted); font-weight: 600;">Current Hero Image</span>
                        </div>
                    @endif
                    <input type="file" id="hero_image" name="hero_image" accept="image/*">
                    <small>Recommended size: 1200x600px. PNG, JPG or WebP formats.</small>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: SELECT CATEGORIES (SEARCHABLE MULTI-SELECT DROPDOWN) -->
    <div class="panel" style="overflow: visible; position: relative; z-index: 30;">
        <div class="panel-head">
            <h2 style="font-size: 17px;"><i class="fa-solid fa-layer-group" style="color:var(--primary); margin-right: 8px;"></i> 3. Select Featured Categories</h2>
            <span style="color:var(--muted); font-size: 12px;">Choose multiple categories via searchable dropdown</span>
        </div>
        <div class="section" style="overflow: visible;">
            @php $selectedCats = (array) ($settings['featured_categories'] ?? []); @endphp
            
            <div class="custom-multiselect-container" id="categoryMultiselect">
                <div class="multiselect-trigger" onclick="toggleDropdown('categoryMultiselect')">
                    <div class="selected-tags" id="categorySelectedTags"></div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: var(--muted);"></i>
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
                                <input type="checkbox" name="featured_categories[]" value="{{ $category['id'] }}" data-title="{{ $category['title'] }}" {{ in_array($category['id'], $selectedCats) ? 'checked' : '' }} onchange="updateMultiselectDisplay('categoryMultiselect')">
                                <span>{{ $category['title'] }}</span>
                            </label>
                        @empty
                            <p style="color: var(--muted); padding: 8px; font-size: 12px;">No categories available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 4: BEST SELLER PRODUCTS (SEARCHABLE MULTI-SELECT DROPDOWN) -->
    <div class="panel" style="overflow: visible; position: relative; z-index: 20;">
        <div class="panel-head">
            <h2 style="font-size: 17px;"><i class="fa-solid fa-fire" style="color:var(--primary); margin-right: 8px;"></i> 4. Best Seller Products</h2>
            <span style="color:var(--muted); font-size: 12px;">Select multiple products via searchable dropdown</span>
        </div>
        <div class="section" style="overflow: visible;">
            @php $selectedProds = (array) ($settings['bestseller_products'] ?? []); @endphp

            <div class="custom-multiselect-container" id="productMultiselect">
                <div class="multiselect-trigger" onclick="toggleDropdown('productMultiselect')">
                    <div class="selected-tags" id="productSelectedTags"></div>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: var(--muted);"></i>
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
                        @forelse($products as $product)
                            <label class="dropdown-option-item">
                                <input type="checkbox" name="bestseller_products[]" value="{{ $product['id'] }}" data-title="{{ $product['title'] }}" {{ in_array($product['id'], $selectedProds) ? 'checked' : '' }} onchange="updateMultiselectDisplay('productMultiselect')">
                                <span>{{ $product['title'] }}</span>
                            </label>
                        @empty
                            <p style="color: var(--muted); padding: 8px; font-size: 12px;">No products available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 5: CONTENT SECTION (ADVANCED EDITOR WITH RAW HTML CODE VIEW & H1-H6) -->
    <div class="panel">
        <div class="panel-head">
            <h2 style="font-size: 17px;"><i class="fa-solid fa-code" style="color:var(--primary); margin-right: 8px;"></i> 5. Content Section</h2>
            <span style="color:var(--muted); font-size: 12px;">Rich text editor with Raw HTML Code mode (&lt;/&gt;) and H1-H6 Headings</span>
        </div>
        <div class="section">
            <div class="field full">
                <textarea id="ck_content_section" name="content_section">{{ old('content_section', $settings['content_section'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- SECTION 6: FAQS SECTION -->
    <div class="panel">
        <div class="panel-head" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 style="font-size: 17px;"><i class="fa-solid fa-circle-question" style="color:var(--primary); margin-right: 8px;"></i> 6. Homepage FAQs</h2>
                <span style="color:var(--muted); font-size: 12px;">Add question & answer pairs for the Homepage FAQ section</span>
            </div>
            <button type="button" class="btn light" onclick="addFaqRow()" style="font-size: 12px; padding: 6px 12px;">
                <i class="fa-solid fa-plus"></i> Add Question
            </button>
        </div>
        <div class="section">
            <div id="faqContainer" style="display: flex; flex-direction: column; gap: 16px;">
                @php $faqs = (array) ($settings['faqs'] ?? []); @endphp
                @forelse($faqs as $index => $faq)
                    <div class="faq-row" style="background: #faf8f9; padding: 18px; border-radius: 12px; border: 1px solid var(--line); position: relative;">
                        <button type="button" onclick="this.closest('.faq-row').remove()" style="position: absolute; top: 12px; right: 12px; border: none; background: #fff0f0; color: #a52b2b; width: 28px; height: 28px; border-radius: 6px; cursor: pointer;" title="Delete FAQ">
                            <i class="fa-solid fa-trash" style="font-size: 12px;"></i>
                        </button>
                        <div class="field" style="margin-bottom: 10px; width: calc(100% - 40px);">
                            <label>Question</label>
                            <input type="text" name="faq_questions[]" value="{{ $faq['question'] ?? '' }}" placeholder="Enter Question...">
                        </div>
                        <div class="field">
                            <label>Answer</label>
                            <textarea name="faq_answers[]" rows="2" placeholder="Enter Answer...">{{ $faq['answer'] ?? '' }}</textarea>
                        </div>
                    </div>
                @empty
                    <div class="faq-row" style="background: #faf8f9; padding: 18px; border-radius: 12px; border: 1px solid var(--line); position: relative;">
                        <button type="button" onclick="this.closest('.faq-row').remove()" style="position: absolute; top: 12px; right: 12px; border: none; background: #fff0f0; color: #a52b2b; width: 28px; height: 28px; border-radius: 6px; cursor: pointer;" title="Delete FAQ">
                            <i class="fa-solid fa-trash" style="font-size: 12px;"></i>
                        </button>
                        <div class="field" style="margin-bottom: 10px; width: calc(100% - 40px);">
                            <label>Question</label>
                            <input type="text" name="faq_questions[]" placeholder="Enter Question...">
                        </div>
                        <div class="field">
                            <label>Answer</label>
                            <textarea name="faq_answers[]" rows="2" placeholder="Enter Answer..."></textarea>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- SAVE BUTTON -->
    <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
        <button type="submit" class="btn" style="padding: 14px 32px; font-size: 15px;">
            <i class="fa-solid fa-floppy-disk"></i> Save Home Page Settings
        </button>
    </div>
</form>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                ...window.tinyMceUploadConfig,
                selector: '#ck_content_section',
                height: 420,
                plugins: 'code advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code fullscreen preview',
                block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
                branding: false,
                promotion: false,
                content_style: 'body { font-family:"DM Sans",sans-serif; font-size:14px; line-height:1.6; }'
            });
        }

        // Initialize display for multiselects
        updateMultiselectDisplay('categoryMultiselect');
        updateMultiselectDisplay('productMultiselect');
    });

    function toggleDropdown(containerId) {
        const container = document.getElementById(containerId);
        const isOpen = container.classList.contains('open');
        document.querySelectorAll('.custom-multiselect-container').forEach(c => c.classList.remove('open'));
        if (!isOpen) {
            container.classList.add('open');
        }
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

    function addFaqRow() {
        const container = document.getElementById('faqContainer');
        const row = document.createElement('div');
        row.className = 'faq-row';
        row.style.cssText = 'background: #faf8f9; padding: 18px; border-radius: 12px; border: 1px solid var(--line); position: relative;';
        row.innerHTML = `
            <button type="button" onclick="this.closest('.faq-row').remove()" style="position: absolute; top: 12px; right: 12px; border: none; background: #fff0f0; color: #a52b2b; width: 28px; height: 28px; border-radius: 6px; cursor: pointer;" title="Delete FAQ">
                <i class="fa-solid fa-trash" style="font-size: 12px;"></i>
            </button>
            <div class="field" style="margin-bottom: 10px; width: calc(100% - 40px);">
                <label>Question</label>
                <input type="text" name="faq_questions[]" placeholder="Enter Question...">
            </div>
            <div class="field">
                <label>Answer</label>
                <textarea name="faq_answers[]" rows="2" placeholder="Enter Answer..."></textarea>
            </div>
        `;
        container.appendChild(row);
    }
</script>

@endsection
