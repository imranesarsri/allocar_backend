<?php

use App\Http\Controllers\pkg_Subscriptions\AgencySubscriptionController;
use App\Http\Controllers\pkg_Subscriptions\PackageController;
use Illuminate\Support\Facades\Route;


/*
    pkg subscriptions
*/

Route::prefix('subscriptions')->group(function () {

    Route::middleware(['ValidateId:subscription_id', 'checkIdExists:agency_subscriptions,subscription_id'])->group(function () {
        Route::get('/agency/{subscription_id?}', [AgencySubscriptionController::class, 'find'])->name('agency.show');
        Route::put('/agency/{subscription_id?}', [AgencySubscriptionController::class, 'update'])->name('agency.update');
        Route::delete('/agency/{subscription_id?}', [AgencySubscriptionController::class, 'destroy'])->name('agency.destroy');



    });

    Route::get('/agencies', [AgencySubscriptionController::class, 'index'])->name('agency.index');
    Route::get('/agencies-paginate', [AgencySubscriptionController::class, 'pagination'])->name('agency.paginate');
    Route::post('/agency-store', [AgencySubscriptionController::class, 'store'])->name('agency.store');


    Route::middleware(['ValidateId:package_id', 'checkIdExists:packages,package_id'])->group(function () {
        Route::get('/package/{package_id}', [PackageController::class, 'find'])->name('packages.show');
        Route::put('/package/{package_id}', [PackageController::class, 'update'])->name('packages.update');
        Route::delete('/package/{package_id}', [PackageController::class, 'destroy'])->name('packages.destroy');
    });

    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages-paginate', [PackageController::class, 'pagination'])->name('packages.paginate');
    Route::post('/package-store', [PackageController::class, 'store'])->name('packages.store');

    // Route::middleware(['ValidateId:agency_id', 'checkIdExists:agencies,agency_id'])->group(function () {

    Route::post('/packages/analyze', [PackageController::class, 'analyzeAgencyConditions']);
    Route::post('/packages/upgrade', [PackageController::class, 'upgradePackage']);
    Route::post('/packages/force-upgrade', [PackageController::class, 'forceUpgradePackage']);
    // });
    Route::get('/packages/limits', [PackageController::class, 'getCurrentLimits']);


});