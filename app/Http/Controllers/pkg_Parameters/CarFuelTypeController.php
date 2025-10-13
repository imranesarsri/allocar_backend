<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Parameters\CarFuelTypeRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\pkg_Parameters\CarFuelTypeRequest;
use Illuminate\Http\Request;

class CarFuelTypeController extends Controller
{

    protected $carFuelTypeRepository;

    public function __construct(CarFuelTypeRepository $carFuelTypeRepository)
    {
        $this->carFuelTypeRepository = $carFuelTypeRepository;
    }

    public function index()
    {
        return $this->carFuelTypeRepository->getAllCarFuelTypes();
    }

    public function paginate()
    {
        return $this->carFuelTypeRepository->getPaginatedCarFuelTypes();
    }

    public function find()
    {
        return $this->carFuelTypeRepository->findCarFuelTypeById(request('car_fuel_type_id'));
    }

    public function store(CarFuelTypeRequest $request)
    {
        return $this->carFuelTypeRepository->createCarFuelType($request);
    }

    public function update(CarFuelTypeRequest $request)
    {
        return $this->carFuelTypeRepository->updateCarFuelType(request('car_fuel_type_id'), $request);
    }

    public function destroy()
    {
        return $this->carFuelTypeRepository->deleteCarFuelType(request('car_fuel_type_id'));
    }
}