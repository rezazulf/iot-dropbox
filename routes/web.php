<?php

use App\Http\Controllers\GrafikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\TempatsampahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KosongkanController;

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


Route::resource('/',WelcomeController::class);
Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login');
// Route::get('register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('proses_login', 'App\Http\Controllers\LoginController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('user', UserController::class);
        Route::resource('tempatsampah', TempatsampahController::class);
        Route::resource('admin', HomeController::class);
        Route::resource('home', HomeController::class);
        Route::resource('map', PetaController::class);
        Route::resource('grafik', GrafikController::class);
        Route::get('grafik', [GrafikController::class, 'index']);
  });

    Route::group(['middleware' => ['cek_login:petugas']], function () {
        Route::resource('petugas', HomeController::class);
        Route::resource('peta', PetaController::class);
        Route::resource('kosongkansampah', TempatsampahController::class);
        Route::post('update_distance', 'App\Http\Controllers\TempatsampahController@update_distance')->name('update_distance');
    });
});