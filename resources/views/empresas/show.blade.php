@extends('layouts.adim')

@section('content')

<div class="card mt-4 mb-4 border-ligth shadow">

<div class="card-header hstack gap-2">
    <span>Visualizar Empresas</span>

    <span class="ms-auto d-sm-flex flex-row">
        <a href="{{ route('empresa.index') }}" class="btn btn-info btn-sm me-1">Listar Empresas</a>
         <a href="{{ route('empresa.edit',$empresa->id) }}" class="btn btn-warning btn-sm me-1">Editar Empresa</a>
    </span>
</div>

<div class="card-body">

    <x-alert/>
    <dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9">{{ $empresa->id }}</dd>

    <dt class="col-sm-3">Qtd Empregados</dt>
    <dd class="col-sm-9">{{ $empresa->usuarios_count }}</dd>

    <dt class="col-sm-3">Cnpj</dt>
    <dd class="col-sm-9">{{ $empresa->cnpj }}</dd>

    <dt class="col-sm-3">Nome</dt>
    <dd class="col-sm-9">{{ $empresa->name }}</dd>

    <dt class="col-sm-3">Email</dt>
    <dd class="col-sm-9">{{ $empresa->email }}</dd>

    <dt class="col-sm-3">Cadastrado</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($empresa->created_at)->format('d/m/Y H:i:s') }}</dd>

    <dt class="col-sm-3">Editado</dt>
    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($empresa->updated_at)->format('d/m/Y H:i:d') }}</dd>
    </dl>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a class="btn btn-primary me-md-2" type="button" target="_blank" href="{{ route('empresas.pdf', $empresa->id) }}">PDF</a>
    </div>
</div>


</div>



@endsection