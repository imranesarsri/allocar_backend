<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogTagRepository;
use App\Http\Requests\pkg_Blogs\BlogTagRequest;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    //
    protected $blogTagRepository;

    public function __construct(BlogTagRepository $blogTagRepository)
    {
        $this->blogTagRepository = $blogTagRepository;
    }

    public function index()
    {
        return $this->blogTagRepository->getAllData();
    }

    public function pagination()
    {
        return $this->blogTagRepository->getDataByPages();
    }

    public function find()
    {
        return $this->blogTagRepository->findData(request('blog_tag_id'));
    }

    public function store(BlogTagRequest $request)
    {
        return $this->blogTagRepository->createData($request);
    }

    public function update(BlogTagRequest $request)
    {
        return $this->blogTagRepository->updateData(request('blog_tag_id'), $request);
    }

    public function destroy()
    {
        return $this->blogTagRepository->deleteData(request('blog_tag_id'));
    }
}
