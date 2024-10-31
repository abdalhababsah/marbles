<?php

use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Catalog\CategoryController;
use App\Http\Controllers\Catalog\ProductController;
use App\Http\Controllers\Catalog\VariantTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Home\ContactUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeImagesController;
use App\Http\Controllers\Home\AboutUsController;


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
Route::view('/about-us', 'pages/home/about_us/index')->name('about-us.index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
    });

 

    /// -------- catalog 

    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('variant-types', VariantTypeController::class);

        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::post('/product/update-image', [ProductController::class, 'updateImage'])->name('product.updateImage');
        Route::get('/products/{product}/get-images', [ProductController::class, 'getProductImages'])->name('catalog.products.getProductImages');
        Route::post('/products/update-status', [ProductController::class, 'updateStatus'])->name('catalog.products.update-status');
        Route::post('/products/update-category-type', [ProductController::class, 'updateCategoryType'])->name('products.updateCategoryType');
        Route::post('/products/update-category', [ProductController::class, 'updateCategory'])->name('products.updateCategory');
        Route::post('products/update-dimensions', [ProductController::class, 'updateDimensions'])->name('products.updateDimensions');
        Route::post('/products/update-general', [ProductController::class, 'updateGeneral'])->name('products.updateGeneral');
        Route::post('/products/update-inventory', [ProductController::class, 'updateProductInventory'])->name('products.updateInventory');
        Route::post('/products/updateVariations', [ProductController::class, 'updateVariations'])->name('products.updateVariations');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
    Route::prefix('home')->name('home.')->group(function () {
        Route::resource('home-images', HomeImagesController::class);
        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
        Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('about-us.create');
        Route::post('/about-us', [AboutUsController::class, 'store'])->name('about-us.store');
        Route::get('/about-us/{aboutUs}/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
        Route::put('/about-us/{aboutUs}', [AboutUsController::class, 'update'])->name('about-us.update');
        Route::delete('/about-us/{aboutUs}', [AboutUsController::class, 'destroy'])->name('about-us.destroy');

        Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
        Route::get('/contact-us/{contactUs}', [ContactUsController::class, 'show'])->name('contact-us.show');
        Route::delete('/contact-us/{contactUs}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');

    });



    
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
