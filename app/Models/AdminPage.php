<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AdminPage extends Model
{
    protected $table = 'admin_pages';
    protected $guarded = [];
    protected $casts = ['show_home' => 'boolean'];
}
