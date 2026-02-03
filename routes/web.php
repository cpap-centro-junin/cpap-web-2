<?php

use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('home');
})->name('home');

// Bolsa de Trabajo
Route::get('/bolsa-trabajo', function () {
    return view('bolsa-trabajo');
})->name('bolsa-trabajo');

// Biblioteca Virtual
Route::get('/biblioteca', function () {
    return view('biblioteca');
})->name('biblioteca');
