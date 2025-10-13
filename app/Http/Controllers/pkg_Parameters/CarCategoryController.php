<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Parameters\CarCategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\pkg_Parameters\CarCategoryRequest;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    //
    protected $carCategoryRepository;

    public function __construct(CarCategoryRepository $carCategoryRepository)
    {
        $this->carCategoryRepository = $carCategoryRepository;
    }

    public function index()
    {
        return $this->carCategoryRepository->getAllCarCategories();
    }

    public function paginate()
    {
        return $this->carCategoryRepository->getPaginatedCarCategories();
    }

    public function find()
    {
        return $this->carCategoryRepository->findCarCategoryById(request('car_category_id'));
    }

    public function store(CarCategoryRequest $request)
    {
        return $this->carCategoryRepository->createCarCategory($request);
    }

    public function update(CarCategoryRequest $request)
    {
        return $this->carCategoryRepository->updateCarCategory(request('car_category_id'), $request);
    }

    public function destroy()
    {
        return $this->carCategoryRepository->deleteCarCategory(request('car_category_id'));
    }
}