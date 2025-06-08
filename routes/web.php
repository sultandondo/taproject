<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ContactController;
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::get('/', [AuthController::class, 'showLogin'])->name('masuk');
Route::get('/login', [AuthController::class, 'showLogin'])->name('cred');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/home', [AuthController::class, 'dashboard'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Us!']);
});

Route::get('/history', [DataController::class, 'show'])->name('history');

// Route::get('/calc', function () {
//     return view('calc', ['title'=> 'Lets Calculate Orbit!']);
// })->name('calc.show');

Route::get('/calc/{id}', [DataController::class, 'showCalcForm'])->name('calc.show');
Route::post('/calc/{id}', [DataController::class, 'store'])->name('data.store'); // Menangani form dengan POST

// Route::get('/frek', function () {
//     return view('frek', ['title'=> 'Lets Calculate Frekuensi!']);
// })->name('frek.show');

Route::get('/frek/{id}', [DataController::class, 'showFrekuensiForm'])->name('frek.show');

Route::post('/frek/{id}', [DataController::class, 'store_frek'])->name('frek.store'); // Menangani form dengan POST



// Route::get('/transmitter/{id}', function () {
//     return view('transmitter', ['title'=> 'Lets Calculate Transmiter']);
// })->name('transmitter.show');

Route::get('/transmitter/{id}', [DataController::class, 'showTransmitterForm'])->name('transmitter.show');

Route::post('/transmitter/{id}', [DataController::class, 'store_transmitter'])->name('transmitter.store'); // Menangani form dengan POST

// Route::get('/receiver/{id}', function () {
//     return view('receiver', ['title' => 'Lets Calculate Receiver']);
// })->name('receiver.show');

Route::get('/receiver/{id}', [DataController::class, 'showReceiverForm'])->name('receiver.show');

Route::post('/receiver/{id}', [DataController::class, 'store_receiver'])->name('receiver.store'); // Menangani form dengan POST

// Route::get('/calcazimuth', function () {
//     return view('calcazimuth', ['title' => 'Lets Calculate Receiver']);
// })->name('calcazimuth.show');
Route::get('/calcazimuth/{id}', [DataController::class, 'showAzimuthForm'])->name('calcazimuth.show');
Route::post('/calcazimuth', [DataController::class, 'store_calcazimuth'])->name('calcazimuth.store'); // Menangani form dengan POST

Route::get('/antena', function () {
    return view('antena', ['title'=> 'Lets Antena!']);
});


Route::get('/antennagain/{id}', [DataController::class, 'showAntennagain'])->name('antennagain.show');
Route::post('/antennagain/{id}', [DataController::class, 'store_antennagain'])->name('antennagain.store'); // Menangani form dengan POST

Route::get('/annpoinloss/{id}', [DataController::class, 'showAntennaPointingLoss'])->name('annpoinloss.show');
Route::post('/annpoinloss/{id}', [DataController::class, 'store_annpoinloss'])->name('annpoinloss.store'); // Menangani form dengan POST

Route::get('/annpolaloss/{id}', [DataController::class, 'showAnnpolaloss'])->name('annpolaloss.show');
Route::post('/annpolaloss/{id}', [DataController::class, 'store_Annpolaloss'])->name('annpolaloss.store'); // Menangani form dengan POST

Route::get('/atnmosionos/{id}', [DataController::class, 'showAtmosIonos'])->name('atnmosionos.show');

Route::get('/updownlinkbudgetatn', function () {
    return view('updownlinkbudgetatn', ['title'=> 'Lets Calculation Uplink & Downlink Budget Antenna!']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
})->name('about.us'); // <--- Add this line!

Route::get('/home', [AuthController::class, 'dashboard'])->name('home');

;