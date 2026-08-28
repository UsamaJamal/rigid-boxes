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
                <label>Author Name *</label>
                <input name="title" required value="{{ $v('title') }}" placeholder="Enter author name">
            </div>
            
            <div class="field">
                <label>URL Slug</label>
                <input name="slug" value="{{ $v('slug') }}" placeholder="auto-generated-from-name">
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
                <label>Profile Image</label>
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
        <h3>Social Links & Description</h3>
        <div class="form-grid">
            <div class="field">
                <label>Facebook URL</label>
                <input type="url" name="facebook" value="{{ $v('facebook') }}" placeholder="https://facebook.com/author">
            </div>
            
            <div class="field">
                <label>Twitter URL</label>
                <input type="url" name="twitter" value="{{ $v('twitter') }}" placeholder="https://twitter.com/author">
            </div>
            
            <div class="field">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin" value="{{ $v('linkedin') }}" placeholder="https://linkedin.com/in/author">
            </div>
            
            <div class="field full">
                <label>Author Description</label>
                <textarea name="description" rows="5" placeholder="Short biography about the author...">{{ $v('description') }}</textarea>
            </div>
        </div>
    </div>
    
    <div class="form-actions">
        <a href="{{ route('admin.module.index', $module) }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save {{ $meta['singular'] }}</button>
    </div>
</form>

@endsection
