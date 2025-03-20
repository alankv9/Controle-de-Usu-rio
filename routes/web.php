<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

// Route::get('/',[UserController::class,'index'])->name('users.index');
// Route::get('/user.create',[UserController::class, 'create'])->name('users.create');
// Route::post('/stor',[UserController::class,'store'])->name('users.store');
// Route::get('/show.user{users}',[UserController::class,'show'])->name('users.show');
// Route::get('/user.edit{users}',[UserController::class,'edit'])->name('users.edit');
// Route::put('/user.update{users}',[UserController::class, 'update'])->name('users.update');
// Route::delete('/user.destroy{users}',[UserController::class, 'destroy'])->name('users.destroy');

Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
