<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;

Route::get('/', [ContatoController::class, 'index'])->name('index');
Route::resource('contatos', ContatoController::class)->except(['index']);