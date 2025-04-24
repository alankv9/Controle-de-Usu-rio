@extends('layouts.auth')

@section('content')

<main class="form-signin w-100 m-auto text-center bg-light rounded">
    <img class="mb-4" src="{{ assert('images') }}" href="{{ route('login') }}" alt="..." width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Controle de Usuário</h1>
    <x-alert/>
  <form action="{{ route('cadastrar.process') }}" method="post">
    @csrf
    <div class="form-floating mb-4">
      <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
      <label for="name">Nome Usuário</label>
    </div>

    <div class="form-floating mb-4">
      <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
      <label for="email">E-mail</label>
    </div>

    <div class="mb-4">
        <div class="input-group">
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password">
                <label for="password">Senha</label>
            </div>
            <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye-slash-fill"></i></span>
        </div>
   </div>
   <div class="mb-4">
        <div class="input-group">
            <div class="form-floating">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                <label for="password">Confirmar Senha</label>
            </div>
            <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye-slash-fill"></i></span>
        </div>
   </div>
    <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Enviar</button>
  </form>
  <!-- <a href="" class="btn btn-primary w-100 py-2 mb-2" type="submit">Redefinir Senha</a> -->
</main>



@endsection