<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('', [AuthController::class, 'check']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('', [PostController::class, 'index']);
        // Route::get('/{id}', [PostController::class, 'show']);
        Route::post('/upload', [PostController::class, 'store']);
        // Route::put('/{id}', [PostController::class, 'update']);
        // Route::delete('/{id}', [PostController::class, 'destroy']);
    });
});