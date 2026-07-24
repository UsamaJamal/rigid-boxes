<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminContentController extends Controller
{
    private function modules(): array
    {
        return [
            'products' => ['title' => 'Products', 'singular' => 'Product'],
            'categories' => ['title' => 'Categories', 'singular' => 'Category'],
            'blogs' => ['title' => 'Blog Posts', 'singular' => 'Blog Post'],
            'pages' => ['title' => 'Static Pages', 'singular' => 'Page'],
        ];
    }

    private function data(): array
    {
        return ['products' => DB::table('admin_products')->get()->map(fn($r)=>(array)$r)->all(), 'categories' => DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all(), 'blogs' => DB::table('admin_blogs')->get()->map(fn($r)=>(array)$r)->all(), 'pages' => DB::table('admin_pages')->get()->map(fn($r)=>(array)$r)->all()];
    }

    public function dashboard()
    {
        return view('admin.dashboard', ['data' => $this->data(), 'modules' => $this->modules()]);
    }

    public function index(string $module)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        return view('admin.index', ['module' => $module, 'meta' => $this->modules()[$module], 'items' => $this->data()[$module]]);
    }

    public function create(string $module)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        return view("admin.forms.{$module}", $this->formData($module, null));
    }

    public function edit(string $module, string $id)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        $item = collect($this->data()[$module])->firstWhere('id', $id);
        abort_unless($item, 404);
        return view("admin.forms.{$module}", $this->formData($module, $item));
    }

    private function formData(string $module, ?array $item): array
    {
        $data = $this->data();
        $formData = compact('module', 'item') + [
            'meta' => $this->modules()[$module],
            'categories' => $data['categories'],
            'products' => $data['products'],
        ];

        if ($module === 'categories' && !empty($item['id'])) {
            $formData['categoryFaqs'] = DB::table('admin_category_faqs')
                ->where('category_id', $item['id'])
                ->orderBy('id')
                ->get()
                ->map(fn($faq) => (array) $faq)
                ->all();
        } else {
            $formData['categoryFaqs'] = [];
        }

        if ($module === 'products' && !empty($item['id'])) {
            $formData['productFaqs'] = DB::table('admin_product_faqs')
                ->where('product_id', $item['id'])
                ->orderBy('id')
                ->get()
                ->map(fn($faq) => (array) $faq)
                ->all();
        } else {
            $formData['productFaqs'] = [];
        }

        return $formData;
    }

    public function store(Request $request, string $module)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        return $this->persist($request, $module, (string) Str::uuid());
    }

    public function update(Request $request, string $module, string $id)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        return $this->persist($request, $module, $id);
    }

    private function persist(Request $request, string $module, string $id)
    {
        $request->validate(['title' => 'required|string|max:255', 'slug' => 'nullable|string|max:255']);
        $table = ['products'=>'admin_products','categories'=>'admin_categories','blogs'=>'admin_blogs','pages'=>'admin_pages'][$module];
        $columns = [
            'products' => ['title','slug','status','show_home','image','images','description','long_description','alt_text','box_style','material','printing','finishing','dimensions','moq','turnaround','meta_title','meta_description','meta_keywords','robots','schema','related'],
            'categories' => ['title','slug','status','parent_id','show_in_nav','show_home','image','icon','hero_image','banner_image','hero_title','hero_badge','hero_description','description','products_heading','products_description','feature_title','why_choose_title','why_choose_description','meta_title','meta_description','meta_keywords','robots','schema'],
            'blogs' => ['title','slug','status','show_home','image','author_name','publish_date','blog_category','tags','excerpt','content','author_description','alt_text','meta_title','meta_description','meta_keywords','robots','schema'],
            'pages' => ['title','slug','status','show_home','image','heading','content','position','appearance','alt_text','meta_title','meta_description','meta_keywords','robots','schema'],
        ][$module];
        $existing = ctype_digit((string)$id) ? DB::table($table)->where('id',(int)$id)->first() : null;
        $fields = $columns;
        $payload = collect($request->except(['_token','_method','images','existing_images','image','hero_image','banner_image','icon','categories','related','faq_question','faq_answer']))->only($fields)->all();
        $payload['title'] = $request->title; $payload['slug'] = Str::slug($request->slug ?: $request->title); $payload['updated_at'] = now();

        foreach (['show_home', 'show_in_nav'] as $checkboxField) {
            if (in_array($checkboxField, $fields, true)) {
                $payload[$checkboxField] = $request->boolean($checkboxField) ? 1 : 0;
            }
        }

        if ($module === 'categories') {
            $payload['parent_id'] = $request->filled('parent_id') ? $request->input('parent_id') : null;
        }

        foreach (['image', 'hero_image', 'banner_image', 'icon'] as $field) {
            if ($request->hasFile($field)) {
                if (in_array($field, $fields)) $payload[$field] = $request->file($field)->store('admin', 'public');
            }
        }
        if (in_array('images', $fields, true)) {
            $galleryFiles = array_filter((array) $request->file('images'), function ($file) {
                return $file && $file->isValid();
            });

            if ($galleryFiles) {
                $newImages = collect($galleryFiles)
                    ->map(fn ($file) => $file->store('admin', 'public'))
                    ->values()
                    ->all();
                $existingImages = json_decode((string) $request->input('existing_images', '[]'), true) ?: [];
                if ($existing && !empty($existing->images)) {
                    $dbImages = is_string($existing->images) ? (json_decode($existing->images, true) ?: []) : (array) $existing->images;
                    $existingImages = array_values(array_unique(array_merge($existingImages, $dbImages)));
                }
                $payload['images'] = json_encode(array_values(array_merge($existingImages, $newImages)));
            }
        }
        foreach (['images','related'] as $jsonField) if (array_key_exists($jsonField,$payload) && is_array($payload[$jsonField])) $payload[$jsonField] = json_encode($payload[$jsonField]);
        if ($existing) DB::table($table)->where('id',$existing->id)->update($payload); else { $payload['created_at']=now(); $id=DB::table($table)->insertGetId($payload); }
        if ($module==='products') { DB::table('admin_category_product')->where('product_id',$id)->delete(); foreach((array)$request->input('categories',[]) as $cat) if($cat) DB::table('admin_category_product')->insert(['product_id'=>$id,'category_id'=>$cat]); DB::table('admin_product_faqs')->where('product_id',$id)->delete(); foreach((array)$request->input('faq_question',[]) as $i=>$q) if($q && !empty($request->input('faq_answer')[$i]??'')) DB::table('admin_product_faqs')->insert(['product_id'=>$id,'question'=>$q,'answer'=>$request->input('faq_answer')[$i],'created_at'=>now(),'updated_at'=>now()]); }
        if ($module==='categories') { DB::table('admin_category_faqs')->where('category_id',$id)->delete(); foreach((array)$request->input('faq_question',[]) as $i=>$q) if($q && !empty($request->input('faq_answer')[$i]??'')) DB::table('admin_category_faqs')->insert(['category_id'=>$id,'question'=>$q,'answer'=>$request->input('faq_answer')[$i],'created_at'=>now(),'updated_at'=>now()]); }
        return redirect()->route('admin.module.index', $module)->with('success', $this->modules()[$module]['singular'].' saved successfully.');
    }

    public function destroy(string $module, string $id)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        $table = ['products'=>'admin_products','categories'=>'admin_categories','blogs'=>'admin_blogs','pages'=>'admin_pages'][$module]; DB::table($table)->where('id',$id)->delete();
        return back()->with('success', 'Item deleted successfully.');
    }
}
