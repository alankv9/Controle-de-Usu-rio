<?php

use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerPdf;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login/process',[LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
Route::post('/cadastrar/pocess', [CadastrarController::class, 'cadastrarProcess'])->name('cadastrar.process');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/pdf', [ControllerPdf::class, 'processPdf'])->name('users.pdf');
    Route::get('/gerar-pdf/{id}', [UserController::class, 'gerarPDFUsuario']);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

