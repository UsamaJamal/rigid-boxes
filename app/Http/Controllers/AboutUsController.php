<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        // $pageTitle='About Us'
        return view('aboutUs');
    }
}
