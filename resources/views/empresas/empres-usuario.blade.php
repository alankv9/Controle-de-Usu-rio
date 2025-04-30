@extends('layouts.adim')

@section('content')

<div class="card-body">
<div class="card mt-4 mb-4 border-ligth shadow">

<div class="card-header hstack gap-2">
    <span>Vincular Usuário à Empresa</span>

    <span class="ms-auto d-sm-flex flex-row">
        <a href="{{ route('empresa.index') }}" class="btn btn-info btn-sm me-1">Listar Empresas</a>
    </span>
</div>

<div class="card-body">

    <x-alert/>
    <form action="{{ route('cd') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-12"> 
            <label for="user_id" class="form-label">ID do usuário:</label>
            <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID do usuário" value="{{ old('user_id') }}">
        </div>

        <div class="col-md-12">
            <label for="empresa_id" class="form-label">ID da empresa:</label>
            <input type="text" name="empresa_id" class="form-control" id="empresa_id" placeholder="ID da empresa" value="{{ old('empresa_id') }}">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
            <a class="" type="submit" href="{{ route('users.index') }}">Cancelar</a>
        </div>
    </form>
    </div>    
</div>

@endsection
