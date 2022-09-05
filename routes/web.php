<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Server\AnalysisController;
use App\Http\Controllers\Server\CategoryController;
use App\Http\Controllers\Server\DashBoardController;
use App\Http\Controllers\Server\OrderController;
use App\Http\Controllers\Server\ProductController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\OrderController as WebOrderController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('guest')->get('dang-nhap', [AccountController::class, 'loginForm'])->name('loginForm');
Route::middleware('guest')->post('dang-nhap', [AccountController::class, 'postLogin'])->name('postLogin');
Route::middleware('auth')->get('dang-xuat', [AccountController::class, 'logout'])->name('logout');
Route::middleware('guest')->get('dang-ky', [AccountController::class, 'registerForm'])->name('registerForm');
Route::middleware('guest')->post('dang-ky', [AccountController::class, 'postRegister'])->name('postRegister');


Route::post('add-to-cart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('gio-hang', [CartController::class, 'showCart'])->name('showCart');
Route::delete('xoa-gio-hang/{id}', [CartController::class, 'delCart'])->name('delCart');
Route::get('check-out', [CartController::class, 'checkOut'])->name('checkOut');
Route::post('payment', [CartController::class, 'payment'])->name('payment');
Route::get('don-hang', [CartController::class, 'order'])->name('order');
Route::get('chi-tiet-don-hang/{order}', [WebOrderController::class, 'detail'])->name('orderDetail');
Route::post('huy-don-hang/{order}', [WebOrderController::class, 'cancelOrder'])->name('cancelOrder');

Route::prefix('san-pham')->name('product.')->group(function(){
    Route::get('', [WebProductController::class, 'list'])->name('list');
    Route::get('chi-tiet/{product}', [WebProductController::class, 'detail'])->name('detail');
});

Route::prefix('quan-tri')->name('server.')->group(function(){
    Route::get('', [DashBoardController::class, 'index'])->name('dashboard');

    Route::prefix('danh-muc')->name('category.')->group(function(){
        Route::get('', [CategoryController::class, 'list'])->name('list');
        Route::get('them-moi', [CategoryController::class, 'addForm'])->name('addForm');
        Route::post('them-moi', [CategoryController::class, 'postAdd'])->name('postAdd');
        Route::get('cap-nhat/{category}', [CategoryController::class, 'editForm'])->name('editForm');
        Route::put('cap-nhat/{category}', [CategoryController::class, 'putEdit'])->name('putEdit');
        Route::delete('xoa/{category}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('export', [CategoryController::class, 'export'])->name('export');
        Route::post('import', [CategoryController::class, 'import'])->name('import');
    
    });

    Route::prefix('san-pham')->name('product.')->group(function(){
        Route::get('', [ProductController::class, 'list'])->name('list');
        Route::get('them-moi', [ProductController::class, 'addForm'])->name('addForm');
        Route::post('them-moi', [ProductController::class, 'postAdd'])->name('postAdd');
        Route::get('cap-nhat/{product}', [ProductController::class, 'editForm'])->name('editForm');
        Route::put('cap-nhat/{product}', [ProductController::class, 'putEdit'])->name('putEdit');
        Route::delete('xoa/{product}', [ProductController::class, 'delete'])->name('delete');
        Route::get('export', [ProductController::class, 'export'])->name('export');
    });

    Route::prefix('don-hang')->name('order.')->group(function(){
        Route::get('', [OrderController::class, 'list'])->name('list');
        Route::get('chi-tiet/{order}', [OrderController::class, 'detail'])->name('detail');
        Route::get('export/{order}', [OrderController::class, 'export'])->name('export');
    });

    Route::prefix('phan-tich')->name('analysis.')->group(function(){
        Route::get('don-hang', [AnalysisController::class, 'order'])->name('order');
        Route::get('san-pham', [AnalysisController::class, 'product'])->name('product');
    });

    Route::prefix('shipping-fee')->name('ship.')->group(function(){
        Route::get('', [OrderController::class, 'ship_list'])->name('list');
        Route::get('them-moi', [OrderController::class, 'add_ship'])->name('addForm');

        Route::post('import', [OrderController::class, 'import_ship'])->name('import');
    });

});

// Thanh toán điện tử
Route::get('thanh-toan-thanh-cong', [CartController::class, 'success'])->name('success');




