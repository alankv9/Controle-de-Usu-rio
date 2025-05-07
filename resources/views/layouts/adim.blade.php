<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Controle Usuários</title>
</head>
<body>
<header class="p-3 text-bg-dark">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Início</a></li>
          <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Listar Usuários</a></li>
          <li><a href="{{ route('empresa.index') }}" class=" nav-link px-2 text-white">Listar Empresas</a></li>
        </ul>

        <div class="dropdown text-end">
          <a href="#" id="dropdownToggle" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto de Perfil" width="40" height="40" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" id="userDropdown">
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userDataModal">Meus dados</a>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                @method('POST')
                    <button type="submit" class="dropdown-item text-danger">Sair</button>
                </form>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
    

<div class="modal fade" id="userDataModal" tabindex="-1" aria-labelledby="userDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <d class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDataModalLabel">Meus Dados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nome:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Empresa: </strong>{{ Auth::user()->empresa?->name ?? 'Nenhuma empresa vinculada' }}</p>
        <!-- Adicione mais campos se quiser -->
      </div>
<!-- Bootstrap Icons (coloque no <head> do seu layout se ainda não tiver) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="modal-footer d-flex justify-content-between w-100">
    <!-- Preciso modificar -->
    <img id="preview-image" src="{{ asset('image/') }}" class="rounded-circle" width="50" height="50">
    <label class="btn btn-primary mb-0">
        <i class="bi bi-upload"></i> Escolher Foto
        <input type="file" name="logo" accept="image/*" hidden onchange="previewPhoto(event)">
    </label>
    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Fechar</button>
</div>

    </div>
  </div>
</div>

    
</body>
</html>