@extends('layouts.adim')

@section('content')
<div class="card mt-4 mb-4 border-light shadow">
    <div class="card-header hstack gap-2">
        <span>Cadastrar Usuário</span>
        <span class="ms-auto d-sm-flex flex-row">
            <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1">Listar Usuários</a>
        </span>
    </div>

    <div class="card-body">
        <x-alert/>

        <form action="{{ route('users.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf

            <!-- Nome -->
            <div class="col-md-12">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome completo" value="{{ old('name') }}" required>
            </div>

            <!-- E-mail -->
            <div class="col-md-12">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
            </div>

            <!-- Senha -->
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                    <span class="input-group-text" onclick="togglePassword('password', this)">
                        <i class="bi bi-eye-slash-fill"></i>
                    </span>
                </div>
            </div>

            <!-- Confirmação de Senha -->
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar senha" required>
                    <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                        <i class="bi bi-eye-slash-fill"></i>
                    </span>
                </div>
            </div>

            <!-- Upload de Foto -->
            <div class="col-md-12 d-flex align-items-center justify-content-between">
                <img id="photo-preview" src="#" alt="Prévia da Imagem" class="rounded-circle border" style="display:none; width: 60px; height: 60px; object-fit: cover;">
                <label class="btn btn-primary mb-0">
                    <i class="bi bi-upload"></i> Escolher Foto
                    <input type="file" name="photo" accept="image/*" hidden onchange="previewPhoto(event)">
                </label>
            </div>

            <!-- Botões -->
            <div class="col-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
