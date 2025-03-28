<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dados do Usuário</title>
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
        <h2>Dados do Usuário</h2>
        <p class="info"><strong>ID:</strong> {{ $user->id }}</p>
        <p class="info"><strong>Nome:</strong> {{ $user->name }}</p>
        <p class="info"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="info"><strong>Cadastrado:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</p>
        <p class="info"><strong>Editado:</strong> {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
