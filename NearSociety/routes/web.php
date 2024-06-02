<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\VecinoController;
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

Route::get('/', HomeController::class);

Route::controller(PublicacionController::class)->group(function(){
    Route::get('publicaciones', 'index');
    Route::get('publicaciones/create', 'create');
    Route::get('publicaciones/{publicacion}', 'show');    
});

Route::controller(VecinoController::class)->group(function(){
    Route::get('vecinos', 'index');
    Route::get('vecinos/create', 'create');
    Route::get('vecinos/{vecino}', 'show');    
    Route::get('/login', [VecinoController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [VecinoController::class, 'login']);
    Route::get('/vecino/login', [VecinoController::class, 'showLoginForm'])->name('vecino.login');
    
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});