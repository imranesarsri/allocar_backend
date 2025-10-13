<?php

namespace App\Http\Controllers\pkg_Cars;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Cars\CarImageRepository;
use Illuminate\Http\Request;


class CarImageController extends Controller
{
    protected $carImageRepository;
    public function __construct(CarImageRepository $carImageRepository)
    {
        $this->carImageRepository = $carImageRepository;
    }

    public function uploadMultiple(Request $request)
    {
        return $this->carImageRepository->uploadMultipleImages($request, request('car_id'));
    }

    public function uploadPrimary(Request $request)
    {
        return $this->carImageRepository->uploadPrimaryImage($request, request('car_id'));
    }


    public function updateByID(Request $request)
    {
        return $this->carImageRepository->updateImage($request, request('car_image_id'));
    }

    public function deleteByID()
    {
        return $this->carImageRepository->deleteImage(request('car_image_id'));
    }

}
