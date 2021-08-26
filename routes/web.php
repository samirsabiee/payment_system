<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
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
Route::get('refresh/session', function () {
    resolve(StorageInterface::class)->clear();
    return redirect()->route('products.index')->with('success', true);
})->name('refresh.session');


