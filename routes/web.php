<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RequestController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/addTocart', [TransactionController::class, 'addToCart'])->name('addToCart');
Route::post('/payNow', [TransactionController::class, 'payNow'])->name('payNow');
Route::post('/topupnow', [WalletController::class, 'topupnow'])->name('topupnow');
Route::get('/acctopup/{transaksi_id}', [WalletController::class, 'index'])->name('acctopup');
Route::post('/acceptRequest', [App\Http\Controllers\WalletController::class, 'acceptRequest'])->name('acceptRequest');

