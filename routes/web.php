<?php

use Illuminate\Support\Facades\Route;
//FRONT
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\SearchController;
//ADMIN
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\AdsController as AdminAdsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MeasurementsController as AdminMeasurementsController;
use App\Http\Controllers\Admin\CommentsController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


//FRONT
Route::get('/', [IndexController::class, 'index'])->name('front.index.index');

Route::prefix('/contac-us')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('front.contact.index');
    Route::post('/send-message', [ContactController::class, 'sendMessage'])->name('front.contact.send_message');
});

Route::prefix('/measurements')->group(function () {
    Route::get('/', [MeasurementsController::class, 'index'])->name('front.measurements.index');
    Route::get('/{measurement}/{seoSlug}', [MeasurementsController::class, 'single'])->name('front.measurements.single');
    Route::post('/comment-container', [MeasurementsController::class, 'commentContainer'])->name('front.measurements.partials.comments');
    Route::post('/add-comment', [MeasurementsController::class, 'addComment'])->name('front.measurements.add_comment');
});

Route::prefix('/search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('front.search.index');
});

//AUTH
Auth::routes();

//ADMIN
Route::middleware('auth')->prefix('/admin')->group(function () {

    Route::get('/', [AdminIndexController::class, 'index'])->name('admin.index.index');
    Route::post('/auto-set', [AdminIndexController::class, 'autoSet'])->name('admin.index.auto_set');
    Route::get('/manual-set', [AdminIndexController::class, 'manualSet'])->name('admin.index.manual_set');
    Route::post('/manual-set-now', [AdminIndexController::class, 'manualSetNow'])->name('admin.index.manual_set_now');
    Route::post('/manual-set-old-values', [AdminIndexController::class, 'manualSetOldValues'])->name('admin.index.manual_set_old_values');
    Route::post('/manual-set-engine-positions', [AdminIndexController::class, 'manualSetEnginePositions'])->name('admin.index.manual_set_engine_positions');

    Route::prefix('/ads')->group(function () {
        Route::get('/', [AdminAdsController::class, 'index'])->name('admin.ads.index');
        Route::get('/add', [AdminAdsController::class, 'add'])->name('admin.ads.add');
        Route::post('/insert', [AdminAdsController::class, 'insert'])->name('admin.ads.insert');
        Route::get('/edit/{ad}', [AdminAdsController::class, 'edit'])->name('admin.ads.edit');
        Route::post('/update/{ad}', [AdminAdsController::class, 'update'])->name('admin.ads.update');
        Route::post('/delete', [AdminAdsController::class, 'delete'])->name('admin.ads.delete');
        Route::post('/change-priorities', [AdminAdsController::class, 'changePriorities'])->name('admin.ads.change_priorities');
        Route::post('/change-index', [AdminAdsController::class, 'changeIndex'])->name('admin.ads.change_index');
        Route::post('/delete-photo/{ad}', [AdminAdsController::class, 'deletePhoto'])->name('admin.ads.delete_photo');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.users.index');
        Route::get('/add', [UsersController::class, 'add'])->name('admin.users.add');
        Route::post('/insert', [UsersController::class, 'insert'])->name('admin.users.insert');
        Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::post('/update/{user}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::post('/disable', [UsersController::class, 'disable'])->name('admin.users.disable');
        Route::post('/enable', [UsersController::class, 'enable'])->name('admin.users.enable');
        Route::post('/delete-photo/{user}', [UsersController::class, 'deletePhoto'])->name('admin.users.delete_photo');
        Route::post('/datatable', [UsersController::class, 'datatable'])->name('admin.users.datatable');
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.change_password');
        Route::post('/change-password', [ProfileController::class, 'changePasswordConfirm'])->name('admin.profile.change_password_confirm');
        Route::post('/delete-photo', [ProfileController::class, 'deletePhoto'])->name('admin.profile.delete_photo');
    });

    Route::prefix('/measurements')->group(function () {
        Route::get('/', [AdminMeasurementsController::class, 'index'])->name('admin.measurements.index');
        Route::get('/add', [AdminMeasurementsController::class, 'add'])->name('admin.measurements.add');
        Route::post('/insert', [AdminMeasurementsController::class, 'insert'])->name('admin.measurements.insert');
        Route::get('/edit/{measurement}', [AdminMeasurementsController::class, 'edit'])->name('admin.measurements.edit');
        Route::post('/update/{measurement}', [AdminMeasurementsController::class, 'update'])->name('admin.measurements.update');
        Route::post('/delete', [AdminMeasurementsController::class, 'delete'])->name('admin.measurements.delete');
        Route::post('/change-priorities', [AdminMeasurementsController::class, 'changePriorities'])->name('admin.measurements.change_priorities');
        Route::post('/change-status', [AdminMeasurementsController::class, 'changeStatus'])->name('admin.measurements.change_status');
    });

    Route::prefix('/comments')->group(function () {
        Route::get('/', [CommentsController::class, 'index'])->name('admin.comments.index');
        Route::post('/datatable', [CommentsController::class, 'datatable'])->name('admin.comments.datatable');
        Route::post('/disable', [CommentsController::class, 'disable'])->name('admin.comments.disable');
        Route::post('/enable', [CommentsController::class, 'enable'])->name('admin.comments.enable');
    });
});

Auth::routes();