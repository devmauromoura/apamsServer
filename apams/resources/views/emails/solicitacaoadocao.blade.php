<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha - APAMS</title>
</head>
<body style="color: #000;font-family: sans-serif;font-size: 1rem;">
    <div class="block-set" style="width: 600px;height: 600px;background-image: url(http://137.220.42.176/filling.png);">
        <div class="blockets" style="width: 24rem;height: 15rem;padding: 1rem;font-weight: 700;float: right;text-align: center;margin-top: 2rem;">
            <p style="margin: 0.5rem 0;">Olá, temos uma nova solicitação de adoção.</p>
            <p style="margin: 0.5rem 0;">Abaixo segue o formulário com mais informações.</p>
            <table style="width:100%;text-align: initial;margin-left: 3rem;">
                <tr>
                    <td style="padding: 0.2rem"><b>Animal:</b> {{$data['animal']['name']}}</td>
                </tr>
                <tr>
                    <td style="padding: 0.2rem"><b>Solicitante:</b> {{$data['user']['name']}}</td>
                </tr>
                <tr>
                    <td style="padding: 0.2rem"><b>E-mail:</b> {{$data['user']['email']}}</td>
                </tr>
                <tr>
                    <td style="padding: 0.2rem"><b>Contato:</b> {{$data['user']['cellphone']}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>