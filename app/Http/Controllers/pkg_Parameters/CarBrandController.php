<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\pkg_Parameters\CarBrandRequest;
use App\Repositories\pkg_Parameters\CarBrandRepository;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{

    protected $carBrandRepository;

    public function __construct(CarBrandRepository $carBrandRepository)
    {
        $this->carBrandRepository = $carBrandRepository;
    }

    public function index()
    {
        return $this->carBrandRepository->getAllCarBrands();
    }

    public function topBrands()
    {
        return $this->carBrandRepository->getTopCarBrands();
    }

    public function paginate()
    {
        return $this->carBrandRepository->getPaginatedCarBrands();
    }

    public function find()
    {
        return $this->carBrandRepository->findCarBrandById(request('car_brand_id'));
    }

    public function store(CarBrandRequest $request)
    {
        return $this->carBrandRepository->createCarBrand($request);
    }

    public function update(CarBrandRequest $request)
    {
        return $this->carBrandRepository->updateCarBrand(request('car_brand_id'), $request);
    }

    public function destroy()
    {
        return $this->carBrandRepository->deleteCarBrand(request('car_brand_id'));
    }
    public function count()
    {
        return $this->carBrandRepository->getBrandsCount();
    }
}
