<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminCategory extends Model
{
    protected $table = 'admin_categories';
    protected $guarded = [];
    protected $casts = ['show_in_nav' => 'boolean', 'show_home' => 'boolean'];

    public function parent() { return $this->belongsTo(self::class, 'parent_id'); }
    public function children() { return $this->hasMany(self::class, 'parent_id'); }
    public function products() { return $this->belongsToMany(AdminProduct::class, 'admin_category_product', 'category_id', 'product_id'); }
    public function faqs() { return $this->hasMany(AdminCategoryFaq::class, 'category_id'); }
}
