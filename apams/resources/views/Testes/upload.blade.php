<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Arquivo</title>
</head>
<body>
    <form action="/testes/upload/enviar" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="imagemUp" id="file"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>