<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Patricinadores</title>
</head>
<body>
    <form action="/patrocinadores/cadastrar" method="post">
        @csrf
        <input type="text" name="name" placeholder="Nome do Patrocinador">
        <input type="text" name="logoTypeUrl" placeholder="url Image">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>