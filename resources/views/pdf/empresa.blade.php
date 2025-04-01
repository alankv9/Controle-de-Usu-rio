<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dados da Empresa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { border: 1px solid #ccc; padding: 20px; width: 400px; }
        h2 { text-align: center; }
        p { font-size: 16px; }
        .info { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container" >
        <h2>Dados do Empresa</h2>
        <p class="info"><strong>ID:</strong> {{ $empresa->id }}</p>
        <p class="info"><strong>Nome:</strong> {{ $empresa->name }}</p>
        <p class="info"><strong>Cnpj</strong>{{ $empresa->cnpj }}</p>
        <p class="info"><strong>Email:</strong> {{ $empresa->email }}</p>
        <p class="info"><strong>Cadastrado:</strong> {{ \Carbon\Carbon::parse($empresa->created_at)->format('d/m/Y H:i:s') }}</p>
        <p class="info"><strong>Editado:</strong> {{ \Carbon\Carbon::parse($empresa->updated_at)->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
