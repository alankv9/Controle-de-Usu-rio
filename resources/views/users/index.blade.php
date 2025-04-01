@extends('layouts.adim')

@section('content')
<div class="card mt-4 mb-4 border-ligth shadow">

    <div class="card-header hstack gap-2">
        <span>Listar Usuarios</span>

        <span class="ms-auto">
            <a href="{{ route('users.create') }} " class="btn btn-success btn-sm">Cadastrar Novo Usuário</a>
        </span>
    </div>

    <div class="card-body">

        <x-alert/>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Empresa</th>
      <th scope="col" class="text-center">Ações</th>
    </tr>
  </thead>
  <tbody>


    @foreach ($users as $user)
      <tr>
        <th>{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->empresa }}</td>
        <td class="text-center">
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm" >Visualizar</a> 
          <a href="{{ route('users.edit', $user->id)  }}" class="btn btn-warning btn-sm">Editar Usuário</a>

          <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que dejesa apagar esse usuário')">Remover Usuário</button>
          </form>
        </td>
      </tr>
    @endforeach

    </tbody>
    </table>

      {{ $users->links() }}
    
    </div>
  </div>

@endsection

