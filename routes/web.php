<?php
use App\Http\Controllers\{
    CadastrarController, ControllerPdf, ControllerPdfEmpres,
    EmpresaController, UserController, LoginController,


};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/process', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/cadastrar', [CadastrarController::class, 'index'])->name('cadastrar');
Route::post('/cadastrar/process', [CadastrarController::class, 'cadastrarProcess'])->name('cadastrar.process');

// Agrupamento de Rotas Protegidas (Apenas para usuários autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/home', [EmpresaController::class, 'index'])->name('empresa.index');
    
    // Rotas de Recursos (CRUD)
    Route::resources([
        'users' => UserController::class,
        'empresa' => EmpresaController::class
    ]);

    // Geração de PDFs
    Route::get('/users/{id}/pdf', [ControllerPdf::class, 'processPdf'])->name('users.pdf');
    Route::get('/empresa/{id}/pdf', [ControllerPdfEmpres::class, 'processPdfE'])->name('empresas.pdf');
});