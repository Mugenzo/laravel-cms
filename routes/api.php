<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
    Route::apiResources([
        'users' => \App\Http\Controllers\Admin\UserController::class,
        'categories' => \App\Http\Controllers\Admin\CategoryController::class,
        'tags' => \App\Http\Controllers\Admin\TagController::class,
        'media' => \App\Http\Controllers\Admin\MediaController::class,
        'posts' => \App\Http\Controllers\Admin\PostController::class,
    ]);
});
