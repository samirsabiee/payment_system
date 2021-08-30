<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('basket/add/{product}', [BasketController::class, 'add'])->name('basket.add');
Route::get('basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('basket/update/{product}', [BasketController::class, 'update'])->name('basket.update');
Route::get('basket/checkout', [BasketController::class, 'checkoutForm'])->name('basket.checkout.form');
Route::post('basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
Route::post('payment/{gateway}/callback', [PaymentController::class, 'verify'])->name('payment.verify');
Route::post('coupon', [CouponsController::class, 'store'])->name('coupons.store');
Route::get('coupon/remove', [CouponsController::class, 'remove'])->name('coupons.remove');
Route::get('orders', [OrdersController::class, 'index'])->name('orders.index');
Route::get('invoice/{order}', [InvoicesController::class, 'show'])->name('invoice.show');
Route::get('refresh/session', function () {
    resolve(StorageInterface::class)->clear();
    return redirect()->route('products.index')->with('success', true);
})->name('refresh.session');


