@extends('layouts.auth')

@section('content')

<div class="container">
    <h2>Esqueci minha senha</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="">
    @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Enviar link de redefinição de senha
        </button>
    </form>
</div>
@endsection