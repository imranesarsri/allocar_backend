<?php

namespace App\Models\pkg_Blogs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_comments';
    protected $primaryKey = 'blog_comment_id';
    public $timestamps = true;

    protected $fillable = [
        'blog_post_id',
        'user_id',
        'content'
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id', 'blog_post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
