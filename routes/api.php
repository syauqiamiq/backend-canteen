<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix("v1")->group(function () {
    Route::apiResource("/product-category", ProductCategoryController::class);
    Route::apiResource("/promo", PromoController::class);
    Route::apiResource("/product", ProductController::class);
    Route::prefix("auth")->middleware("api")->group(function () {
        Route::post('register', [UserController::class, "register"]);
        Route::post('login', [UserController::class, "login"]);
        Route::post('logout', [UserController::class, "logout"]);
        Route::post('refresh', [UserController::class, "refresh"]);
        Route::post('me', [UserController::class, "me"]);
    });
});
