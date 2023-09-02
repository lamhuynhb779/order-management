<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StateManagementController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'unset_empty_req_params']], function () {
    // Homepage
    Route::group(['prefix' => '/home'], function () {
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

    // State management
    Route::group(['prefix' => '/order-states'], function () {
        Route::get('/', [StateManagementController::class, 'index']);
        Route::put('/{id}', [StateManagementController::class, 'update']);
    });

    // Rating
    Route::group(['prefix' => '/ratings'], function () {
        Route::post('/', [RatingController::class, 'store']);
    });
});

Addchat::routes();

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
