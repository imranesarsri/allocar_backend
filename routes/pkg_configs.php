<?php

use App\Http\Controllers\pkg_Configs\SiteConfigController;
use App\Http\Controllers\pkg_Configs\SiteConfigImageController;
use Illuminate\Support\Facades\Route;


/**
 * pkg config
 */

Route::prefix('config')->group(function () {

    // Light logo images
    Route::post('/logo/{site_config_id}/image', [SiteConfigImageController::class, 'uploadLightLogo']);
    Route::post('/logo/{site_config_id}/update', [SiteConfigImageController::class, 'updateLightLogo']);
    Route::delete('/logo/{site_config_id}', [SiteConfigImageController::class, 'deleteLightLogo']);
    // Dark logo images
    Route::post('/dark-logo/{site_config_id}/image', [SiteConfigImageController::class, 'uploadDarkImage']);
    Route::post('/dark-logo/{site_config_id}/update', [SiteConfigImageController::class, 'updateDarkImage']);
    Route::delete('/dark-logo/{site_config_id}', [SiteConfigImageController::class, 'deleteDarkImage']);

    Route::middleware(['ValidateId:config_id', 'checkIdExists:site_config,config_id'])->group(function () {
        Route::get('/by-id/{config_id}', [SiteConfigController::class, 'find'])->name('config.show');
        Route::delete('/delete/{config_id}', [SiteConfigController::class, 'destroy'])->name('config.delete');
        Route::put('/update/{config_id}', [SiteConfigController::class, 'update'])->name('config.update');
    });

    Route::get('/', [SiteConfigController::class, 'index'])->name('config.index');
    Route::get('/paginate', [SiteConfigController::class, 'pagination'])->name('config.paginate');
    Route::post('/store', [SiteConfigController::class, 'store'])->name('config.store');

});
