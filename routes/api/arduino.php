<?php

use App\Http\Controllers\Arduino\ArduinoController;
use Illuminate\Support\Facades\Route;

Route::post('/', [ArduinoController::class, 'store']);
Route::get('/', [ArduinoController::class, 'index']);


Route::middleware(['jwt.auth'])->group(function (){

}); 