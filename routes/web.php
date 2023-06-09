<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VendorCompanyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']],function(){
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('companys', CompanyController::class);
    Route::resource('categorys', CategoryController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('vencoms', VendorCompanyController::class);
    Route::get('/vencom/{vendor}','App\Http\Controllers\VendorController@vencom')->name('vencom');
    Route::put('/vencomstore/{vendor}','App\Http\Controllers\VendorController@vencomstore')->name('vendors.vencomstore');
    
});

Route::post('/fetchstates/{id}',[CustomerController::class,'fetchstates']);
Route::post('/fetchcities/{id}',[CustomerController::class,'fetchcities']);