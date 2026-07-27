@extends('admin.layout')
@section('title', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('heading', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

@php
    $v = fn($key, $default = '') => old($key, $item[$key] ?? $default);
    $editing = (bool)$item;
    $selectedParentId = old('parent_id', $item['parent_id'] ?? '');
    $categoryFaqs = $categoryFaqs ?? [];
    $resolveImg = fn($path) => empty($path) ? '' : (\Illuminate\Support\Str::startsWith($path, ['storage/', 'uploads/', 'images/']) ? asset($path) : asset('storage/' . $path));
@endphp

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
                <label>Category / Card Title *</label>
                <input name="title" required value="{{ $v('title') }}" placeholder="Enter {{ strtolower($meta['singular']) }} title">
            </div>
            
            <div class="field">
                <label>URL Slug</label>
                <input name="slug" value="{{ $v('slug') }}" placeholder="auto-generated-from-title">
            </div>
            
            <div class="field">
                <label>Status</label>
                <select name="status">
                    <option value="draft" @if($v('status') === 'draft') selected @endif>Draft</option>
                    <option value="published" @if($v('status') === 'published') selected @endif>Published</option>
                    <option value="inactive" @if($v('status') === 'inactive') selected @endif>Inactive</option>
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
    <div class="section">
        <h3>Category Hierarchy</h3>
        <div class="form-grid">
            <div class="field">
                <label>Parent Category</label>
                <select name="parent_id">
                    <option value="" @if($selectedParentId === '' || $selectedParentId === null) selected @endif>— Top Level —</option>
                    @foreach($categories as $cat)
                        @if(!$item || (string) $cat['id'] !== (string) $item['id'])
                            <option value="{{ $cat['id'] }}" @if((string) $selectedParentId === (string) $cat['id']) selected @endif>
                                {{ $cat['title'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div class="field">
                <label>Category Card & Navigation Icon</label>
                @if($editing && !empty($item['icon']))
                    <div style="margin-bottom:8px">
                        <img src="{{ $resolveImg($item['icon']) }}" style="height:60px; border-radius:4px; border:1px solid #ddd">
                    </div>
                @endif
                <input type="file" name="icon" accept="image/*">
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Hero & Banner</h3>
        <div class="form-grid">
            <div class="field">
                <label>Hero Title</label>
                <input name="hero_title" value="{{ $v('hero_title') }}">
            </div>
            
            <div class="field">
                <label>Hero Badge</label>
                <input name="hero_badge" value="{{ $v('hero_badge') }}">
            </div>
            
            <div class="field full">
                <label>Hero Description</label>
                <textarea name="hero_description">{{ $v('hero_description') }}</textarea>
            </div>
            
            <div class="field">
                <label>Hero Image</label>
                @if($editing && !empty($item['hero_image']))
                    <div style="margin-bottom:8px">
                        <img src="{{ $resolveImg($item['hero_image']) }}" style="height:60px; border-radius:4px; border:1px solid #ddd">
                    </div>
                @endif
                <input type="file" name="hero_image" accept="image/*">
            </div>
            
            <div class="field">
                <label>Card Hover Banner Image</label>
                @if($editing && !empty($item['banner_image']))
                    <div style="margin-bottom:8px">
                        <img src="{{ $resolveImg($item['banner_image']) }}" style="height:60px; border-radius:4px; border:1px solid #ddd">
                    </div>
                @endif
                <input type="file" name="banner_image" accept="image/*">
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Category Sections</h3>
        <div class="form-grid">
            <div class="field full">
                <label>Category Description</label>
                <textarea name="description" style="min-height:180px">{{ $v('description') }}</textarea>
            </div>
        </div>
    </div>

    <div class="section">
        <h3>Category FAQs</h3>
        <div class="form-grid">
            @for($i = 0; $i < 4; $i++)
                <div class="field">
                    <label>Question {{ $i + 1 }}</label>
                    <input name="faq_question[]" value="{{ old('faq_question.' . $i, $categoryFaqs[$i]['question'] ?? '') }}">
                </div>
                <div class="field">
                    <label>Answer {{ $i + 1 }}</label>
                    <textarea name="faq_answer[]" style="min-height:70px">{{ old('faq_answer.' . $i, $categoryFaqs[$i]['answer'] ?? '') }}</textarea>
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
                    <option value="index,follow">index, follow</option>
                    <option value="noindex,nofollow">noindex, nofollow</option>
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
                <input type="checkbox" name="show_home" value="1" @if((bool) $v('show_home')) checked @endif> 
                Show on home page
            </label>
            <label class="check"><input type="checkbox" name="show_in_nav" value="1" @if((bool) $v('show_in_nav')) checked @endif> Show in navigation</label>
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
                selector: 'textarea[name="description"]',
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
</script>
@endsection
