<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

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
    return view('calc', ['title'=> 'Lets Calculate!']);
});

Route::get('/transmitter', function () {
    return view('transmitter', ['title'=> 'Lets Calculate!']);
});

Route::get('/receiver', function () {
    return view('receiver', ['title' => 'Form Receiver']);
})->name('receiver.form');

Route::get('/antena', function () {
    return view('antena', ['title'=> 'Lets Calculate!']);
});