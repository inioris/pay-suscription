<?php
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index']);

// PayPal
Route::post('/create-order', [PayPalController::class, 'createOrder'])->name('create-order');

// Route::get('/list-orders', [PayPalController::class, 'getOrderList']);
