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
        Route::get('/user', [App\Http\Controllers\HomeController::class, 'create'])->name('user');
        Route::post('/user', [App\Http\Controllers\HomeController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [App\Http\Controllers\HomeController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('admin.users.destroy');
    
        // VDR
        Route::get('/vdr', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
        Route::post('/general-info', [App\Http\Controllers\VDRController::class, 'storegeneralinfo'])->name('general-info');
        Route::post('/daily-activities', [App\Http\Controllers\VDRController::class, 'storedaily'])->name('daily-activities');
        Route::get('/ajaxdaily', [App\Http\Controllers\VDRController::class, 'ajaxdaily'])->name('dailyactivities.ajaxdaily');
        Route::post('/adddaily', [App\Http\Controllers\VDRController::class, 'adddaily'])->name('dailyactivities.adddaily');
        Route::post('/movedatadaily', [App\Http\Controllers\VDRController::class, 'moveDataToDaily'])->name('dailyactivities.movedata');
        Route::post('/movedaily', [App\Http\Controllers\VDRController::class, 'clearTempTable'])->name('dailyactivities.cleartemp');
        Route::post('/dailyactivities/delete', [App\Http\Controllers\VDRController::class, 'deleteDaily'])->name('dailyactivities.deletedaily');
        Route::get('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'getDailyActivity'])->name('dailyactivities.getdaily');
        Route::put('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'editDailyActivity'])->name('dailyactivities.editdaily'); // Tambahkan route ini

        Route::post('/running-hours-machine', [App\Http\Controllers\VDRController::class, 'storerunning'])->name('running-hours-machine');
        Route::get('/ajaxrunning', [App\Http\Controllers\VDRController::class, 'ajaxrunning'])->name('running.ajaxrunning');
        Route::post('/addrunning', [App\Http\Controllers\VDRController::class, 'addrunning'])->name('running.addrunning');
        Route::post('/running/delete-running', [App\Http\Controllers\VDRController::class, 'deleterunning'])->name('running.deleterunning');
        Route::get('/running/{id}', [App\Http\Controllers\VDRController::class, 'getrunning'])->name('running.getrunning');
        Route::put('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 

        Route::post('/consumption', [App\Http\Controllers\VDRController::class, 'storeconsumption'])->name('consumption');
        Route::get('/ajaxconsumption', [App\Http\Controllers\VDRController::class, 'ajaxconsumption'])->name('consumption.ajaxconsumption');
        Route::post('/addconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.addconsumption');
        Route::post('/updateconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.updateconsumption');
        Route::post('/consumption/delete-consumption', [App\Http\Controllers\VDRController::class, 'deleteconsumption'])->name('consumption.deleteconsumption');
        Route::get('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'getconsumption'])->name('consumption.getconsumption');
        Route::put('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'editconsumption'])->name('consumption.editconsumption'); 

        Route::post('/payload', [App\Http\Controllers\VDRController::class, 'storepayload'])->name('payload');
        Route::get('/ajaxpayload', [App\Http\Controllers\VDRController::class, 'ajaxpayload'])->name('payload.ajaxpayload');
        Route::post('/addpayloads', [App\Http\Controllers\VDRController::class, 'addpayloads'])->name('payload.addpayloads');
        Route::post('/payload/delete-payload', [App\Http\Controllers\VDRController::class, 'deletepayload'])->name('payload.deletepayload');
        Route::get('/payload/{id}', [App\Http\Controllers\VDRController::class, 'getpayload'])->name('payload.getpayload');
        Route::put('/payload/{id}', [App\Http\Controllers\VDRController::class, 'editpayload'])->name('payload.editpayload'); 

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
    
    // Grup middleware untuk Operation
    Route::middleware('role:operation')->group(function () {
            Route::get('/operation-page', [App\Http\Controllers\HomeController::class, 'index'])->name('operation.page');
            Route::get('/user', [App\Http\Controllers\HomeController::class, 'create'])->name('user');
            Route::post('/user', [App\Http\Controllers\HomeController::class, 'store'])->name('admin.users.store');
        Route::get('users/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}', [App\Http\Controllers\HomeController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('admin.users.destroy');
        
            // VDR
            Route::get('/vdr', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
            Route::post('/general-info', [App\Http\Controllers\VDRController::class, 'storegeneralinfo'])->name('general-info');
            Route::post('/daily-activities', [App\Http\Controllers\VDRController::class, 'storedaily'])->name('daily-activities');
            Route::get('/ajaxdaily', [App\Http\Controllers\VDRController::class, 'ajaxdaily'])->name('dailyactivities.ajaxdaily');
            Route::post('/adddaily', [App\Http\Controllers\VDRController::class, 'adddaily'])->name('dailyactivities.adddaily');
            Route::post('/movedatadaily', [App\Http\Controllers\VDRController::class, 'moveDataToDaily'])->name('dailyactivities.movedata');
            Route::post('/movedaily', [App\Http\Controllers\VDRController::class, 'clearTempTable'])->name('dailyactivities.cleartemp');
            Route::post('/dailyactivities/delete', [App\Http\Controllers\VDRController::class, 'deleteDaily'])->name('dailyactivities.deletedaily');
            Route::get('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'getDailyActivity'])->name('dailyactivities.getdaily');
            Route::put('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'editDailyActivity'])->name('dailyactivities.editdaily'); // Tambahkan route ini
    
            Route::post('/running-hours-machine', [App\Http\Controllers\VDRController::class, 'storerunning'])->name('running-hours-machine');
            Route::get('/ajaxrunning', [App\Http\Controllers\VDRController::class, 'ajaxrunning'])->name('running.ajaxrunning');
            Route::post('/addrunning', [App\Http\Controllers\VDRController::class, 'addrunning'])->name('running.addrunning');
            Route::post('/running/delete-running', [App\Http\Controllers\VDRController::class, 'deleterunning'])->name('running.deleterunning');
            Route::get('/running/{id}', [App\Http\Controllers\VDRController::class, 'getrunning'])->name('running.getrunning');
            Route::put('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 
    
            Route::post('/consumption', [App\Http\Controllers\VDRController::class, 'storeconsumption'])->name('consumption');
            Route::get('/ajaxconsumption', [App\Http\Controllers\VDRController::class, 'ajaxconsumption'])->name('consumption.ajaxconsumption');
            Route::post('/addconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.addconsumption');
            Route::post('/updateconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.updateconsumption');
            Route::post('/consumption/delete-consumption', [App\Http\Controllers\VDRController::class, 'deleteconsumption'])->name('consumption.deleteconsumption');
            Route::get('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'getconsumption'])->name('consumption.getconsumption');
            Route::put('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'editconsumption'])->name('consumption.editconsumption'); 
    
            Route::post('/payload', [App\Http\Controllers\VDRController::class, 'storepayload'])->name('payload');
            Route::get('/ajaxpayload', [App\Http\Controllers\VDRController::class, 'ajaxpayload'])->name('payload.ajaxpayload');
            Route::post('/addpayloads', [App\Http\Controllers\VDRController::class, 'addpayloads'])->name('payload.addpayloads');
            Route::post('/payload/delete-payload', [App\Http\Controllers\VDRController::class, 'deletepayload'])->name('payload.deletepayload');
            Route::get('/payload/{id}', [App\Http\Controllers\VDRController::class, 'getpayload'])->name('payload.getpayload');
            Route::put('/payload/{id}', [App\Http\Controllers\VDRController::class, 'editpayload'])->name('payload.editpayload'); 
    
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

     // Grup middleware untuk Vessel
     Route::middleware('role:vessel')->group(function () {
        Route::get('/vessel-page', [App\Http\Controllers\HomeController::class, 'index'])->name('vessel.page');
        Route::get('/user', [App\Http\Controllers\HomeController::class, 'create'])->name('user');
        Route::post('/user', [App\Http\Controllers\HomeController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [App\Http\Controllers\HomeController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('admin.users.destroy');
    
        // VDR
        Route::get('/vdr', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
        Route::post('/general-info', [App\Http\Controllers\VDRController::class, 'storegeneralinfo'])->name('general-info');
        Route::post('/daily-activities', [App\Http\Controllers\VDRController::class, 'storedaily'])->name('daily-activities');
        Route::get('/ajaxdaily', [App\Http\Controllers\VDRController::class, 'ajaxdaily'])->name('dailyactivities.ajaxdaily');
        Route::post('/adddaily', [App\Http\Controllers\VDRController::class, 'adddaily'])->name('dailyactivities.adddaily');
        Route::post('/movedatadaily', [App\Http\Controllers\VDRController::class, 'moveDataToDaily'])->name('dailyactivities.movedata');
        Route::post('/movedaily', [App\Http\Controllers\VDRController::class, 'clearTempTable'])->name('dailyactivities.cleartemp');
        Route::post('/dailyactivities/delete', [App\Http\Controllers\VDRController::class, 'deleteDaily'])->name('dailyactivities.deletedaily');
        Route::get('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'getDailyActivity'])->name('dailyactivities.getdaily');
        Route::put('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'editDailyActivity'])->name('dailyactivities.editdaily'); // Tambahkan route ini

        Route::post('/running-hours-machine', [App\Http\Controllers\VDRController::class, 'storerunning'])->name('running-hours-machine');
        Route::get('/ajaxrunning', [App\Http\Controllers\VDRController::class, 'ajaxrunning'])->name('running.ajaxrunning');
        Route::post('/addrunning', [App\Http\Controllers\VDRController::class, 'addrunning'])->name('running.addrunning');
        Route::post('/running/delete-running', [App\Http\Controllers\VDRController::class, 'deleterunning'])->name('running.deleterunning');
        Route::get('/running/{id}', [App\Http\Controllers\VDRController::class, 'getrunning'])->name('running.getrunning');
        Route::put('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 

        Route::post('/consumption', [App\Http\Controllers\VDRController::class, 'storeconsumption'])->name('consumption');
        Route::get('/ajaxconsumption', [App\Http\Controllers\VDRController::class, 'ajaxconsumption'])->name('consumption.ajaxconsumption');
        Route::post('/addconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.addconsumption');
        Route::post('/updateconsumption', [App\Http\Controllers\VDRController::class, 'addconsumption'])->name('consumption.updateconsumption');
        Route::post('/consumption/delete-consumption', [App\Http\Controllers\VDRController::class, 'deleteconsumption'])->name('consumption.deleteconsumption');
        Route::get('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'getconsumption'])->name('consumption.getconsumption');
        Route::put('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'editconsumption'])->name('consumption.editconsumption'); 

        Route::post('/payload', [App\Http\Controllers\VDRController::class, 'storepayload'])->name('payload');
        Route::get('/ajaxpayload', [App\Http\Controllers\VDRController::class, 'ajaxpayload'])->name('payload.ajaxpayload');
        Route::post('/addpayloads', [App\Http\Controllers\VDRController::class, 'addpayloads'])->name('payload.addpayloads');
        Route::post('/payload/delete-payload', [App\Http\Controllers\VDRController::class, 'deletepayload'])->name('payload.deletepayload');
        Route::get('/payload/{id}', [App\Http\Controllers\VDRController::class, 'getpayload'])->name('payload.getpayload');
        Route::put('/payload/{id}', [App\Http\Controllers\VDRController::class, 'editpayload'])->name('payload.editpayload'); 

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
});

