<?php

use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerPdf;
use App\Http\Controllers\ControllerPdfEmpres;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Empresa;

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login/process',[LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
Route::post('/cadastrar/pocess', [CadastrarController::class, 'cadastrarProcess'])->name('cadastrar.process');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/home',[EmpresaController::class, 'index'])->name('empresa.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('empresa/create',[EmpresaController::class, 'create'])->name('empresa.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/empresa',[EmpresaController::class, 'store'])->name('empresa.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/empresa/{empresa}',[EmpresaController::class,'show'])->name('empresa.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/empresa/{empresa}/edit',[EmpresaController::class, 'edit'])->name('empresa.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/empresa/{empresa}',[EmpresaController::class, 'update'])->name('empresa.update');
    Route::get('/users/{id}/pdf', [ControllerPdf::class, 'processPdf'])->name('users.pdf');
    Route::get('/empresa/{id}/pdf', [ControllerPdfEmpres::class, 'processPdfE'])->name('empresas.pdf');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/empresa/{empresa}',[EmpresaController::class,'destroy'])->name('empresa.destroy');

});

