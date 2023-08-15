<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori', [HomeController::class, 'categories'])->name('home.kategori');
Route::get('/kategori/{kategori}', [HomeController::class, 'category_show'])->name('home.kategori.show');
Route::get('/produk', [HomeController::class, 'products'])->name('home.produk');
Route::get('/produk/{slug}', [HomeController::class, 'product_detail'])->name('home.produk.detail');

Route::get('/keranjang', [CartController::class, 'index'])->name('home.keranjang.index');
Route::post('/keranjang', [CartController::class, 'store'])->name('home.keranjang.store');
Route::put('/keranjang/{id}', [CartController::class, 'update'])->name('home.keranjang.update');
Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('home.keranjang.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('home.checkout.index');
Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('home.checkout.store');
Route::post('/checkout-now', [CheckoutController::class, 'checkout_now'])->name('home.checkout.now');
Route::get('/sukses/{id}', [CheckoutController::class, 'success'])->name('home.success');

Route::get('/pesanan-saya', [HomeController::class, 'my_orders'])->name('home.my-orders');
Route::put('/pesanan-saya/status/{id}', [HomeController::class, 'my_orders_update_status'])->name('home.my-orders.update');

Route::post('/change-profile', [HomeController::class, 'change_profile'])->name('home.change-profile');

Auth::routes(['password.confirm' => false]);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/pelanggan', [DashboardController::class, 'customers'])->name('admin.customers');

    Route::get('/transaksi', [TransactionController::class, 'index'])->name('admin.transaksi');
    Route::put('/transaksi/{id}', [TransactionController::class, 'update'])->name('admin.transaksi.update');

    Route::get('/laporan', [TransactionController::class, 'report'])->name('admin.report');
    Route::get('/laporan/filter', [TransactionController::class, 'report_filter'])->name('admin.report.filter');

    Route::get('/laporan/print/{bulan}/{tahun}', [TransactionController::class, 'print'])->name('admin.report.print');

    Route::resource('produk', ProductController::class);
    Route::resource('kategori', CategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('bank', BankController::class);
});
