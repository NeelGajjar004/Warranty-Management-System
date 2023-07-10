<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[ApiController::class,'login1']);
Route::post('register',[ApiController::class,'register']);
 
Route::get('vendor-list',[ApiController::class,'vendorindex']);
Route::get('product-list',[ApiController::class,'productindex']);
Route::get('company-list',[ApiController::class,'companyindex']);
Route::get('category-list',[ApiController::class,'categoryindex']);
Route::get('customer-list',[ApiController::class,'customerindex']);
Route::get('country-list',[ApiController::class,'countryindex']);
Route::get('state-list',[ApiController::class,'stateindex']);
Route::get('city-list',[ApiController::class,'cityindex']);
Route::get('user-list',[ApiController::class,'userindex']);
