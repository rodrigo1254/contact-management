<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;


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

/* Rota para visualizar a lista de contatos */
//Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/', [HomeController::class, 'index'])->name('home.index');


/* Rotas para as operações CRUD de contatos (Create, Read, Update, Delete) */
Route::resource('contacts', ContactController::class)->except(['index']);

/* Rotas de Autenticação (Opcionais) */
if (env('ENABLE_AUTH', false)) {
    Auth::routes();
}