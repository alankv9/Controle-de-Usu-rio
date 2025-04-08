@extends('layouts.adim')

@section('content')
    <div class="card mt-4 mb-4 border-ligth shadow">

    <div class="card-header hstack gap-2">
        <span>Visualizar Usuários</span>

        <span class="ms-auto d-sm-flex flex-row">
            <a href="{{ route('users.index') }}" class="btn btn-info btn-sm me-1">Listar Usuário</a>
             <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm me-1">Editar Usuários</a>
        </span>
    </div>

    <div class="card-body">

        <x-alert/>
        <dl class="row">
        <dt class="col-sm-3">ID:</dt>
        <dd class="col-sm-9">{{ $user->id }}</dd>

        <dt class="col-sm-3">Nome:</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>

        <dt class="col-sm-3">Email:</dt>
        <dd class="col-sm-9">{{ $user->email }}</dd>

        <dt class="col-sm-3">Empresa:</dt>
        <dd class="col-sm-9">{{ $user->empresa?->name ?? 'Nenhuma empresa vinculada' }}</dd>

        <dt class="col-sm-3">Cadastrado:</dt>
        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</dd>

        <dt class="col-sm-3">Editado:</dt>
        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:d') }}</dd>
        </dl>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary me-md-2" type="button" target="_blank" href="{{ route('users.pdf', $user->id) }}">PDF</a>
        </div>
    </div>
    

    </div>
@endsection
