<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ADM APAMS</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link type="text/css" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

</head>

<body>


    <main>

        <section banner>
        </section>

        <section login>

            <div logo>
                <img src="./img/logo.png" alt="APAMS" height="150px">
            </div>

            <div class="title">
                <h3>Central de gerenciamento APP</h3>
            </div>
            @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label>Endereço de email</label>
                    <input type="email" class="form-control" name="email" placeholder="Seu email">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="Senha">
                </div>
                <button type="submit" class="btn btn-block">Entrar</button>
            </form>

        </section>

    </main>

</body>

</html>
