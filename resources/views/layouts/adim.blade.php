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

<!-- <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Início</a></li>
          <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Listar Usuários</a></li>
          <li><a href="{{ route('empresa.index') }}" class=" nav-link px-2 text-white">Listar Empresas</a></li>
          <li><a href="" class="" class="nav-link px-2 text-white"></a></li>
        </ul>

        <div class="text-end">
          <a href="{{ route('logout') }}" type="button" class="btn btn-outline-light me-2">Sair</a>
        </div>
      </div>
    </div>
  </header> -->
<header class="p-3 text-bg-dark">
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
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" id="userDropdown">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li>
                <form method="post" action="{{ route('logout') }}">
                    <button type="submit" class="dropdown-item text-danger">Sair</button>
                </form>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <div class="container">
        @yield('content')
    </div>
    
    
    
</body>
</html>