<?php

use App\Http\Controllers\pkg_Cars\CarController;
use App\Http\Controllers\pkg_Cars\CarImageController;
use App\Http\Controllers\pkg_Bookings\BookingController;
use Illuminate\Support\Facades\Route;


Route::post('/cars/{car_id}/images', [CarImageController::class, 'uploadMultiple']); // multiple
Route::post('/cars/{car_id}/primary', [CarImageController::class, 'uploadPrimary']);    // single
Route::post('/car-images/{car_image_id}/update', [CarImageController::class, 'updateByID']);
Route::delete('/car-images/{car_image_id}', [CarImageController::class, 'deleteByID']);


Route::prefix('cars')->group(function () {

    Route::get('/discount-count', [CarController::class, 'getDiscountCount']);
    Route::get('/top8brands', [CarController::class, 'getTop8Brands']);
    Route::get('/top8models', [CarController::class, 'getTop8Models']);
    Route::get('/top8cities', [CarController::class, 'getTop8Cities']);
    Route::get('/topCities', [CarController::class, 'getAllCitiesWithCars']);
    Route::get('/brands', [CarController::class, 'getBrands']);
    Route::get('/filter-by-brand', [CarController::class, 'filterByAttributes']);
    Route::get('/latest', [CarController::class, 'getLatestCars']);
    Route::get('/count', [CarController::class, 'getCount']);
    Route::get('/count-cars', [CarController::class, 'getCountCars']);

    Route::get('/models/{brand_id}', [CarController::class, 'getModelsByBrand']);
    Route::get('/years/{model_id}', [CarController::class, 'getYearsByModel']);
    Route::get('/search', [CarController::class, 'search']);
    Route::get('/', [CarController::class, 'index']);
    Route::get('/promotional', [CarController::class, 'getPromotionalCars']);
    Route::get('/topCiteis', [CarController::class, 'topCiteis']);
    Route::get('/featured', [CarController::class, 'featuredCars']);
    Route::get('/paginate', [CarController::class, 'paginate']);
    Route::post('/store', [CarController::class, 'store']);
    Route::get('/{car_id}', [CarController::class, 'find']);
    Route::put('/{car_id}', [CarController::class, 'update']);
    Route::delete('/{car_id}', [CarController::class, 'destroy']);

Route::post('/bookings', [BookingController::class, 'store']);
});
