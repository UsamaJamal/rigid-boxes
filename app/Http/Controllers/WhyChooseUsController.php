<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        return view('whyChooseUs', [
            'title' => 'Why Choose The Rigid Boxes | Custom Packaging',
            'metaDescription' => 'Discover why 500+ brands choose The Rigid Boxes for custom packaging: premium materials, in-house design, low minimums and fast, reliable delivery.',
            'robots' => 'index,follow',
        ]);
    }
}
