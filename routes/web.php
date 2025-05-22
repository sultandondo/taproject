<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'dashboard'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/about', function () {
        return view('about', ['title' => 'About Us']);
    });

    Route::get('/blog', function () {
        return view('blog', ['title' => 'Blog']);
    });

    Route::get('/contact', function () {
        return view('contact', ['title' => 'Contact Us!']);
    });

    Route::get('/calc', function () {
        return view('calc', ['title'=> 'Lets Calculate Orbit!']);
    })->name('calc.show');

    Route::post('/calc', [DataController::class, 'store'])->name('data.store'); // Menangani form dengan POST

    Route::get('/frek', function () {
        return view('frek', ['title'=> 'Lets Calculate Frekuensi!']);
    })->name('frek.show');

    Route::post('/frek', [DataController::class, 'store_frek'])->name('frek.store'); // Menangani form dengan POST

    Route::get('/calcazimuth', function () {
        return view('calcazimuth', ['title'=> 'Lets Calculate GEO Azimuth!']);
    });

    Route::get('/transmitter', function () {
        return view('transmitter', ['title'=> 'Lets Calculate Transmiter']);
    })->name('transmitter.show');
    
    Route::post('/transmitter', [DataController::class, 'store_transmitter'])->name('transmitter.store'); // Menangani form dengan POST

    Route::get('/receiver', function () {
        return view('receiver', ['title' => 'Lets Calculate Receiver']);
    })->name('receiver.show');
    Route::post('/receiver', [DataController::class, 'store_receiver'])->name('receiver.store'); // Menangani form dengan POST

    Route::get('/calcazimuth', function () {
        return view('calcazimuth', ['title' => 'Lets Calculate Receiver']);
    })->name('calcazimuth.show');
    Route::post('/calcazimuth', [DataController::class, 'store_calcazimuth'])->name('calcazimuth.store'); // Menangani form dengan POST

    Route::get('/antena', function () {
        return view('antena', ['title'=> 'Lets Antena!']);
    });

    Route::get('/annpolaloss', function () {
        return view('annpolaloss', ['title'=> 'Lets Antenna Polarization Loss!']);
    });
});