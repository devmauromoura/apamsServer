@extends('Layouts.app')
@section('title', 'Home')
@section('conteudo')

  <div id="conteudo">

    <div class="title">
      <h1><i class="fas fa-home"></i>Home</h1>
      <h5 class="subtitle">Informações gerais</h5>
    </div>

    <div class="article">
      <div class="row">

        <div class="col-md card box alert-info">
          <i class="fas fa-dog"></i>
          <div class="text-box">
            <h3>Cães Cadastrados</h3>
            @if($totalDog == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalDog}}</h1>
            @endif
          </div>
        </div>

        <div class="col-md card box alert-warning">
          <i class="fas fa-cat"></i>
          <div class="text-box">
            <h3>Gatos Cadastrados</h3>
            @if ($totalCat == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalCat}}</h1>
            @endif
          </div>
        </div>


        <div class="col-md card box alert-primary">
          <i class="fas fa-users"></i>
          <div class="text-box">
            <h3>Usuários Cadastrados</h3>
            @if($totalUsers == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalUsers}}</h1>
            @endif
          </div>
        </div>


        <div class="col-md card box alert-success">
          <i class="fas fa-paw"></i>
          <div class="text-box">
            <h3>Animais Adotados</h3>
            @if ($totalAdopted == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalAdopted}}</h1>
            @endif
          </div>
        </div>


        <div class="col-md card box alert-secondary">
          <i class="fas fa-search"></i>
          <div class="text-box">
            <h3>Animais sem adoção</h3>
            @if ($totalNoAdopted == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalNoAdopted}}</h1>
            @endif
          </div>
        </div>


        <div class="col-md card box alert-danger">
          <i class="fas fa-bullhorn"></i>
          <div class="text-box">
            <h3>Patrocinadores</h3>
            @if ($totalSponsors == 0)
            <h1 class="float-right">0</h1>
            @else
            <h1 class="float-right">{{$totalSponsors}}</h1>
            @endif
          </div>
        </div>


      </div>
    </div>
  </div>
@endsection