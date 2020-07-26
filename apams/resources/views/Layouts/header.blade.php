<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/gif" href="{{ asset('apams.png') }}" />
  <title>Painel de controle - APAMS</title>

  <!-- Default style -->  
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- Default style -->  

  <!-- Jquery -->  
  <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.js') }}"></script>
  <!-- Jquery -->  

  <!-- Datatable -->
  <link type="text/css" href="{{ asset('css/datatables.css') }}" rel="stylesheet" />
  <script type="text/javascript" src="{{ asset('js/datatables.js') }}"></script>
  <!-- Datatable -->

  <!-- Notify -->
  <script type="text/javascript" src="{{ asset('js/bootstrap-notify.js') }}"></script>
  <link type="text/css" href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
  <!-- Notify -->

  <!-- Validate -->
  <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
  <!-- Validate -->

  <!-- Mask -->
  <script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
  <!-- Mask -->

  <!-- sweetAlert -->
  <script type="text/javascript" src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <link type="text/css" href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />
  <!-- sweetAlert -->

  <!-- image uploader -->
  <script type="text/javascript" src="{{ asset('js/image-uploader.min.js') }}"></script>
  <link type="text/css" href="{{ asset('css/image-uploader.min.css') }}" rel="stylesheet" />
  <!-- image uploader -->
  
  <!-- Bootstrap -->
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
  <link type="text/css" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <!-- Bootstrap -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

</head>

<body>

  <div id="menu" class="left show">

	<div class="user">
		<img src="{{ asset('img/logo.png') }}" alt="APAMS" height="100px">
		<hr style="margin-top: 1rem;width: 80%;margin-bottom: 1rem;border: 0;border-top: 1px solid rgb(236 239 241);">
		@if($avatarUserAuth !== null && $avatarUserAuth !== "")
			<img class="icon-user" src="{{ asset('storage/users_avatar/'.$avatarUserAuth) }}" alt="APAMS" height="100px" style="border-radius: 3rem;">
		@else
			<img class="icon-user" src="{{ asset('user.png') }}" alt="APAMS" height="100px" style="border-radius: 3rem;">
		@endif
		<h5>Bem vindo,<br> {{$nameUserAuth}}!</h5>
	</div>

	<ul>
		<a href="{{ url('home') }}"><li class="{{ (Request::is('home')) ? "btn-active" : "" }}"><i class="fas fa-home"></i>Home</li></a>
		<a href="{{ url('postagens') }}"><li class="{{ (Request::is('postagens')) ? "btn-active" : "" }}"><i class="fas fa-th-list"></i>Postagens</li></a>
		<a href="{{ url('animais') }}"><li class="{{ (Request::is('animais')) ? "btn-active" : "" }}"><i class="fas fa-paw"></i>Animais</li></a>
		<a href="{{ url('patrocinadores') }}"><li class="{{ (Request::is('patrocinadores')) ? "btn-active" : "" }}"><i class="fas fa-building"></i></i>Patrocinadores</li></a>
		<a href="{{ url('usuarios') }}"><li class="{{ (Request::is('usuarios')) ? "btn-active" : "" }}"><i class="fas fa-user"></i>Usuários</li></a>
		<a href="{{ url('configuracoes') }}"><li class="{{ (Request::is('configuracoes')) ? "btn-active" : "" }}"><i class="fas fa-cog"></i>Configurações</li></a>
		<a href="{{ url('sair') }}"><li><i class="fas fa-sign-out-alt"></i>Sair</li></a>
	</ul>

	<a href="#" id="showmenu"> 
		<i class="fa fa-align-justify"></i>
	</a>
  </div>