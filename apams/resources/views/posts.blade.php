@extends('layouts.app')
@section('title', 'Postagens')
@section('conteudo')
<div id="conteudo">

    <div class="title">
      <h1><i class="fas fa-th-list"></i>Postagens</h1>
      <h5 class="subtitle">Postagens de publicações</h5>
    </div>

    <div class="article">
      <div class="title-tab">
        <h2>Postagens</h2>
      </div>
      <form action="/postagens/create" method="post" class="row" id="postAnimal">
      	@csrf
        <div class="form-group col-md-12">
          <label>Titulo</label>
          <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo da postagem">
        </div>
        <div class="form-group col-md-6">
          <label>Animal</label>
          <select class="form-control" name="animal" id="animal">
            <option selected disabled>Procurar animal</option>
         	@foreach($animals as $animais)
            <option value="{{$animais->id}}">{{$animais->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Finalidade da postagem</label>
          <select class="form-control" name="finalidade" id="finalidade">
            <option selected value="1">Adoção</option>
          </select>
        </div>
        <div class="form-group col-md-12">
          <label for="description">Descrição</label>
          <textarea class="form-control" name="description" id="description"
            placeholder="Insira uma descrição sobre o animal..." rows="3"></textarea>
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
        <table class="display table text-center" id="listPost">
          <thead>
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Titulo</th>
              <th scope="col">Animal</th>
              <th scope="col">Status</th>
              <th class="resp-table" scope="col">Descrição</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          	@foreach($posts as $post)
            <tr>
              <th scope="row">{{$post->id}}</th>
              <td>{{$post->title}}</td>
              <td>{{$post->animalNome}}</td>
              @if($post->status == 0)
              <td>Aguardando Adoção</td>
              @else
              <td>Adotado</td>
              @endif
              <td class="resp-table">Thanos e um vira-lata da cor preta e porte médio, muito brincalhão...</td>
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

  <div class="modal fade" id="editarPost" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/postagens/update" method="post" id="editarPost">
            @csrf
            <div class="form-group" id="idModalEditarPost">
              <input type="text" class="form-control" id="idPost" style="display: none;">
            </div>
            <div class="form-group">
              <label>Titulo</label>
              <input type="text" class="form-control" name="editarTitulo" id="editarTitulo" placeholder="Titulo da postagem">
            </div>
            <div class="form-group">
              <label>Animal</label>
              <select class="form-control" name="editarAnimal" id="editarAnimal">
                <option selected disabled>Procurar animal</option>
                @foreach($animals as $animais)
                <option value="{{$animais->id}}">{{$animais->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Finalidade da postagem</label>
              <select class="form-control" name="editarFinalidade" id="editarFinalidade">
                <option selected disabled value="0">Adoção</option>
              </select>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="statusPost" id="statusPost">
                <option value="1" selected>Adotado</option>
                <option value="0">Aguardando Adoção</option>
              </select>
            </div>
            <div class="form-group">
              <label for="description">Descrição</label>
              <textarea class="form-control" name="descriptionPost" id="descriptionPost"
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