<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ADM APAMS</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>

<body>

  <div id="menu" class="left show">
    <div class="user">
      <img src="./img/logo.png" alt="APAMS" height="100px">
      <h5>Bem vindo,<br> {{$nameUserAuth}}!</h5>
    </div>
    <ul>
      <a href="\home"><li><i class="fas fa-home"></i>Home</li></a>
      <a href="\postagens"><li><i class="fas fa-th-list"></i>Postagens</li></a>
      <a href="\notificaoes"><li><i class="fas fa-bell"></i>Notificações</li></a>
      <a href="\configuracoes"><li><i class="fas fa-cog"></i>Configurações</li></a>
      <a href="\sair"><li><i class="fas fa-sign-out-alt"></i>Sair</li></a>
    </ul>
    <a href="#" id="showmenu">
      <i class="fa fa-align-justify"></i>
    </a>
  </div>