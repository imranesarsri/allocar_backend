<?php

use App\Http\Controllers\pkg_Blogs\BlogAuthorController;
use App\Http\Controllers\pkg_Blogs\BlogCategoryController;
use App\Http\Controllers\pkg_Blogs\BlogCommentController;
use App\Http\Controllers\pkg_Blogs\BlogImageController;
use App\Http\Controllers\pkg_Blogs\BlogPostController;
use App\Http\Controllers\pkg_Blogs\BlogTagController;
use Illuminate\Support\Facades\Route;


/**
 * pkg blogs
 */

Route::prefix('/blogs')->group(function () {


        Route::get('/recentBlogs', [BlogPostController::class, 'recent']);


    // Image
    Route::post('/{blogPostId}/image', [BlogImageController::class, 'uploadSingle']);
    Route::post('/{blogPostId}/update', [BlogImageController::class, 'update']);
    Route::delete('/{blogPostId}', [BlogImageController::class, 'delete']);

    // Blog Comments Routes
    Route::middleware(['ValidateId:blog_comment_id', 'checkIdExists:blog_comments,blog_comment_id'])->group(function () {
        Route::get('/comment/{blog_comment_id?}', [BlogCommentController::class, 'find']);
        Route::put('/comment/{blog_comment_id?}', [BlogCommentController::class, 'update']);
        Route::delete('/comment/{blog_comment_id?}', [BlogCommentController::class, 'destroy']);
    });
    Route::get('/comments', [BlogCommentController::class, 'index']);
    Route::get('/comments-paginate', [BlogCommentController::class, 'pagination']);
    Route::post('/comments', [BlogCommentController::class, 'store']);

    // Blog Tags Routes
    Route::middleware(['ValidateId:blog_tag_id', 'checkIdExists:blog_tags,blog_tag_id'])->group(function () {
        Route::get('/tag/{blog_tag_id?}', [BlogTagController::class, 'find']);
        Route::put('/tag/{blog_tag_id?}', [BlogTagController::class, 'update']);
        Route::delete('/tag/{blog_tag_id?}', [BlogTagController::class, 'destroy']);
    });
    Route::get('/tags', [BlogTagController::class, 'index']);
    Route::get('/tags-paginate', [BlogTagController::class, 'pagination']);
    Route::post('/tags', [BlogTagController::class, 'store']);

    // Blog Posts Routes
    Route::middleware(['ValidateId:blog_post_id', 'checkIdExists:blog_posts,blog_post_id'])->group(function () {
        Route::get('/post/{blog_post_id?}', [BlogPostController::class, 'find']);
        Route::put('/post/{blog_post_id?}', [BlogPostController::class, 'update']);
        Route::delete('/post/{blog_post_id?}', [BlogPostController::class, 'destroy']);
    });
    Route::get('/posts', [BlogPostController::class, 'index']);
    Route::get('/posts-paginate', [BlogPostController::class, 'pagination']);
    Route::post('/posts', [BlogPostController::class, 'store']);

    // Blog Authors Routes
    Route::middleware(['ValidateId:blog_author_id', 'checkIdExists:blog_authors,blog_author_id'])->group(function () {
        Route::get('/author/{blog_author_id?}', [BlogAuthorController::class, 'find']);
        Route::put('/author/{blog_author_id?}', [BlogAuthorController::class, 'update']);
        Route::delete('/author/{blog_author_id?}', [BlogAuthorController::class, 'destroy']);
    });
    Route::get('/authors', [BlogAuthorController::class, 'index']);
    Route::get('/authors-paginate', [BlogAuthorController::class, 'pagination']);
    Route::post('/authors', [BlogAuthorController::class, 'store']);

    // Blog Categories Routes
    Route::middleware(['ValidateId:blog_category_id', 'checkIdExists:blog_categories,blog_category_id'])->group(function () {
        Route::get('/category/{blog_category_id?}', [BlogCategoryController::class, 'find']);
        Route::put('/category/{blog_category_id?}', [BlogCategoryController::class, 'update']);
        Route::delete('/category/{blog_category_id?}', [BlogCategoryController::class, 'destroy']);
    });
    Route::get('/categories', [BlogCategoryController::class, 'index']);
    Route::get('/categories-paginate', [BlogCategoryController::class, 'pagination']);
    Route::post('/categories', [BlogCategoryController::class, 'store']);
});