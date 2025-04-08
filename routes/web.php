<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController, CadastrarController, UserController,
    EmpresaController, ControllerPdf, ControllerPdfEmpres
};

// Rotas públicas
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
Route::post('/cadastrar/process', [CadastrarController::class, 'cadastrarProcess'])->name('cadastrar.process');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/home', [EmpresaController::class, 'index'])->name('empresa.index');

    // Recursos
    Route::resources([
        'users' => UserController::class,
        'empresa' => EmpresaController::class,
    ]);

    // Empresa - Cadastro de usuário
    Route::get('/empresa/cadastra/usuario', [EmpresaController::class, 'prossEmpre'])->name('empresa.usuario');
    Route::post('/cadastra/usuario/empresa', [EmpresaController::class, 'cadastraUsuarioEmpresa'])->name('cd');

    // PDFs
    Route::get('/users/{id}/pdf', [ControllerPdf::class, 'processPdf'])->name('users.pdf');
    Route::get('/empresa/{id}/pdf', [ControllerPdfEmpres::class, 'processPdfE'])->name('empresas.pdf');
});