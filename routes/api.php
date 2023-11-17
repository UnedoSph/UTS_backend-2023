<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
# mengimport controller Media
use App\Http\Controllers\MediaController;

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

# Route media
# Method GET
Route::get('/media', [MediaController::class, 'index']);
Route::get('/media/{id}', [MediaController::class, 'show']);

# Method POST
Route::post('/media', [MediaController::class, 'store']);
Route::put('/media/{id}', [MediaController::class, 'update']);
Route::delete('/media/{id}', [MediaController::class, 'destroy']);

# untuk register dan login pake auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

#bungkus route dengan middleware sanctum
Route::middleware('auth:sanctum')->group(function () {
    # Method GET, route /students
    Route::get('/media', [AuthController::class, 'index']);
    # Create student
    Route::post('/media', [AuthController::class, 'store']);
    # Update student
    Route::put('/media/{id}', [AuthController::class, 'update']);
    # Delete student
    Route::delete('/media/{id}', [AuthController::class, 'destroy']);
});
