<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogImageRepository;
use Illuminate\Http\Request;

class BlogImageController extends Controller
{
    protected $blogImageRepository;

    public function __construct(BlogImageRepository $blogImageRepository)
    {
        $this->blogImageRepository = $blogImageRepository;
    }

    public function uploadSingle(Request $request)
    {
        return $this->blogImageRepository->uploadSingleImage($request, request('blogPostId'));
    }

    public function update(Request $request)
    {
        return $this->blogImageRepository->updateImage($request, request('blogPostId'));
    }

    public function delete()
    {
        return $this->blogImageRepository->deleteImage(request('blogPostId'));
    }

}
