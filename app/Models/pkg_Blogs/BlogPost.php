<?php

namespace App\Models\pkg_Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_posts';
    protected $primaryKey = 'blog_post_id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'blog_author_id',
        'blog_category_id',
        'featured_image',
        'is_published',
        'published_at',
        'views_count'
    ];

    public function author()
    {
        return $this->belongsTo(BlogAuthor::class, 'blog_author_id', 'blog_author_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tags', 'blog_post_id', 'blog_tag_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_post_id', 'blog_post_id');
    }
}
