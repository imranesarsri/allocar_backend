<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\pkg_Parameters\CarModelRequest;
use App\Models\pkg_Parameters\CarBrand;
use App\Repositories\pkg_Parameters\CarModelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarModelController extends Controller
{
    protected $carModelRepository;

    public function __construct(CarModelRepository $carModelRepository, CarBrand $carBrand)
    {
        $this->carModelRepository = $carModelRepository;
    }

    public function index()
    {
        return $this->carModelRepository->getAllCarModels();
    }


    public function getModelsByBrand()
    {
        return $this->carModelRepository->getModelsByBrand(request('car_brand_id'));
    }

    public function getModelsByBrandName(Request $car_brand_name)
    {
        $requestUri = $car_brand_name->server('REQUEST_URI');
        $brand_name = basename($requestUri);
        try {
            $carModels = CarBrand::where('brand_name', $brand_name)->first();
            $brand_id = $carModels->car_brand_id;

            return $this->carModelRepository->getModelsByBrand($brand_id);
        } catch (\Exception $e) {
            Log::error('Error retrieving car models by brand ID: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'brand name is not found'], 500);
        }
    }



    public function paginate()
    {
        return $this->carModelRepository->getPaginatedCarModels();
    }

    public function find()
    {
        return $this->carModelRepository->findCarModelById(request('car_model_id'));
    }

    public function store(CarModelRequest $request)
    {
        return $this->carModelRepository->createCarModel($request);
    }

    public function update(CarModelRequest $request)
    {
        return $this->carModelRepository->updateCarModel(request('car_model_id'), $request);
    }

    public function destroy()
    {
        return $this->carModelRepository->deleteCarModel(request('car_model_id'));
    }
}
