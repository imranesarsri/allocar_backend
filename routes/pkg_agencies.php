<?php

use App\Http\Controllers\pkg_Agencies\AgencyController;
use App\Http\Controllers\pkg_Agencies\AgencyImageController;
use Illuminate\Support\Facades\Route;


/**
 * pkg Agence
 */


Route::prefix('agencies')->group(function () {

    // Logo images
    Route::post('/logo/{agency_id}/image', [AgencyImageController::class, 'uploadLogo']);
    Route::post('/logo/{agency_id}/update', [AgencyImageController::class, 'updateLogo']);
    Route::delete('/logo/{agency_id}', [AgencyImageController::class, 'deleteLogo']);
    // cover images
    Route::post('/cover/{agency_id}/image', [AgencyImageController::class, 'uploadCover']);
    Route::post('/cover/{agency_id}/update', [AgencyImageController::class, 'updateCover']);
    Route::delete('/cover/{agency_id}', [AgencyImageController::class, 'deleteCover']);

    Route::get('/', [AgencyController::class, 'index'])->name('agencies.index');
    Route::get('/total', [AgencyController::class, 'count'])->name('agencies.count');
    Route::get('/paginate', [AgencyController::class, 'pagination'])->name('agencies.paginate');
    Route::post('/store', [AgencyController::class, 'store'])->name('agencies.store');

    Route::middleware(['ValidateId:agency_id', 'checkIdExists:agencies,agency_id'])->group(function () {
        Route::get('/{agency_id?}', [AgencyController::class, 'find'])->name('agencies.show');
        Route::put('/{agency_id?}', [AgencyController::class, 'update'])->name('agencies.update');
        Route::delete('/{agency_id?}', [AgencyController::class, 'destroy'])->name('agencies.destroy');
    });


});
