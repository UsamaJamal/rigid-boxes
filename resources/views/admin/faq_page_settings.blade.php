@extends('admin.layout')

@section('title', 'FAQ Page Settings - Admin')
@section('heading', 'FAQ Page Settings')

@section('content')
<style>
    .faq-heading-card {
        background: #ffffff;
        border: 1px solid #ddd8df;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
    }
    .faq-heading-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }
    .faq-heading-card-header input {
        font-size: 16px;
        font-weight: bold;
        border: 1px solid #ddd8df;
        border-radius: 4px;
        padding: 8px 12px;
        width: 100%;
        max-width: 400px;
    }
    .faq-row {
        background: #faf8f9;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd8df;
        margin-bottom: 10px;
        position: relative;
    }
    .btn-remove-heading {
        background: #fff0f0;
        color: #a52b2b;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
    }
    .btn-remove-faq {
        position: absolute;
        top: 15px;
        right: 15px;
        background: transparent;
        color: #a52b2b;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }
</style>

<div class="card" style="max-width: 900px;">
    <div class="card-header">
        <h2 class="card-title">Manage Global FAQ Page</h2>
    </div>
    
    @if(session('success'))
        <div style="padding:15px; background:#d4edda; color:#155724; border-radius:6px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="padding:15px; background:#f8d7da; color:#721c24; border-radius:6px; margin-bottom:20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.faqpage.update') }}" method="POST">
        @csrf
        
        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">Page Configuration</h3>
            
            <div class="form-group">
                <label class="form-label">Page Title</label>
                <input type="text" name="faq_page_title" class="form-input" value="{{ old('faq_page_title', $settings['faq_page_title'] ?? 'Frequently Asked Questions') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">URL Slug</label>
                <input type="text" name="faq_page_slug" class="form-input" value="{{ old('faq_page_slug', $settings['faq_page_slug'] ?? 'frequently-asked-questions') }}" required>
                <small style="color:#666; font-size:12px;">The URL where this page will be available (e.g. yourwebsite.com/<b>frequently-asked-questions</b>)</small>
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">SEO Configuration</h3>
            
            <div class="form-group">
                <label class="form-label">Meta Title</label>
                <input type="text" name="faq_meta_title" class="form-input" value="{{ old('faq_meta_title', $settings['faq_meta_title'] ?? '') }}" placeholder="Enter Meta Title">
            </div>
            
            <div class="form-group">
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="faq_meta_keywords" class="form-input" value="{{ old('faq_meta_keywords', $settings['faq_meta_keywords'] ?? '') }}" placeholder="e.g. rigid boxes faq, packaging questions">
            </div>
            
            <div class="form-group">
                <label class="form-label">Meta Description</label>
                <textarea name="faq_meta_description" class="form-input" rows="3" placeholder="Enter Meta Description">{{ old('faq_meta_description', $settings['faq_meta_description'] ?? '') }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Meta Robots</label>
                <select name="faq_robots" class="form-input">
                    <option value="index,follow" {{ (old('faq_robots', $settings['faq_robots'] ?? 'index,follow') == 'index,follow') ? 'selected' : '' }}>Index, Follow</option>
                    <option value="noindex,nofollow" {{ (old('faq_robots', $settings['faq_robots'] ?? '') == 'noindex,nofollow') ? 'selected' : '' }}>No Index, No Follow</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">FAQ Sections (Headings & Q/A)</h3>
            
            <div id="faq-sections-container">
                @php $sections = $settings['faq_page_sections'] ?? []; @endphp
                
                @if(empty($sections))
                    <!-- Initial Empty Section -->
                    <div class="faq-heading-card" data-index="0">
                        <div class="faq-heading-card-header">
                            <input type="text" name="headings[0]" placeholder="Enter Heading (e.g. Order & Prices)" value="">
                            <button type="button" class="btn-remove-heading" onclick="removeHeading(this)">Delete Heading</button>
                        </div>
                        <div class="faqs-container">
                            <div class="faq-row">
                                <button type="button" class="btn-remove-faq" onclick="removeFaq(this)"><i class="fa-solid fa-trash"></i></button>
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label class="form-label" style="font-size: 13px;">Question</label>
                                    <input type="text" name="questions[0][]" class="form-input" placeholder="Enter Question">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label class="form-label" style="font-size: 13px;">Answer</label>
                                    <textarea name="answers[0][]" class="form-input" rows="2" placeholder="Enter Answer"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px; margin-top: 10px;" onclick="addFaq(this, 0)">+ Add Question</button>
                    </div>
                @else
                    <!-- Load Saved Sections -->
                    @foreach($sections as $index => $section)
                        <div class="faq-heading-card" data-index="{{ $index }}">
                            <div class="faq-heading-card-header">
                                <input type="text" name="headings[{{ $index }}]" placeholder="Enter Heading (e.g. Order & Prices)" value="{{ $section['heading'] ?? '' }}">
                                <button type="button" class="btn-remove-heading" onclick="removeHeading(this)">Delete Heading</button>
                            </div>
                            <div class="faqs-container">
                                @php $faqs = $section['faqs'] ?? []; @endphp
                                @if(empty($faqs))
                                    <div class="faq-row">
                                        <button type="button" class="btn-remove-faq" onclick="removeFaq(this)"><i class="fa-solid fa-trash"></i></button>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="form-label" style="font-size: 13px;">Question</label>
                                            <input type="text" name="questions[{{ $index }}][]" class="form-input" placeholder="Enter Question">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label class="form-label" style="font-size: 13px;">Answer</label>
                                            <textarea name="answers[{{ $index }}][]" class="form-input" rows="2" placeholder="Enter Answer"></textarea>
                                        </div>
                                    </div>
                                @else
                                    @foreach($faqs as $faq)
                                        <div class="faq-row">
                                            <button type="button" class="btn-remove-faq" onclick="removeFaq(this)"><i class="fa-solid fa-trash"></i></button>
                                            <div class="form-group" style="margin-bottom: 10px;">
                                                <label class="form-label" style="font-size: 13px;">Question</label>
                                                <input type="text" name="questions[{{ $index }}][]" class="form-input" placeholder="Enter Question" value="{{ $faq['question'] ?? '' }}">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0;">
                                                <label class="form-label" style="font-size: 13px;">Answer</label>
                                                <textarea name="answers[{{ $index }}][]" class="form-input" rows="2" placeholder="Enter Answer">{{ $faq['answer'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px; margin-top: 10px;" onclick="addFaq(this, {{ $index }})">+ Add Question</button>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="button" id="add-heading-btn" class="btn" style="background:#f0f0f0; color:#333; margin-top:10px;">
                + Add New Heading Section
            </button>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 16px;">Save Settings</button>
        </div>
    </form>
</div>

<script>
    let sectionIndex = {{ count($sections ?? []) > 0 ? count($sections) : 1 }};

    document.getElementById('add-heading-btn').addEventListener('click', function() {
        const container = document.getElementById('faq-sections-container');
        const currentIndex = sectionIndex++;
        
        const html = `
            <div class="faq-heading-card" data-index="${currentIndex}">
                <div class="faq-heading-card-header">
                    <input type="text" name="headings[${currentIndex}]" placeholder="Enter Heading (e.g. New Section)">
                    <button type="button" class="btn-remove-heading" onclick="removeHeading(this)">Delete Heading</button>
                </div>
                <div class="faqs-container">
                    <div class="faq-row">
                        <button type="button" class="btn-remove-faq" onclick="removeFaq(this)"><i class="fa-solid fa-trash"></i></button>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label class="form-label" style="font-size: 13px;">Question</label>
                            <input type="text" name="questions[${currentIndex}][]" class="form-input" placeholder="Enter Question">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 13px;">Answer</label>
                            <textarea name="answers[${currentIndex}][]" class="form-input" rows="2" placeholder="Enter Answer"></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px; margin-top: 10px;" onclick="addFaq(this, ${currentIndex})">+ Add Question</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });

    function addFaq(btnElement, index) {
        const faqsContainer = btnElement.previousElementSibling;
        const html = `
            <div class="faq-row">
                <button type="button" class="btn-remove-faq" onclick="removeFaq(this)"><i class="fa-solid fa-trash"></i></button>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label class="form-label" style="font-size: 13px;">Question</label>
                    <input type="text" name="questions[${index}][]" class="form-input" placeholder="Enter Question">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="font-size: 13px;">Answer</label>
                    <textarea name="answers[${index}][]" class="form-input" rows="2" placeholder="Enter Answer"></textarea>
                </div>
            </div>
        `;
        faqsContainer.insertAdjacentHTML('beforeend', html);
    }

    function removeFaq(btnElement) {
        btnElement.closest('.faq-row').remove();
    }

    function removeHeading(btnElement) {
        if(confirm('Are you sure you want to delete this heading and all its FAQs?')) {
            btnElement.closest('.faq-heading-card').remove();
        }
    }
</script>
@endsection
