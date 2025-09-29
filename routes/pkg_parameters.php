<?php

// Import Controllers
use App\Http\Controllers\pkg_Parameters\{
    CarCityController,
    CarColorController,
    CarModelController,
    CarCategoryController,
    CarBrandController,
    CarFuelTypeController
};
use Illuminate\Support\Facades\Route;



// Grouping all parameter-related routes under 'parameters' prefix
Route::prefix('parameters')->group(function () {

    // Routes for Car Cities with ID validation middleware
    Route::middleware(['ValidateId:car_city_id', 'checkIdExists:car_cities,car_city_id'])->group(function () {
        Route::get('/car-city/{car_city_id?}', [CarCityController::class, 'find'])->name('car-cities.show');
        Route::put('/car-city/{car_city_id?}', [CarCityController::class, 'update'])->name('car-cities.update');
        Route::delete('/car-city/{car_city_id?}', [CarCityController::class, 'destroy'])->name('car-cities.destroy');
    });

    // Routes for Car Cities without ID validation
    Route::get('/car-cities', [CarCityController::class, 'index'])->name('car-cities.index');
    Route::get('/car-cities-paginate', [CarCityController::class, 'paginate'])->name('car-cities.paginate');
    Route::post('/car-cities', [CarCityController::class, 'store'])->name('car-cities.store');



    // Routes for Car Colors with ID validation middleware
    Route::middleware(['ValidateId:car_color_id', 'checkIdExists:car_colors,car_color_id'])->group(function () {
        Route::get('/car-color/{car_color_id?}', [CarColorController::class, 'find'])->name('car-colors.show');
        Route::put('/car-color/{car_color_id?}', [CarColorController::class, 'update'])->name('car-colors.update');
        Route::delete('/car-color/{car_color_id?}', [CarColorController::class, 'destroy'])->name('car-colors.destroy');
    });

    // Routes for Car Colors
    Route::get('/car-colors', [CarColorController::class, 'index'])->name('car-colors.index');
    Route::get('/car-colors-paginate', [CarColorController::class, 'paginate'])->name('car-colors.paginate');
    Route::post('/car-colors', [CarColorController::class, 'store'])->name('car-colors.store');



    // Routes for Car Models with ID validation middleware
    Route::get('/car-models-by-brand-name/{car_brand_name}', [CarModelController::class, 'getModelsByBrandName']);

    Route::middleware(['ValidateId:car_model_id', 'checkIdExists:car_models,car_model_id'])->group(function () {
        Route::get('/car-model/{car_model_id?}', [CarModelController::class, 'find'])->name('car-models.show');
        Route::put('/car-model/{car_model_id?}', [CarModelController::class, 'update'])->name('car-models.update');
        Route::delete('/car-model/{car_model_id?}', [CarModelController::class, 'destroy'])->name('car-models.destroy');
    });

    Route::middleware(['ValidateId:car_brand_id', 'checkIdExists:car_brands,car_brand_id'])->group(function () {
        Route::get('/car-models-by-brand/{car_brand_id}', [CarModelController::class, 'getModelsByBrand']);
    });

    // Routes for Car Models
    Route::get('/car-models', [CarModelController::class, 'index'])->name('car-models.index');
    Route::get('/car-models-paginate', [CarModelController::class, 'paginate'])->name('car-models.paginate');
    Route::post('/car-models', [CarModelController::class, 'store'])->name('car-models.store');
    Route::get('/car-models-by-brand', [CarModelController::class, 'getModelsByBrand'])->name('car-models.by-brand');




    // Routes for Car Categories with ID validation middleware
    Route::middleware(['ValidateId:car_category_id', 'checkIdExists:car_categories,car_category_id'])->group(function () {
        Route::get('/car-category/{car_category_id?}', [CarCategoryController::class, 'find'])->name('car-categories.show');
        Route::put('/car-category/{car_category_id?}', [CarCategoryController::class, 'update'])->name('car-categories.update');
        Route::delete('/car-category/{car_category_id?}', [CarCategoryController::class, 'destroy'])->name('car-categories.destroy');
    });

    // Routes for Car Categories
    Route::get('/car-categories', [CarCategoryController::class, 'index'])->name('car-categories.index');
    Route::get('/car-categories-paginate', [CarCategoryController::class, 'paginate'])->name('car-categories.paginate');
    Route::post('/car-category', [CarCategoryController::class, 'store'])->name('car-categories.store');




    // Routes for Car Brands with ID validation middleware
    Route::middleware(['ValidateId:car_brand_id', 'checkIdExists:car_brands,car_brand_id'])->group(function () {
        Route::get('/car-brand/{car_brand_id?}', [CarBrandController::class, 'find'])->name('car-brands.show');
        Route::put('/car-brand/{car_brand_id?}', [CarBrandController::class, 'update'])->name('car-brands.update');
        Route::delete('/car-brand/{car_brand_id?}', [CarBrandController::class, 'destroy'])->name('car-brands.destroy');
    });

    // Routes for Car Brands
    Route::get('/car-brands', [CarBrandController::class, 'index'])->name('car-brands.index');
    Route::get('/top-car-brands', [CarBrandController::class, 'topBrands'])->name('car-brands.top');
    Route::get('/car-brands-paginate', [CarBrandController::class, 'paginate'])->name('car-brands.paginate');
    Route::post('/car-brands', [CarBrandController::class, 'store'])->name('car-brands.store');
    Route::get('/car-brands-count', [CarBrandController::class, 'count'])->name('car-brands.count');




    // Routes for Car Brands with ID validation middleware
    Route::middleware(['ValidateId:car_fuel_type_id', 'checkIdExists:car_fuel_types,car_fuel_type_id'])->group(function () {
        Route::get('/car-fuel-type/{car_fuel_type_id?}', [CarFuelTypeController::class, 'find'])->name('car-fuel-types.show');
        Route::put('/car-fuel-type/{car_fuel_type_id?}', [CarFuelTypeController::class, 'update'])->name('car-fuel-types.update');
        Route::delete('/car-fuel-type/{car_fuel_type_id?}', [CarFuelTypeController::class, 'destroy'])->name('car-fuel-types.destroy');
    });

    // Routes for Car Fuel Types
    Route::get('/car-fuel-types', [CarFuelTypeController::class, 'index'])->name('car-fuel-types.index');
    Route::get('/car-fuel-types-paginate', [CarFuelTypeController::class, 'paginate'])->name('car-fuel-types.paginate');
    Route::post('/car-fuel-type', [CarFuelTypeController::class, 'store'])->name('car-fuel-types.store');

});
