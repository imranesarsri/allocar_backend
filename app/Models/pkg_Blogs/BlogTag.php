<?php

namespace App\Models\pkg_Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_tags';
    protected $primaryKey = 'blog_tag_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tags', 'blog_tag_id', 'blog_post_id');
    }
}