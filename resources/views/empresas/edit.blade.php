@extends('layouts.adim')

@section('content')
<div class="card mt-4 mb-4 border-ligth shadow">

<div class="card-header hstack gap-2">
    <span>Editar Usuário</span>

    <span class="ms-auto d-sm-flex flex-row">
        <a href="{{ route('empresa.index') }}" class="btn btn-info btn-sm me-1">Listar Empresas</a>
        <a href="{{ route('empresa.show',$empresa->id) }}" class="btn btn-primary btn-sm me-1">Visualizar Empresas</a>
    </span>
</div>

<div class="card-body">

    <x-alert/>
    
    <form action="{{ route('empresa.update',$empresa->id) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-12">
        <label for="name" class="form-label">Nome: </label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Nome Compĺeto" value="{{ old('name', $empresa->name) }}">
        </div>

        <div class="col-md-12">
        <label for="name" class="form-label">CNPJ: </label>
        <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="CNPJ" value="{{ old('Cnpj', $empresa->cnpj) }}">
        </div>

        <div class="col-md-6">
        <label for="name" class="form-label">E-mail: </label>
        <div class="input-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ old('email', $empresa->email) }}">
        </div>
        </div>

        <div class="col-12">
        <button type="submit" class="btn btn-success btn-sm">Salvar</button>
        <a type="submit" class="btn btn-warning btn-sm" href="{{ route('empresa.index') }}">Cancelar</a>
        </div>


    </form>
@endsection