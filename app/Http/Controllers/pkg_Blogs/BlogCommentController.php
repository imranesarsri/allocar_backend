<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogCommentRepository;
use App\Http\Requests\pkg_Blogs\BlogCommentRequest;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    protected $blogCommentRepository;

    public function __construct(BlogCommentRepository $blogCommentRepository)
    {
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function index()
    {
        return $this->blogCommentRepository->getAllData();
    }

    public function pagination()
    {
        return $this->blogCommentRepository->getDataByPages();
    }

    public function find()
    {
        return $this->blogCommentRepository->findData(request('blog_comment_id'));
    }

    public function store(BlogCommentRequest $request)
    {
        return $this->blogCommentRepository->createData($request);
    }

    public function update( BlogCommentRequest $request)
    {
        return $this->blogCommentRepository->updateData(request('blog_comment_id'), $request);
    }

    public function destroy()
    {
        return $this->blogCommentRepository->deleteData(request('blog_comment_id'));
    }
}
