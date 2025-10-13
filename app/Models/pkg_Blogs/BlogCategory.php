<?php

namespace App\Models\pkg_Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_categories';
    protected $primaryKey = 'blog_category_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active'
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'blog_category_id');
    }
}