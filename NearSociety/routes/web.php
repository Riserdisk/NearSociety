<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\NeighborLoginController;

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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Rutas de autenticación para vecinos
Route::get('neighbor/login', [NeighborLoginController::class, 'showLoginForm'])->name('neighbor.login');
Route::post('neighbor/login', [NeighborLoginController::class, 'login'])->name('neighbor.login.post');
Route::post('neighbor/logout', [NeighborLoginController::class, 'logout'])->name('neighbor.logout');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
