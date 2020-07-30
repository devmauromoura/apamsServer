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

    <div class="modal fade" id="recuperarsenhamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recuperar senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Insira o e-mail para recuperar sua senha.</label>
                    <input type="email" class="form-control" name="email_recuperar" id="email_recuperar" placeholder="E-mail">
                    <small class="alert-danger" style="display:none;">Desculpe, ocorreu um erro ao solicitar a recuperação de senha.</small>
                    <small class="alert-success" style="display:none;">E-mail de recuperação enviado com sucesso.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary btn-submit-recuperarsenha" style="background-color: #f93;color: #FFF;border-color:#f93;">Enviar</button>
            </div>
            </div>
        </div>
    </div>


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
                <small class="btn-recuperar-senha">Recuperar senha</small>
                <button type="submit" class="btn btn-block">Entrar</button>
            </form>

        </section>

    </main>

    <script>

        $('.btn-recuperar-senha').on('click', function(){
            $('#recuperarsenhamodal').modal('show')
        })

        $('.btn-submit-recuperarsenha').on('click', function(){
            $('.btn-submit-recuperarsenha').prop('disabled', true);
            let email = $('#email_recuperar').val();
            var settings = {
                "url": `{{ url('/recuperarsenha') }}/${email}`,
                "method": "GET"
            };

            $.ajax(settings).done(function (response) {
                if(response.status == true){
                    $('.alert-success').css('display','block');
                    $('.alert-danger').css('display','none');
                    $('.btn-submit-recuperarsenha').prop('disabled', false);
                } else {
                    $('.alert-danger').css('display','block');
                    $('.alert-success').css('display','none');
                    $('.btn-submit-recuperarsenha').prop('disabled', false);
                }
            });
        })
        
    </script>
</body>


</html>
