<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Controllers\VesselController;

Auth::routes();
// Grup middleware berdasarkan role

Route::middleware(['web','auth'])->group(function () {

    Route::get('/', function () {
        return view('auth.login');
    });

    // Rute logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Rute admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin-page', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.page');
        Route::get('/user', [App\Http\Controllers\HomeController::class, 'create'])->name('user');
        Route::post('/user', [App\Http\Controllers\HomeController::class, 'store'])->name('admin.users.store');
        Route::get('users/{user}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}', [App\Http\Controllers\HomeController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('admin.users.destroy');
       
        Route::get('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'getDailyActivity'])->name('dailyactivities.getdaily');
        Route::put('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'editDailyActivity'])->name('dailyactivities.editdaily'); // Tambahkan route ini
             
        Route::get('/running/{id}', [App\Http\Controllers\VDRController::class, 'getrunning'])->name('running.getrunning');
        Route::post('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 
        
        Route::get('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'getconsumption'])->name('consumption.getconsumption');
        Route::put('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'editconsumption'])->name('consumption.editconsumption'); 

        Route::get('/payload/{id}', [App\Http\Controllers\VDRController::class, 'getpayload'])->name('payload.getpayload');
        Route::put('/payload/{id}', [App\Http\Controllers\VDRController::class, 'editpayload'])->name('payload.editpayload'); 

        Route::get('/stock/{id}', [App\Http\Controllers\VDRController::class, 'getstock'])->name('stock.getstock');
        Route::put('/stock/{id}', [App\Http\Controllers\VDRController::class, 'editstock'])->name('stock.editstock'); 
    
        // Tambahkan rute admin lainnya di sini
    });

    // Rute operator
    Route::middleware(['role:operation'])->group(function () {
        Route::get('/operation-page', [App\Http\Controllers\HomeController::class, 'index'])->name('operation.page');
        Route::get('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'getDailyActivity'])->name('dailyactivities.getdaily');
        Route::put('/daily-activities/{id}', [App\Http\Controllers\VDRController::class, 'editDailyActivity'])->name('dailyactivities.editdaily'); // Tambahkan route ini
             
        Route::get('/running/{id}', [App\Http\Controllers\VDRController::class, 'getrunning'])->name('running.getrunning');
        Route::post('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 
        
        Route::get('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'getconsumption'])->name('consumption.getconsumption');
        Route::put('/consumption/{id}', [App\Http\Controllers\VDRController::class, 'editconsumption'])->name('consumption.editconsumption'); 

        Route::get('/payload/{id}', [App\Http\Controllers\VDRController::class, 'getpayload'])->name('payload.getpayload');
        Route::put('/payload/{id}', [App\Http\Controllers\VDRController::class, 'editpayload'])->name('payload.editpayload'); 

        Route::get('/stock/{id}', [App\Http\Controllers\VDRController::class, 'getstock'])->name('stock.getstock');
        Route::put('/stock/{id}', [App\Http\Controllers\VDRController::class, 'editstock'])->name('stock.editstock'); 
    
        // Tambahkan rute operator lainnya di sini
    });

    // Rute vessel
    Route::middleware(['role:vessel'])->group(function () {
        Route::get('/vessel-page', [App\Http\Controllers\HomeController::class, 'index'])->name('vessel.page');
        Route::get('/stock/{id}', [App\Http\Controllers\VDRController::class, 'getstock'])->name('stock.getstock');
        Route::put('/stock/{id}', [App\Http\Controllers\VDRController::class, 'editstock'])->name('stock.editstock'); 
    
        // Tambahkan rute vessel lainnya di sini
    });

    // Rute bersama untuk VDR
    Route::prefix('vdr')->group(function () {
        Route::get('/', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
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
                Route::post('/running/{id}', [App\Http\Controllers\VDRController::class, 'editrunning'])->name('running.editrunning'); 
        
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

                Route::post('/stock', [App\Http\Controllers\VDRController::class, 'storestock'])->name('stock');
                Route::get('/ajaxstock', [App\Http\Controllers\VDRController::class, 'ajaxstock'])->name('stock.ajaxstock');
                Route::post('/addstock', [App\Http\Controllers\VDRController::class, 'addstock'])->name('stock.addstock');
                Route::post('/stock/delete-stock', [App\Http\Controllers\VDRController::class, 'deletestock'])->name('stock.deletestock');
                Route::get('/stock/{id}', [App\Http\Controllers\VDRController::class, 'getstock'])->name('stock.getstock');
                Route::put('/stock/{id}', [App\Http\Controllers\VDRController::class, 'editstock'])->name('stock.editstock'); 
            
                Route::get('/get_product/{codeproduct}', [App\Http\Controllers\VDRController::class, 'getProduct']);
            
    });

    // Rute bersama untuk Vessel Controller
    Route::prefix('vessel')->group(function () {
        Route::get('/', [App\Http\Controllers\VesselController::class, 'vessel'])->name('vessel');
        Route::get('/add', [App\Http\Controllers\VesselController::class, 'add'])->name('add');
        Route::get('/add', [App\Http\Controllers\VesselController::class, 'add'])->name('add');
        Route::post('/store-vessel', [App\Http\Controllers\VesselController::class, 'storevessel'])->name('store-vessel');
        Route::get('/edit-vessel/{id}', [App\Http\Controllers\VesselController::class, 'editvessel'])->name('vessel.edit');
        Route::post('/edit-vessel/{id}', [App\Http\Controllers\VesselController::class, 'updatevessel'])->name('vessel.update');
        Route::get('/destroy-vessel/{id}', [App\Http\Controllers\VesselController::class, 'delete'])->name('vessel.hapus');
    
    });

    // Rute bersama untuk Product Controller
    Route::prefix('product')->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
        Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'add'])->name('add-product');
        Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'add'])->name('add-product');
        Route::post('/store-product', [App\Http\Controllers\ProductController::class, 'storeproduct'])->name('store-product');
        Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'editproduct'])->name('product.edit');
        Route::post('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'updateproduct'])->name('product.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.hapus');
            
    });

    // Rute bersama untuk Temporary Products
    Route::prefix('temporary-products')->group(function () {
        Route::post('/', [App\Http\Controllers\ProductController::class, 'store'])->name('temporary-products.store');
        Route::post('/clear', [App\Http\Controllers\ProductController::class, 'clearTemporaryProducts'])->name('temporary-products.clear');
    });

    // Rute lain yang memerlukan sesi dan otorisasi dapat ditambahkan di sini...
});


