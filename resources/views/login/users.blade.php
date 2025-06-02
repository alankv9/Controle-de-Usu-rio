@extends('layouts.auth')

@section('content')
<main class="form-signin w-100 m-auto text-center bg-light rounded">
    <img class="mb-4" src="{{ assert('images') }}" alt="..." width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Controle de Usuário</h1>
    <x-alert/>
  <form action="{{ route('login.process') }}" method="post">
    @csrf
    <div class="form-floating mb-4">
      <input type="text" name="name" class="form-control" id="name" placeholder="Digite o nome de Usuário" value="{{ old('name') }}">
      <label for="name">Usuário</label>
    </div>

    <div class="mb-4">
        <div class="input-group">
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
                <label for="password">Senha</label>
            </div>
            <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye-slash-fill"></i></span>
        </div>
   </div>

    <button class="btn btn-primary w-100 py-2 mb-4" type="submit">Acessar</button>
    <div>
    <a href="{{ route('cadastrar') }}" class="text-decoration-none">Cadastrar</a>
    </div>
    <div>
    <a href="{{ route('password.request') }}"class="text-decoration-none">Redefinição de senha</a>
    </div>
  </form>
</main>


@endsection

