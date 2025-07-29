<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArduinoController;

// Arduino polling untuk mendapatkan data terbaru
Route::get('/getData', [ArduinoController::class, 'getData']);
// Arduino kirim data hasil perhitungan
Route::post('/postResult', [ArduinoController::class, 'postResult']);
