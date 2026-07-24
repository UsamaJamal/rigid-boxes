@extends('admin.layout')
@section('title', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('heading', ($item ? 'Edit ' : 'Add ') . $meta['singular'])
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

@php
    $v = fn($key, $default = '') => old($key, $item[$key] ?? $default);
    $editing = (bool)$item;
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
    <div class="section">
        <h3>Article Details</h3>
        <div class="form-grid">
            <div class="field">
                <label>Author Name</label>
                <input name="author_name" value="{{ $v('author_name') }}">
            </div>
            
            <div class="field">
                <label>Publish Date</label>
                <input type="date" name="publish_date" value="{{ $v('publish_date') }}">
            </div>
            
            <div class="field">
                <label>Category</label>
                @php
                    $blogCategory = strtolower(trim((string) $v('blog_category')));
                    $blogCategory = [
                        'packaging basics' => 'packaging',
                        'marketing tips' => 'marketing',
                        'sustainable packaging guide' => 'sustainability',
                        'production & moq tips' => 'production',
                        'design tips' => 'design',
                        'industry specific studies' => 'industry',
                    ][$blogCategory] ?? $blogCategory;
                @endphp
                <select name="blog_category">
                    <option value="">Select a blog category</option>
                    <option value="packaging" {{ $blogCategory === 'packaging' ? 'selected' : '' }}>Packaging Basics</option>
                    <option value="marketing" {{ $blogCategory === 'marketing' ? 'selected' : '' }}>Marketing Tips</option>
                    <option value="sustainability" {{ $blogCategory === 'sustainability' ? 'selected' : '' }}>Sustainable Packaging Guide</option>
                    <option value="production" {{ $blogCategory === 'production' ? 'selected' : '' }}>Production &amp; MOQ Tips</option>
                    <option value="design" {{ $blogCategory === 'design' ? 'selected' : '' }}>Design Tips</option>
                    <option value="industry" {{ $blogCategory === 'industry' ? 'selected' : '' }}>Industry Specific Studies</option>
                </select>
            </div>
            
            <div class="field">
                <label>Tags / Tag Cloud</label>
                <input name="tags" value="{{ $v('tags') }}" placeholder="rigid boxes, luxury, packaging">
            </div>
            
            <div class="field full">
                <label>Excerpt</label>
                <textarea name="excerpt">{{ $v('excerpt') }}</textarea>
            </div>
            
            <div class="field full">
                <label>Article Content</label>
                <textarea name="content" style="min-height:300px">{{ $v('content') }}</textarea>
            </div>
            
            <div class="field full">
                <label>Author Description</label>
                <textarea name="author_description">{{ $v('author_description') }}</textarea>
            </div>
            
            <div class="field">
                <label>Image Alt Text</label>
                <input name="alt_text" value="{{ $v('alt_text') }}">
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
            <label class="check"><input type="checkbox" name="set_home" value="1" @checked($v('set_home'))> Feature on home</label>
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
                selector: 'textarea[name="content"], textarea[name="excerpt"], textarea[name="author_description"]',
                height: 360,
                plugins: 'code advlist autolink lists link image charmap preview anchor searchreplace visualblocks fullscreen insertdatetime media table help wordcount',
                toolbar: 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | code fullscreen preview',
                block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
                branding: false,
                promotion: false,
                content_style: 'body { font-family:"DM Sans",sans-serif; font-size:14px; line-height:1.6; }'
            });
            // Keep the full article editor taller while the short rich-text fields stay compact.
            ['excerpt', 'author_description'].forEach(function (name) {
                const editor = tinymce.get(name);
                if (editor) editor.theme.resizeTo(null, 260);
            });
        }
    });
</script>
@endsection
