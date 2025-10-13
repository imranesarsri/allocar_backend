<?php

namespace App\Models\pkg_Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAuthor extends Model
{
    //
    use HasFactory;

    protected $table = 'blog_authors';
    protected $primaryKey = 'blog_author_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'bio',
        'email'
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'blog_author_id');
    }
}