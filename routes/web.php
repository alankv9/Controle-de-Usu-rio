<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController, CadastrarController, UserController,
    EmpresaController, ControllerPdf, ControllerPdfEmpres,
    ProfileController,
};
use App\Http\Controllers\{
    PasswordResetController, PasswordResetLinkController,
};

// Rotas públicas
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('login.process');
    Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
    Route::post('/cadastrar/process', [CadastrarController::class, 'cadastrarProcess'])->name('cadastrar.process');

    Route::view('/forgot-password', 'login.proce-reset-password')->name('password.request');
    
    // Rota para processar o formulário de "esqueci minha senha"
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    
    // Rota para exibir o formulário de redefinição de senha
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    
    // Rota para processar a redefinição de senha
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
    
});



// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/home', [EmpresaController::class, 'index'])->name('empresa.index');

    Route::resources([
        'users' => UserController::class,
        'empresa' => EmpresaController::class,
    ]);

    // Cadastro de usuários pela empresa
    Route::get('/empresa/cadastra/usuario', [EmpresaController::class, 'prossEmpre'])->name('empresa.usuario');
    Route::post('/cadastra/usuario/empresa', [EmpresaController::class, 'cadastraUsuarioEmpresa'])->name('cd');

    // Geração de PDFs
    Route::get('/users/{id}/pdf', [ControllerPdf::class, 'processPdf'])->name('users.pdf');
    Route::get('/empresa/{id}/pdf', [ControllerPdfEmpres::class, 'processPdfE'])->name('empresas.pdf');

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
