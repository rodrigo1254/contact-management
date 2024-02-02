<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('contacts', ContactController::class)->except(['index']);

if (env('ENABLE_AUTH', false)) {
    Auth::routes();
}