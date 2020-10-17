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
    Route::get('', '\App\Http\Controllers\CmpController@show')->name('showcmpc');
    Route::resource('cmp', App\Http\Controllers\CmpController::class);
});

Route::prefix('/dt')->middleware('auth')->group(function () {
    Route::get('/cmp', '\App\Http\Controllers\CmpController@json')->name('dtcmp');
});
