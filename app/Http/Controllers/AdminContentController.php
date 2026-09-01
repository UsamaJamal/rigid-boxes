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
            'pages' => ['title' => 'Dynamic Pages', 'singular' => 'Page'],
            'authors' => ['title' => 'Authors', 'singular' => 'Author'],
        ];
    }

    private function data(): array
    {
        return ['products' => DB::table('admin_products')->get()->map(fn($r)=>(array)$r)->all(), 'categories' => DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all(), 'blogs' => DB::table('admin_blogs')->get()->map(fn($r)=>(array)$r)->all(), 'pages' => DB::table('admin_pages')->get()->map(fn($r)=>(array)$r)->all(), 'authors' => DB::table('admin_authors')->get()->map(fn($r)=>(array)$r)->all()];
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
            'authors' => $data['authors'],
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

    public function uploadTinyMceMedia(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:51200',
                'mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4,video/webm,video/ogg',
            ],
        ]);

        $file = $request->file('file');
        $path = $file->storeAs('admin/tinymce', $file->getClientOriginalName(), 'public');

        return response()->json([
            'location' => asset('storage/' . $path),
        ]);
    }

    private function persist(Request $request, string $module, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'schema' => 'nullable|string',
        ]);

        if ($request->filled('schema')) {
            $normalizedSchema = $this->normalizeSchemaInput($request->input('schema'));

            if ($normalizedSchema === null) {
                return back()
                    ->withInput()
                    ->withErrors(['schema' => 'Enter valid JSON-LD. You may paste one schema, an array of schemas, or multiple complete JSON objects.']);
            }

            $request->merge(['schema' => $normalizedSchema]);
        }
        $table = ['products'=>'admin_products','categories'=>'admin_categories','blogs'=>'admin_blogs','pages'=>'admin_pages','authors'=>'admin_authors'][$module];
        $columns = [
            'products' => ['title','slug','status','show_home','image','hover_image','images','description','long_description','alt_text','box_style','material','printing','finishing','dimensions','moq','turnaround','meta_title','meta_description','meta_keywords','robots','schema','related'],
            'categories' => ['title','slug','status','parent_id','show_in_nav','show_home','image','icon','hero_image','banner_image','hero_title','hero_badge','hero_description','description','products_heading','products_description','feature_title','why_choose_title','why_choose_description','meta_title','meta_description','meta_keywords','robots','schema'],
            'blogs' => ['title','slug','status','show_home','image','author_id','author_name','publish_date','blog_category','tags','excerpt','content','author_description','alt_text','meta_title','meta_description','meta_keywords','robots','schema'],
            'pages' => ['title','slug','status','show_home','image','heading','content','position','appearance','alt_text','meta_title','meta_description','meta_keywords','robots','schema'],
            'authors' => ['title','slug','status','description','image','facebook','twitter','linkedin'],
        ][$module];
        $existing = ctype_digit((string)$id) ? DB::table($table)->where('id',(int)$id)->first() : null;
        $fields = $columns;
        $payload = collect($request->except(['_token','_method','images','existing_images','image','hover_image','hero_image','banner_image','icon','categories','related','faq_question','faq_answer']))->only($fields)->all();
        \Log::info('AdminContentController payload for ' . $module, $payload);
        $payload['title'] = $request->title; $payload['slug'] = Str::slug($request->slug ?: $request->title); $payload['updated_at'] = now();

        if (in_array('status', $fields, true)) {
            $payload['status'] = $request->filled('status') ? strtolower(trim($request->input('status'))) : ($existing->status ?? 'published');
        }

        if (isset($payload['publish_date']) && !empty(trim($payload['publish_date']))) {
            $payload['publish_date'] = date('Y-m-d', strtotime(trim($payload['publish_date'])));
        }

        foreach (['show_home', 'show_in_nav'] as $checkboxField) {
            if (in_array($checkboxField, $fields, true)) {
                $payload[$checkboxField] = $request->boolean($checkboxField) ? 1 : 0;
            }
        }

        if ($module === 'categories') {
            $payload['parent_id'] = $request->filled('parent_id') ? $request->input('parent_id') : null;
        }

        foreach (['image', 'hover_image', 'hero_image', 'banner_image', 'icon'] as $field) {
            if (in_array($field, $fields) && $request->input('remove_' . $field) == '1') {
                $payload[$field] = null;
            }
            if ($request->hasFile($field)) {
                if (in_array($field, $fields)) {
                    $file = $request->file($field);
                    $ext = $file->getClientOriginalExtension();
                    $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $baseName . '.' . $ext;
                    $uploadPath = public_path('uploads');
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0775, true);
                    }
                    $file->move($uploadPath, $fileName);
                    $payload[$field] = 'uploads/' . $fileName;
                }
            }
        }
        if (in_array('images', $fields, true)) {
            $existingImages = json_decode((string) $request->input('existing_images', '[]'), true) ?: [];
            
            $galleryFiles = array_filter((array) $request->file('images'), function ($file) {
                return $file && $file->isValid();
            });

            $newImages = [];
            if ($galleryFiles) {
                $uploadPath = public_path('uploads');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }
                $newImages = collect($galleryFiles)
                    ->map(function ($file) use ($uploadPath) {
                        $ext = $file->getClientOriginalExtension();
                        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $fileName = $baseName . '.' . $ext;
                        $file->move($uploadPath, $fileName);
                        return 'uploads/' . $fileName;
                    })
                    ->values()
                    ->all();
            }
            
            $payload['images'] = json_encode(array_values(array_merge($existingImages, $newImages)));
        }
        if (in_array('related', $fields)) $payload['related'] = json_encode(array_values(array_map('intval', (array) $request->input('related', []))));
        foreach (['images'] as $jsonField) if (array_key_exists($jsonField,$payload) && is_array($payload[$jsonField])) $payload[$jsonField] = json_encode($payload[$jsonField]);
        if ($existing) DB::table($table)->where('id',$existing->id)->update($payload); else { $payload['created_at']=now(); $id=DB::table($table)->insertGetId($payload); }
        if ($module==='products') { DB::table('admin_category_product')->where('product_id',$id)->delete(); foreach((array)$request->input('categories',[]) as $cat) if($cat) DB::table('admin_category_product')->insert(['product_id'=>$id,'category_id'=>$cat]); DB::table('admin_product_faqs')->where('product_id',$id)->delete(); foreach((array)$request->input('faq_question',[]) as $i=>$q) if($q && !empty($request->input('faq_answer')[$i]??'')) DB::table('admin_product_faqs')->insert(['product_id'=>$id,'question'=>$q,'answer'=>$request->input('faq_answer')[$i],'created_at'=>now(),'updated_at'=>now()]); }
        if ($module==='categories') { DB::table('admin_category_faqs')->where('category_id',$id)->delete(); foreach((array)$request->input('faq_question',[]) as $i=>$q) if($q && !empty($request->input('faq_answer')[$i]??'')) DB::table('admin_category_faqs')->insert(['category_id'=>$id,'question'=>$q,'answer'=>$request->input('faq_answer')[$i],'created_at'=>now(),'updated_at'=>now()]); }
        return redirect()->route('admin.module.index', $module)->with('success', $this->modules()[$module]['singular'].' saved successfully.');
    }

    /**
     * Store Schema JSON-LD in a single valid JSON value. This also accepts
     * multiple complete objects pasted together from a schema testing tool.
     */
    private function normalizeSchemaInput(string $schema): ?string
    {
        $schema = trim($schema);

        if ($schema === '') {
            return '';
        }

        $decoded = json_decode($schema, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return json_encode($decoded, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        // Some tools copy multiple JSON-LD scripts as consecutive root objects.
        // Convert `}{` between those documents into an array boundary.
        $combined = '[' . preg_replace('/}\s*{/', '},{', $schema) . ']';
        $decoded = json_decode($combined, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded) || $decoded === []) {
            return null;
        }

        return json_encode($decoded, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function destroy(string $module, string $id)
    {
        abort_unless(isset($this->modules()[$module]), 404);
        $table = ['products'=>'admin_products','categories'=>'admin_categories','blogs'=>'admin_blogs','pages'=>'admin_pages','authors'=>'admin_authors'][$module]; DB::table($table)->where('id',$id)->delete();
        return back()->with('success', 'Item deleted successfully.');
    }
}
