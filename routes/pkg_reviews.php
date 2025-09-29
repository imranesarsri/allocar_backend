<?php

use App\Http\Controllers\pkg_Reviews\AgencyReviewController;
use App\Http\Controllers\pkg_Reviews\CarReviewController;
use Illuminate\Support\Facades\Route;


/** 
 * pkg reviews 
*/

Route::prefix('review')->group(function () {
    Route::prefix('/car')->group(function () {
        Route::get('/', [CarReviewController::class, 'index'])->name('car-review.index');
        Route::get('/paginate', [CarReviewController::class, 'pagination'])->name('car-review.paginate');
        Route::post('/store', [CarReviewController::class, 'store'])->name('car-review.store');

        Route::middleware(['ValidateId:car_review_id', 'checkIdExists:car_reviews,car_review_id'])->group(function () {
            Route::get('/{car_review_id}', [CarReviewController::class, 'find'])->name('car-review.show');
            Route::delete('/{car_review_id}', [CarReviewController::class, 'destroy'])->name('car-review.delete');
            Route::put('/{car_review_id}', [CarReviewController::class, 'update'])->name('car-review.update');
        });
    });

    Route::prefix('/agency')->group(function () {
        Route::get('/', [AgencyReviewController::class, 'index'])->name('agency-review.index');
        Route::get('/paginate', [AgencyReviewController::class, 'pagination'])->name('agency-review.paginate');
        Route::post('/store', [AgencyReviewController::class, 'store'])->name('agency-review.store');

        Route::middleware(['ValidateId:agency_review_id', 'checkIdExists:agency_reviews,agency_review_id'])->group(function () {
            Route::get('/{agency_review_id}', [AgencyReviewController::class, 'find'])->name('agency-review.show');
            Route::delete('/{agency_review_id}', [AgencyReviewController::class, 'destroy'])->name('agency-review.delete');
            Route::put('/{agency_review_id}', [AgencyReviewController::class, 'update'])->name('agency-review.update');
        });
    });
});