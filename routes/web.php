<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\SaveForLaterController;
use Gloudemans\Shoppingcart\Facades\Cart;
use app\Models\Product;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [HomePageController::class, 'index'])->name('HomePage');

Route::get('/shop', [ShopController::class, 'index'])->name('Shop.index');


Route::get('/shop/{product}', [ShopController::class, 'show'])->name('Shop.show');

Route::get('/cart', [CartController::class, 'index'])->name('Cart.index');

Route::post('/cart', [CartController::class, 'store'])->name('Cart.store');

Route::patch('/cart/{product}', [CartController::class, 'update'])->name('Cart.update');

Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('Cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', [CartController::class, 'switchToSaveForLater'])->name('Cart.switchToSaveForLater');

Route::delete('/saveForLater{product}', [SaveForLaterController::class, 'destroy'])->name('SaveForLater.destroy');
Route::post('/saveForLater/switchToSaveForLater/{product}', [SaveForLaterController::class, 'switchToCart'])->name('SaveForLater.switchToCart');

Route::post('/coupon', [CouponsController::class, 'store'])->name('Coupon.store');
Route::delete('/coupon', [CouponsController::class, 'destroy'])->name('Coupon.destroy');

Route::get('empty', function () {
    Cart::instance('saveForLater')->destroy();
});

Route::get('/checkout', [CheckOutController::class, 'index'])->name('CheckOut.index');
Route::post('/checkout', [CheckOutController::class, 'store'])->name('CheckOut.store');

Route::get('/thankyou', [ConfirmationController::class, 'index'])->name('Confirmation.index');
