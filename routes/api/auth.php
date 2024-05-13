<?php

use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']); 
Route::post('/', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->get('/hello', function () {
    return response()->json(['message' => 'Hello, World!']);
});