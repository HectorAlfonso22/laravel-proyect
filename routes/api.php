<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UsuarioController;

Route::apiResource('noticias', NoticiaController::class);
Route::apiResource('usuarios', UsuarioController::class);

Route::get('/', function () {
    return view('welcome');
});
