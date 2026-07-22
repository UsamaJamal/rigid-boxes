<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminCategoryFaq extends Model
{
    protected $table = 'admin_category_faqs';
    protected $guarded = [];
    public function category() { return $this->belongsTo(AdminCategory::class, 'category_id'); }
}
