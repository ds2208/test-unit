<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ColorsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::delete("/handle-route", [Controller::class, 'handleRoute'])->name('handle_route');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/colors')->group(function () {
    Route::get("/list", [ColorsController::class, 'list']);
    Route::get("/{id}", [ColorsController::class, 'getColorById']);
    Route::post("/create", [ColorsController::class, 'create']);
    Route::patch("/{color}/edit", [ColorsController::class, 'edit']);
    Route::patch("/{color}/change-status", [ColorsController::class, 'changeStatus']);
    Route::delete("/{color}/delete", [ColorsController::class, 'delete']);
    
});