<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dashboard', function () {
    return 'welcome to dashboard!';
});

Route::prefix('/colors')->group(function () {
    Route::get("/list", [ColorsController::class, 'list']);
    Route::get("/{id}", [ColorsController::class, 'getColorById']);
    Route::post("/create", [ColorsController::class, 'create'])->middleware(['forgetCacheToken:colors']);
    Route::patch("/{color}/edit", [ColorsController::class, 'edit'])->middleware(['forgetCacheToken:colors']);
    Route::patch("/{color}/change-status", [ColorsController::class, 'changeStatus'])->middleware(['forgetCacheToken:colors']);
    Route::delete("/{color}/delete", [ColorsController::class, 'delete'])->middleware(['forgetCacheToken:colors']);
    
});