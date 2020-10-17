<?php

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/provinsi', function () {
    return response()->json(Provinsi::all(), 200);
});
Route::get('/kabupaten/{id}', function ($id) {
    return response()->json(Kabupaten::where('provinsi_id', $id)->pluck('name', 'id'), 200);
});
Route::get('/kecamatan/{id}', function ($id) {
    return response()->json(Kecamatan::where('kabupaten_id', $id)->pluck('name', 'id'), 200);
});

Route::get('/kelurahan/{id}', function ($id) {
    return response()->json(Kelurahan::where('kecamatan_id', $id)->pluck('name', 'id'), 200);
});
