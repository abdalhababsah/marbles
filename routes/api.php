<?php

use App\Http\Controllers\Api\AboutUsApiController;
use App\Http\Controllers\Api\ContactUsApiController;
use App\Http\Controllers\Api\HomeImagesApiController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Models\Cdr;
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

Route::post('/contact-us', [ContactUsApiController::class, 'store']);
Route::get('/about-us', [AboutUsApiController::class, 'index']);


Route::get('/home-images', [HomeImagesApiController::class, 'index']);

Route::get('/products', [ProductsApiController::class, 'index'])->name('products.index');

Route::get('/categories', [ProductsApiController::class, 'categories'])->name('products.categories');

// Route to get a specific product by ID in either English or Arabic
Route::get('/products/{id}', [ProductsApiController::class, 'show'])->name('products.show');

Route::get('{slug}', [ProductsApiController::class, 'getSlug']);
