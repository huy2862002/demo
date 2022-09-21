<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\CartApiController;
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
Route::get('address',[AddressController::class, 'addressData'])->name('addressData');
Route::get('code',[ProductApiController::class, 'codeData'])->name('codeData');
Route::put('cap-nhat-qty-cart',[CartApiController::class, 'updateQtyCart'])->name('updateQtyCart');

Route::put('bienthe/cap-nhat-gia',[ProductApiController::class, 'updatePriceVariant'])->name('updatePriceVariant');
Route::put('bienthe/cap-nhat-gia_uu-dai',[ProductApiController::class, 'updatePriceDiscountVariant'])->name('updatePriceDiscountVariant');
Route::post('bienthe/cap-nhat-avatar',[ProductApiController::class, 'updateAvtVariant'])->name('updateAvtVariant');
Route::put('bienthe/cap-nhat-ton-kho',[ProductApiController::class, 'updateInventoryVariant'])->name('updateInventoryVariant');
Route::get('thong-tin-bien-the',[ProductApiController::class, 'getInfoVariant'])->name('getInfoVariant');
Route::put('bien-the-mac-dinh',[ProductApiController::class, 'primarySetup'])->name('primarySetup');
Route::put('bien-the-hidden',[ProductApiController::class, 'hiddenSetup'])->name('hiddenSetup');
Route::post('them-gia-tri-thuoc-tinh',[AttributeController::class, 'addAttValue'])->name('addAttValue');
Route::get('xoa-value-att', [AttributeController::class, 'delValueAtt'])->name('delValueAtt');
Route::post('them-moi-option', [AttributeController::class, 'addOption'])->name('addOption');









