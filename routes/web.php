<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['unset_empty_req_params']], function () {
    // Homepage
    Route::group(['prefix' => '/'], function () {
        Route::get('/', [HomepageController::class, 'index']);
    });

    // Order management
    Route::group(['prefix' => '/orders'], function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/search', [OrderController::class, 'search']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'delete']);
    });
});
