@extends('admin.layout')
@section('title', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('heading', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('content')

@php
    $v = fn($key, $default = '') => old($key, $item[$key] ?? $default);
    $editing = (bool)$item;
    $resolveImg = fn($path) => empty($path) ? '' : (\Illuminate\Support\Str::startsWith($path, ['storage/', 'uploads/', 'images/']) ? asset($path) . '?v=' . (@filemtime(public_path($path)) ?: 1) : asset('storage/' . $path) . '?v=' . (@filemtime(storage_path('app/public/' . $path)) ?: 1));
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
                    <option value="published" @selected(strtolower(trim($v('status', 'published'))) === 'published')>Published</option>
                    <option value="draft" @selected(strtolower(trim($v('status', 'published'))) === 'draft')>Draft</option>
                    <option value="inactive" @selected(strtolower(trim($v('status', 'published'))) === 'inactive')>Inactive</option>
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
        <h3>Page Content</h3>
        <div class="form-grid">
            <div class="field">
                <label>Page Heading</label>
                <input name="heading" value="{{ $v('heading') }}">
            </div>
            
            <div class="field">
                <label>Menu Position</label>
                <input type="number" name="position" value="{{ $v('position', 0) }}">
            </div>
            
            <div class="field">
                <label>Appearance / Template</label>
                <select name="appearance">
                    <option @selected($v('appearance') === 'Default')>Default</option>
                    <option @selected($v('appearance') === 'Policy')>Policy</option>
                    <option @selected($v('appearance') === 'Landing Page')>Landing Page</option>
                    <option @selected($v('appearance') === 'Contact')>Contact</option>
                </select>
            </div>
            
            <div class="field">
                <label>Image Alt Text</label>
                <input name="alt_text" value="{{ $v('alt_text') }}">
            </div>
            
            <div class="field full">
                <label>Page Content</label>
                <textarea name="content" style="min-height:340px">{{ $v('content') }}</textarea>
            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                ...window.tinyMceUploadConfig,
                selector: 'textarea[name="content"]',
                height: 400,
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