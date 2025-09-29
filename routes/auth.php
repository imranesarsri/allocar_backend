<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

//Open Routes
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
//Protected Routes
Route::group([
    "middleware" => ["auth:api"]
], function () {
    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh-token", [AuthController::class, "refreshToken"]);
    Route::get("logout", [AuthController::class, "logout"]);
    Route::get('/user/{id}', [AuthController::class, 'getUserById']);
    Route::get('/users', [AuthController::class, 'getAllUsers']);
    Route::patch('/user/{id}', [AuthController::class, 'update']);
});