<?php

use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login')->middleware('guest'); // somente visitantes não logados

Route::post('/login', [UsuarioController::class, 'autenticar'])->name('login.autenticar');

Route::get('/cadastro', function () {
    return Inertia::render('Cadastro');
})->name('cadastro')->middleware('guest'); // somente visitantes não logados

Route::post('/cadastro', [UsuarioController::class, 'registrar'])->name('cadastro.registrar');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReceitaController::class, 'index'])->name('dashboard');
    Route::get('/receitas/criar', [ReceitaController::class, 'create']);
    Route::post('/receitas', [ReceitaController::class, 'store']);
    Route::get('/receitas/{receita}/editar', [ReceitaController::class, 'edit']);
    Route::put('/receitas/{receita}', [ReceitaController::class, 'update']);
    Route::delete('/receitas/{receita}', [ReceitaController::class, 'destroy']);
    Route::get('/receitas/{receita}/imprimir', [ReceitaController::class, 'imprimir']);
});
