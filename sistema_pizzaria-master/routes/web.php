<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;

// Rota para exibir o formulário de edição
Route::get('/usuario/{id}/editar', [UsuarioController::class, 'editar'])->name('usuario.editar');

// Rota para processar a atualização
Route::post('/usuario/{id}', [UsuarioController::class, 'atualizar'])->name('usuario.atualizar');
