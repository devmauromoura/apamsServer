@extends('Layouts.app')
@section('title', 'Notificações')
@section('conteudo')

 <div id="conteudo">

    <div class="title">
      <h1><i class="fas fa-bell"></i>Notificações</h1>
      <h5 class="subtitle">Notificações para os clientes</h5>
    </div>
    @if(session()->has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session()->get('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="article">
      <div class="title-tab">
        <h2>Notificações</h2>
      </div>
      <form action="/notificacoes/create" method="post" class="row" id="notificacao">
        @csrf
        <div class="form-group col-md-12">
          <label>Titulo</label>
          <input type="text" class="form-control" name="tituloNot" id="tituloNot" placeholder="Titulo da postagem">
        </div>
        <div class="form-group col-md-6">
          <label>Patrocinadores</label>
          <select class="form-control" name="patroNot" id="patroNot">
            <option selected disabled>Procurar patrocinadores</option>
            @foreach($dataSponsors as $patrocinador)
            <option value="{{$patrocinador->id}}">{{$patrocinador->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Status</label>
          <select class="form-control" name="statusNot" id="statusNot">
            <option value="1" selected>Ativo</option>
            <option value="0" >Inativo</option>
          </select>
        </div>
        <div class="form-group col-md-12">
          <label for="description">Descrição</label>
          <textarea class="form-control" name="descriptionNot" id="descriptionNot"
            placeholder="Insira uma descrição para a notificação..." rows="3"></textarea>
        </div>
        <button type="submit" class="btn">Salvar</button>
      </form>
      <hr>
      <div class="table-responsive">
        <div class="title-list">
          <div>
            <h2>Posts</h2>
          </div>
        </div>
        <table class="display table text-center" id="listNot">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Titulo</th>
              <th scope="col">Patrocinador</th>
              <th scope="col">Status</th>
              <th class="resp-table" scope="col">Descrição</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataNotification as $notif)
            <tr>
              <th scope="row">{{$notif->id}}</th>
              <td>{{$notif->title}}</td>
              <td>{{$notif->sname}}</td>
              @if($notif->status == 0)
              <td>Inativo</td>
              @else
              <td>Ativo</td>
              @endif
              <td class="resp-table">{{$notif->description}}</td>
              <td></td>
              <td><i class="fas fa-trash-alt" data-toggle="modal" data-target="#removerPost" title="Remover"></i>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
  </div>

  <div class="modal fade" id="editarNot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar notificação</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="" id="editarNot">
            <div class="form-group" id="idModalEditarNot">
              <label>ID</label>
              <input type="text" class="form-control" id="idNot">
            </div>
            <div class="form-group">
              <label>Titulo</label>
              <input type="text" class="form-control" name="editarTitulo" id="editarTitulo" placeholder="Titulo da postagem">
            </div>
            <div class="form-group">
              <label>Patrocinador</label>
              <select class="form-control" name="editarPatrocinador" id="editarPatrocinador">
                <option selected disabled>Procurar patrocinador</option>
                <option>Default</option>
              </select>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="editarStatus" id="editarStatus">
                <option value="1" selected>Ativo</option>
                <option value="0">Desativado</option>
              </select>
            </div>
            <div class="form-group">
              <label for="description">Descrição</label>
              <textarea class="form-control" name="descriptionNot" id="descriptionNot"
                placeholder="Insira uma descrição..." rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-block btn-modal">Salvar</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="removerAnimais" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Remover animais</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Deseja remover este cadastro?<p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-block btn-modal">Sim</button>
          <button type="button" class="btn btn-block btn-exit" data-dismiss="modal">Não</button>
        </div>
      </div>
    </div>
  </div>

@endsection
