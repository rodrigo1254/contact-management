<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('list');
});*/

Route::resource('/', ContactController::class);

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::resource('contacts', ContactController::class)->except(['index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');
