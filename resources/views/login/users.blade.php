@extends('layouts.auth')

@section('content')
<main class="form-signin w-100 m-auto text-center bg-light rounded">
    <img class="mb-4" src="{{ assert('images') }}" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Controle de Usuário</h1>
    <x-alert/>
  <form action="{{ route('login.process') }}" method="post">
    @csrf
    <div class="form-floating mb-4">
      <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail de Usuário" value="{{ old('email') }}">
      <label for="email">Usuário</label>
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
    <a href="" class="text-decoration-none">Cadastrar</a>
  </form>
</main>


@endsection

