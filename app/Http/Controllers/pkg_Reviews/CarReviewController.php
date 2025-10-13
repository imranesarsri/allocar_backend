<?php

namespace App\Http\Controllers\pkg_Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Reviews\CarReviewRequest;
use Illuminate\Http\Request;
use App\Repositories\pkg_Reviews\CarReviewRepository;


class CarReviewController extends Controller
{
    //
    protected $carReviewRepository;

    public function __construct(CarReviewRepository $carReviewRepository)
    {
        $this->carReviewRepository = $carReviewRepository;
    }

    public function index()
    {
        return $this->carReviewRepository->getAllData();
    }

    public function pagination()
    {
        return $this->carReviewRepository->getDataByPages();
    }

    public function find()
    {
        return $this->carReviewRepository->findData(request('car_review_id'));
    }

    public function store(CarReviewRequest $request)
    {
        return $this->carReviewRepository->createData($request);
    }

    public function update(CarReviewRequest $request)
    {
        return $this->carReviewRepository->updateData(request('car_review_id'), $request);
    }

    public function destroy()
    {
        return $this->carReviewRepository->deleteData(request('car_review_id'));
    }
}