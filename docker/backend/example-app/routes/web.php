<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Register;

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

//Route::group(['middleware' => []], function () {
//        Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession'])->name('session');
//        Route::post('/keywords/create-checkout-session', [PaymentController::class, 'createKeywordsCheckoutSession'])->name('keywords-session');
//        Route::post('/bundle/create-checkout-session', [PaymentController::class, 'createBundleCheckoutSession'])->name('bundle-session');
//        Route::post('/backlinks/create-checkout-session', [PaymentController::class, 'createBacklinksCheckoutSession'])->name('bundle-session');
//});

Route::get('/register', [Register::class, 'register'])->name('register.index');
Route::post('/register', [Register::class, 'registerPost'])->name('register.post');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
