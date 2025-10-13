<?php

namespace App\Http\Controllers\pkg_Blogs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Blogs\BlogAuthorRepository;
use App\Http\Requests\pkg_Blogs\BlogAuthorRequest;

class BlogAuthorController extends Controller
{
    protected $blogAuthorRepository;

    public function __construct(BlogAuthorRepository $blogAuthorRepository)
    {
        $this->blogAuthorRepository = $blogAuthorRepository;
    }

    public function index()
    {
        return $this->blogAuthorRepository->getAllData();
    }

    public function pagination()
    {
        return $this->blogAuthorRepository->getDataByPages();
    }

    public function find()
    {
        return $this->blogAuthorRepository->findData(request('blog_author_id'));
    }

    public function store(BlogAuthorRequest $request)
    {
        return $this->blogAuthorRepository->createData($request);
    }

    public function update(BlogAuthorRequest $request)
    {
        return $this->blogAuthorRepository->updateData(request('blog_author_id'),$request);
    }

    public function destroy()
    {
        return $this->blogAuthorRepository->deleteData(request('blog_author_id'));
    }
}
