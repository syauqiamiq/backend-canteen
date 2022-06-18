<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromoController;
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


Route::prefix("admin")->group(function () {
    Route::resource("dashboard", DashboardController::class)->names("dashboard-web");
    Route::resource("product", ProductController::class)->names("product-web");
    Route::resource("product-category", ProductCategoryController::class)->names("product-category-web");
    Route::resource("promo", PromoController::class)->names("promo-web");
});
