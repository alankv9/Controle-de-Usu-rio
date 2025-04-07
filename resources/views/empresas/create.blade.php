@extends('layouts.adim')

@section('content')

<div class="card mt-4 mb-4 border-ligth shadow">

<div class="card-header hstack gap-2">
    <span>Cadastrar Empresas</span>

    <span class="ms-auto d-sm-flex flex-row">
        <a href="{{ route('empresa.index') }}" class="btn btn-info btn-sm me-1">Listar Empresas</a>
    </span>
</div>

<div class="card-body">

    <x-alert/>

    <form action="{{ route('empresa.store') }}" method="POST" class="row g-3">
        @csrf
        @method('POST')
        <div class="col-md-12"> 
        <label for="name" class="form-label">Nome: </label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Nome Compĺeto" value="{{ old('name') }}">
        </div>

        <div class="col-md-12">
        <label for="name" class="form-label">CNPJ: </label>
        <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="Cnpj da empresa" value="{{ old('cnpj') }}">
        </div>

        <div class="col-md-12">
        <label for="name" class="form-label">E-mail: </label>
        <div class="input-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ old('email') }}">
        </div>
        </div>


        <div class="col-12">
        <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
        </div>
    </form>
    </div>
</div>





</div>




@endsection