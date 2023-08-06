<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Spatie\Permission\Middlewares\RoleMiddleware;


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
    return view('auth.login');
});

Auth::routes();


Route::middleware('role:admin')->group(function () {
    Route::get('/admin-page', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.page');
    Route::get('/vdr', [App\Http\Controllers\VDRController::class, 'vdr'])->name('vdr');
    // vessel
    Route::get('/vessel', [App\Http\Controllers\VesselController::class, 'vessel'])->name('vessel');
    Route::get('/add', [App\Http\Controllers\VesselController::class, 'add'])->name('add');

    //Product
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
    Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'add'])->name('add-product');
});

// Grup middleware untuk user
Route::middleware('role:user')->group(function () {
    Route::get('user-page', function() {
        return 'Halaman untuk User';
    })->name('user.page');
});

Route::group(['middleware' => ['web']], function () {

    // Rute logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Rute-rute lain yang memerlukan sesi dan otorisasi dapat ditambahkan di sini...
    
});