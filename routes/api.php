<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
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

Route::get('select-danh-muc',[CategoryApiController::class, 'selectData'])->name('categoryData');
Route::get('select-san-pham',[ProductApiController::class, 'selectData'])->name('productData');
Route::get('select-region',[AddressController::class, 'provinceData'])->name('provinceData');
Route::get('select-district',[AddressController::class, 'districtData'])->name('districtData');
Route::get('shipping-fee',[AddressController::class, 'shipData'])->name('shipData');








