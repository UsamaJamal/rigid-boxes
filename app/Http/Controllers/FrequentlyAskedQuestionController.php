<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FrequentlyAskedQuestionController extends Controller
{
  public function index(){
        $rows = DB::table('homepage_contents')->where('section', 'faq_page')->get();
        $settings = [
            'faq_page_title' => 'Frequently Asked Questions',
            'faq_page_sections' => []
        ];
        
        foreach ($rows as $row) {
            $key = $row->field_key;
            $val = $row->value;
            $type = $row->value_type;
            if ($type === 'json' || $type === 'array') {
                $settings[$key] = json_decode($val, true) ?: [];
            } else {
                $settings[$key] = $val;
            }
        }
        
        return view("faqpage", compact('settings'));
    }
}

