<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\pkg_Parameters\CarCityRequest;
use App\Repositories\pkg_Parameters\CarCityRepository;
use Illuminate\Http\Request;

class CarCityController extends AppBaseController
{


    protected $carCityRepository;

    public function __construct(CarCityRepository $carCityRepository)
    {
        $this->carCityRepository = $carCityRepository;
    }


    public function index()
    {
        return $this->carCityRepository->getAllCarCities();
    }


    public function paginate()
    {
        return $this->carCityRepository->getPaginatedCarCities();
    }

    public function find()
    {
        return $this->carCityRepository->findCarCityById(request('car_city_id'));
    }

    public function store(CarCityRequest $request)
    {
        return $this->carCityRepository->createCarCity($request);
    }


    public function update(CarCityRequest $request)
    {
        return $this->carCityRepository->updateCarCity(request('car_city_id'), $request);
    }


    public function destroy()
    {
        return $this->carCityRepository->deleteCarCity(request('car_city_id'));
    }

}