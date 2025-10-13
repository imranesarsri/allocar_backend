<?php

namespace App\Http\Controllers\pkg_Parameters;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\pkg_Parameters\CarColorRepository;
use App\Http\Requests\pkg_Parameters\CarColorRequest;

use Illuminate\Http\Request;

class CarColorController extends AppBaseController
{
    protected $carColorRepository;

    public function __construct(CarColorRepository $carColorRepository)
    {
        $this->carColorRepository = $carColorRepository;
    }

    public function index()
    {
        return $this->carColorRepository->getAllCarColors();
    }

    public function paginate()
    {
        return $this->carColorRepository->getPaginatedCarColors();
    }

    public function find()
    {
        return $this->carColorRepository->findCarColorById(request('car_color_id'));
    }

    public function store(CarColorRequest $request)
    {
        return $this->carColorRepository->createCarColor($request);
    }

    public function update(CarColorRequest $request)
    {
        return $this->carColorRepository->updateCarColor(request('car_color_id'), $request);
    }

    public function destroy()
    {
        return $this->carColorRepository->deleteCarColor(request('car_color_id'));
    }
}
