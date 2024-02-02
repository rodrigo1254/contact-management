<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::prefix('api')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
    Route::resource('contacts', ContactController::class)->except(['index']);
});
