@extends('admin.layout')

@section('title', 'About Us Settings - Admin')
@section('heading', 'About Us Settings')

@section('content')

<div class="card" style="max-width: 900px;">
    <div class="card-header">
        <h2 class="card-title">Manage About Us Page</h2>
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

    <form action="{{ route('admin.aboutus.update') }}" method="POST">
        @csrf
        
        <div style="margin-bottom:30px;">
            <h3 style="font-size:18px; margin-bottom:15px; padding-bottom:8px; border-bottom:1px solid #eaeaea;">SEO Configuration</h3>
            <p style="font-size:13px; color:#666; margin-bottom:15px;">Configure the Search Engine Optimization details for the About Us page.</p>

            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="display:block; margin-bottom:5px; font-weight:bold;">Meta Title</label>
                <input type="text" name="about_meta_title" class="form-input" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;" value="{{ old('about_meta_title', $settings['about_meta_title'] ?? '') }}" placeholder="Enter Meta Title">
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="display:block; margin-bottom:5px; font-weight:bold;">Meta Keywords</label>
                <input type="text" name="about_meta_keywords" class="form-input" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;" value="{{ old('about_meta_keywords', $settings['about_meta_keywords'] ?? '') }}" placeholder="e.g. about rigid boxes, custom packaging company">
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="display:block; margin-bottom:5px; font-weight:bold;">Meta Description</label>
                <textarea name="about_meta_description" class="form-input" rows="4" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;" placeholder="Enter Meta Description">{{ old('about_meta_description', $settings['about_meta_description'] ?? '') }}</textarea>
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="display:block; margin-bottom:5px; font-weight:bold;">Meta Robots</label>
                <select name="about_robots" class="form-input" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:4px;">
                    <option value="index,follow" {{ (old('about_robots', $settings['about_robots'] ?? 'index,follow') == 'index,follow') ? 'selected' : '' }}>Index, Follow</option>
                    <option value="noindex,nofollow" {{ (old('about_robots', $settings['about_robots'] ?? '') == 'noindex,nofollow') ? 'selected' : '' }}>No Index, No Follow</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 16px; background-color: #8D4445; color: white; border: none; border-radius: 4px; cursor: pointer;">Save Settings</button>
        </div>
    </form>
</div>

@endsection
