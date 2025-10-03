<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/logar', function () {
    return Inertia::render('Login');
})->name('login')->middleware('guest'); // somente visitantes não logados

Route::get('/cadastro', function () {
    return Inertia::render('Cadastro');
})->name('cadastro')->middleware('guest'); // somente visitantes não logados

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
