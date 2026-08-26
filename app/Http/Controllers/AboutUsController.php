<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutUsController extends Controller
{
    public function index(){
        $rows = DB::table('homepage_contents')->where('section', 'about_us_page')->get();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row->field_key] = $row->value;
        }

        $title = $settings['about_meta_title'] ?? ($settings['about_page_title'] ?? 'About Us');
        $metaDescription = $settings['about_meta_description'] ?? '';
        $metaKeywords = $settings['about_meta_keywords'] ?? '';
        $robots = $settings['about_robots'] ?? 'index,follow';

        return view('aboutUs', compact('title', 'metaDescription', 'metaKeywords', 'robots'));
    }
}
