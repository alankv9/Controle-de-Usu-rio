@extends('layouts.adim')

@section('content')

<div class="card mt-4 mb-4 border-ligth shadow">
    <div class="card-header hstack gap-2">
        <span>Listar Empresa</span>

        <span class="ms-auto">
            <a href="{{ route('empresa.create') }} " class="btn btn-success btn-sm">Cadastrar Nova Empresa</a>
        </span>
    </div>

    <div class="card-body">

    <x-alert/>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cnpj</t>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
    <tbody>

    @foreach ($empresas as $empresa )
    <tr>
      <th>{{ $empresa->id }}</th>
      <th>{{ $empresa->cnpj }}</th>
      <td>{{ $empresa->name }}</td>
      <td>{{ $empresa->email }}</td>
      <td class="text-center">
      <a href="{{ route('empresa.show', $empresa->id) }}" class="btn btn-primary btn-sm" >Visualizar</a> 
        <a href="{{ route('empresa.edit', $empresa->id)  }}" class="btn btn-warning btn-sm">Editar Usuário</a>

        <form method="POST" action="{{ route('empresa.destroy', $empresa->id) }}" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que dejesa apagar esse usuário')">Remover Usuário</button>
        </form>
      </td>
    </tr>
    @endforeach

    </tbody>
    </table>

      {{ $empresas->links() }}
    
    </div>
  </div>


@endsection