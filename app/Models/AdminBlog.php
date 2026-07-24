<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminBlog extends Model
{
    protected $table = 'admin_blogs';
    protected $guarded = [];
    protected $casts = ['show_home' => 'boolean', 'publish_date' => 'date'];
}
