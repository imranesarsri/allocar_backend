<?php

namespace App\Models\pkg_Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostTag extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_post_tags';
    public $timestamps = false; // Pas de timestamps pour une table pivot
    
    protected $fillable = [
        'blog_post_id',
        'blog_tag_id'
    ];

    /**
     * Relation avec BlogPost
     */
    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id', 'blog_post_id');
    }

    /**
     * Relation avec BlogTag
     */
    public function tag()
    {
        return $this->belongsTo(BlogTag::class, 'blog_tag_id', 'blog_tag_id');
    }
}
