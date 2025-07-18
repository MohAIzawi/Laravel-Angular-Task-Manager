<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Pour afficher toutes les routes : php artisan route:list

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResources([
        "tasks" => TasksController::class,
    ]);
});

Route::prefix("auth")->group(function() {
    Route::post("login", [AuthController::class, "login"]);
    Route::post("register", [AuthController::class, "register"]);
    Route::middleware('auth:sanctum')->group(function() {
        Route::post("logout", [AuthController::class, "logout"]);
        Route::get("current-user", [AuthController::class, "currentUser"]);
    });
});
