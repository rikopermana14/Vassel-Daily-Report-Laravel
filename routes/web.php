<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Controllers\VesselController;



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

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/', function () {
     return view('auth.login');
    });
    // Rute logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Rute-rute lain yang memerlukan sesi dan otorisasi dapat ditambahkan di sini...
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-page', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.page');
    
        // VDR
        Route::get('/vdr', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
        Route::post('/general-info', [App\Http\Controllers\VDRController::class, 'storegeneralinfo'])->name('general-info');
        Route::post('/daily-activities', [App\Http\Controllers\VDRController::class, 'storedaily'])->name('daily-activities');
        Route::get('/ajaxdaily', [App\Http\Controllers\VDRController::class, 'ajaxdaily'])->name('dailyactivities.ajaxdaily');
        Route::post('/adddaily', [App\Http\Controllers\VDRController::class, 'adddaily'])->name('dailyactivities.adddaily');
        Route::get('/movedatadaily', [App\Http\Controllers\VDRController::class, 'moveDataToDaily'])->name('dailyactivities.movedata');
        Route::post('/movedaily', [App\Http\Controllers\VDRController::class, 'clearTempTable'])->name('dailyactivities.cleartemp');

        Route::post('/running-hours-machine', [App\Http\Controllers\VDRController::class, 'storerunning'])->name('running-hours-machine');
        Route::post('/consumption', [App\Http\Controllers\VDRController::class, 'storeconsumption'])->name('consumption');
        Route::post('/muatan', [App\Http\Controllers\VDRController::class, 'storemuatan'])->name('muatan');
        Route::post('/stock_status', [App\Http\Controllers\VDRController::class, 'storestock'])->name('stock_stsatus');
        Route::get('/get_product/{codeproduct}', [App\Http\Controllers\VDRController::class, 'getProduct']);
    
        // vessel
        Route::get('/vessel', [App\Http\Controllers\VesselController::class, 'vessel'])->name('vessel');
        Route::get('/add', [App\Http\Controllers\VesselController::class, 'add'])->name('add');
        Route::post('/store-vessel', [App\Http\Controllers\VesselController::class, 'storevessel'])->name('store-vessel');
        Route::get('/edit-vessel/{id}', [App\Http\Controllers\VesselController::class, 'editvessel'])->name('vessel.edit');
        Route::post('/edit-vessel/{id}', [App\Http\Controllers\VesselController::class, 'updatevessel'])->name('vessel.update');
        Route::get('/destroy-vessel/{id}', [App\Http\Controllers\VesselController::class, 'delete'])->name('vessel.hapus');
    
        //Product
        Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
        Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'add'])->name('add-product');
        Route::post('/store-product', [App\Http\Controllers\ProductController::class, 'storeproduct'])->name('store-product');
        Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'editproduct'])->name('product.edit');
        Route::post('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'updateproduct'])->name('product.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.hapus');
    
        // Route untuk menyimpan produk ke dalam daftar temporary
        Route::post('/temporary-products', [App\Http\Controllers\ProductController::class, 'store'])->name('temporary-products.store');
    
        // Route untuk membersihkan daftar produk temporary
        Route::post('/temporary-products/clear', [App\Http\Controllers\ProductController::class, 'clearTemporaryProducts'])->name('temporary-products.clear');
    });
    
    // Grup middleware untuk user
    Route::middleware('role:user')->group(function () {
        Route::get('user-page', function() {
            return 'Halaman untuk User';
        })->name('user.page');
    });
});

