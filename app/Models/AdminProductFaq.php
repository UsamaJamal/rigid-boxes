<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminProductFaq extends Model
{
    protected $table = 'admin_product_faqs';
    protected $guarded = [];
    public function product() { return $this->belongsTo(AdminProduct::class, 'product_id'); }
}
