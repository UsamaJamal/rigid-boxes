<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminProduct extends Model
{
    protected $table = 'admin_products';
    protected $guarded = [];
    protected $casts = ['show_home' => 'boolean', 'images' => 'array', 'related' => 'array'];

    public function categories()
    {
        return $this->belongsToMany(AdminCategory::class, 'admin_category_product', 'product_id', 'category_id');
    }

    public function faqs()
    {
        return $this->hasMany(AdminProductFaq::class, 'product_id');
    }
}
