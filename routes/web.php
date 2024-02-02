<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthLoginController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::resource('contacts', ContactController::class)->except(['index']);

// Rotas relacionadas ao login/logout
Route::post('/login', [AuthLoginController::class, 'login'])->name('login');
Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');


/*
Route::resource('/', ContactController::class);

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::resource('contacts', ContactController::class)->except(['index']);

Route::post('/login', [AuthLoginController::class, 'login'])->name('login');

Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');
*/