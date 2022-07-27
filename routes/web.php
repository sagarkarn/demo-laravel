<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockYardController;
use App\Http\Controllers\TxnLogController;
use App\Http\Controllers\UserController;
use Database\Factories\CustomerFactory;
use Illuminate\Support\Facades\Route;



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('post_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/inward-entry', [TxnLogController::class, 'inwardEntry'])->name('inward_entry');
    Route::post('/inward-entry/store', [TxnLogController::class, 'inwardEntryStore'])->name('inward_entry.store');
    Route::get('/inward-entry/passbook', [TxnLogController::class, 'passbook'])->name('inward_entry.passbook');

    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/customer/get', [CustomerController::class, 'get'])->name('customer.get');

    Route::resources([
        'customer' => CustomerController::class,
        'product' => ProductController::class,
        'stockyard' => StockYardController::class,
        'user' => UserController::class,
    ]);
});
