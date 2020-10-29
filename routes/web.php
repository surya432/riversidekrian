<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/dashboard', function () {
    return view('home');
})->name('home')->middleware('auth');



Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('', '\App\Http\Controllers\CmpController@redirectShow')->name('showcmpc');
    Route::resource('cmp', App\Http\Controllers\CmpController::class);
    Route::resource('tagihan', App\Http\Controllers\MPackagesController::class);
    Route::resource('payment', App\Http\Controllers\PaymentController::class);
    Route::resource('coa', App\Http\Controllers\MCoaController::class);
});

Route::prefix('/dt')->middleware('auth')->group(function () {
    Route::get('/cmp', '\App\Http\Controllers\CmpController@json')->name('dtcmp');
    Route::get('/apiCoa', '\App\Http\Controllers\MCoaController@apiCoa')->name('dtcoa');
    Route::get('/tagihan', '\App\Http\Controllers\MPackagesController@json')->name('tagihandt');
    Route::get('/getParent/{id}', '\App\Http\Controllers\MCoaController@getParent')->name('dtgetParent');
});
