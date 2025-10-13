<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogCategoryRepository;
use App\Http\Requests\pkg_Blogs\BlogCategoryRequest;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    //
    protected $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    public function index()
    {
        return $this->blogCategoryRepository->getAllData();
    }

    public function pagination()
    {
        return $this->blogCategoryRepository->getDataByPages();
    }

    public function find()
    {
        return $this->blogCategoryRepository->findData(request('blog_category_id'));
    }

    public function store(BlogCategoryRequest $request)
    {
        return $this->blogCategoryRepository->createData($request);
    }

    public function update( BlogCategoryRequest $request)
    {
        return $this->blogCategoryRepository->updateData(request('blog_category_id') ,$request);
    }

    public function destroy()
    {
        return $this->blogCategoryRepository->deleteData(request('blog_category_id'));
    }
}