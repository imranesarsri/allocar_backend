<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogPostRepository;
use App\Http\Requests\pkg_Blogs\BlogPostRequest;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    protected $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function index()
    {
        return $this->blogPostRepository->getAllData();
    }

    public function recent()
    {
        return $this->blogPostRepository->getRecentBlogsWithPagination();
    }
    public function pagination()
    {
        return $this->blogPostRepository->getDataByPages();
    }

    public function find()
    {
        return $this->blogPostRepository->findData(request('blog_post_id'));
    }

    public function store(BlogPostRequest $request)
    {
        return $this->blogPostRepository->createData($request);
    }

    public function update(BlogPostRequest $request)
    {
        return $this->blogPostRepository->updateData(request('blog_post_id'), $request);
    }

    public function destroy()
    {
        return $this->blogPostRepository->deleteData(request('blog_post_id'));
    }
}
