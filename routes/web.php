<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::delete('login', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout');

    Route::middleware('isAdmin')->group(function () {
        Route::get('admin/{any?}', fn() => view('admin.spa'))
            ->where('any', '.*')
            ->name('dashboard');
    });
});
