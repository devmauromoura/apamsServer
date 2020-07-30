<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha - APAMS</title>
</head>
<body style="color: #000;font-family: sans-serif;font-size: 1.2rem;">
    <div class="block-set" style="width: 600px;height: 600px;background-image: url(http://137.220.42.176/filling.png);">
        <div class="blockets" style="width: 24rem;height: 15rem;padding: 1rem;font-weight: 700;float: right;text-align: center;margin-top: 3rem;">
            <p style="margin: 0.5rem 0;">Olá, {{ $data['name'] }}.</p>
            <p style="margin: 0.5rem 0;">Abaixo segue a nova senha para acesso.</p>
            <p style="width: auto;border: 4px solid #f8a73f;padding: 0.5rem;margin: 0 3rem;;border-radius: 0.5rem;">{{ $data['newpassword'] }}</p>
        </div>
    </div>
</body>
</html>