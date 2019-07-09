@extends('layouts.app')
@section('title', 'Configurações')
@section('conteudo')
  <div id="conteudo">

    <div class="title">
      <h1><i class="fas fa-cog"></i>Configurações</h1>
      <h5 class="subtitle">Cadastramento de informações</h5>
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

      <ul class="nav nav-tabs" id="tabConfig" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="animal-tab" data-toggle="tab" href="#animal" role="tab" aria-controls="animal"
            aria-selected="true">Animais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="patrocinio-tab" data-toggle="tab" href="#patrocinio" role="tab"
            aria-controls="patrocinio" aria-selected="false">Patrocínio</a>
        </li>
      </ul>

      <div class="tab-content" id="tabConfigContent">

        <div class="tab-pane fade show active" id="animal" role="tabpanel" aria-labelledby="animal-tab">
          <div class="title-tab">
            <h2>Cadastrar Animais</h2>
          </div>
          <form action="/animais/cadastro" method="POST" enctype="multipart/form-data" class="row" id="cadastrarAnimal">
            @csrf
            <div class="form-group col-md-12">
              <label>Nome</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Nome do animal">
            </div>
            <div class="form-group col-md-6">
              <label>Porte</label>
              <select class="form-control" name="size" id="size">
                <option selected disabled>Ex: Grande, Medio ou Pequeno</option>
                <option>Grande</option>
                <option>Medio</option>
                <option>Pequeno</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Tipo</label>
              <select class="form-control" name="type" id="type">
                <option selected disabled>Ex: Cachorro, Gato ou Outro</option>
                <option>Cachorro</option>
                <option>Gato</option>
                <option>Outro</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Processo de adoção</label>
              <select class="form-control" name="adopted" id="adopted">
                <option selected disabled>Ex: Adotado, Aguardando ou Processo</option>
                <option value="0">Aguardando adoção</option>
                <option value="1">Em processo de adoção</option>
                <option value="2">Adotado</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <input type="file" id="fileElem" name="image" onchange="handleFiles(this.files)" required>
              <a href="#" id="fileSelect"><span class="badge badge-primary">Selecione a imagem</span></a>
              <div id="fileList">
                <p>Nenhum arquivo selecionado</p>
              </div>
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
                <h2>Listar Animais</h2>
              </div>
            </div>
            <table class="table text-center" id="tabelaAnimais">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th class="resp-table" scope="col"></th>
                  <th scope="col">Nome</th>
                  <th scope="col">Porte</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Status</th>
                  <th class="resp-table" scope="col">Descrição</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                  @if($animalCount == 0)
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>Não há animais cadastrados!</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  @else
                  @foreach($animal as $animais)
                <tr>
                  <th scope="row">{{$animais->id}}</th>
                  <td class="resp-table">
                    <div class="avatar-list">
                      <img src="{{$animais->avatarUrl}}" alt="Avatar" height="50px;" require>
                    </div>
                  </td>
                  <td>{{$animais->name}}</td>
                  <td>{{$animais->size}}</td>
                  <td>{{$animais->type}}</td>
                  @if($animais->adopted == 0)
                  <td>Aguardando Adoção</td>
                  @elseif($animais->adopted == 2)
                  <td>Adotado</td>
                  @else
                  <td>Em processo de adoção</td>
                  @endif
                  <td class="resp-table">{{$animais->description}}</td>
                  <td><i class="fas fa-edit" data-toggle="modal" data-target="#editarAnimais" title="Editar"></i></td>
                  <td><i class="fas fa-trash-alt" data-toggle="modal" data-target="#removerAnimais" title="Remover"></i>
                  </td>
                </tr>
                @endforeach
                @endif

              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="title-tab">
            <h2>Cadastrar Usuários</h2>
          </div>
          <form action="/users/register" method="POST" class="row" id="cadastrarUsuario">
            @csrf
            <div class="form-group col-md-12">
              <label>Nome</label>
              <input type="text" class="form-control" name="nameProfile" id="nameProfile" placeholder="Nome do usuário">
            </div>
            <div class="form-group col-md-12">
              <label>E-mail</label>
              <input type="email" class="form-control" name="emailProfile" id="emailProfile"
                placeholder="E-mail do usuário">
            </div>
            <div class="form-group col-md-6">
              <label>Senha</label>
              <input type="password" class="form-control" name="passProfile" id="passProfile"
                placeholder="Senha do usuário">
            </div>
            <div class="form-group col-md-6">
              <label>Permissão</label>
              <select class="form-control" name="typeAccount" id="typeAccount">
                <option selected disabled>Ex: Comum, Moderador ou Administrador</option>
                <option value="0">Comum</option>
                <option value="1">Moderador</option>
                <option value="2">Administrador</option>
              </select>
            </div>
            <button type="submit" class="btn">Salvar</button>
          </form>
          <hr>
          <div class="table-responsive">
            <div class="title-list">
              <div>
                <h2>Usuários</h2>
              </div>
            </div>
            <table class="table text-center" id="tabelaProfile">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">Nome</th>
                  <th class="resp-table" scope="col">E-mail</th>
                  <th scope="col">Contato</th>
                  <th class="resp-table" scope="col">Status</th>
                  <th class="resp-table" scope="col">Permissão</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $usuario)
                <tr>
                  <th scope="row">{{$usuario->id}}</th>
                  <td>{{$usuario->name}}</td>
                  <td class="resp-table">{{$usuario->email}}</td>
                  <td>{{$usuario->cellphone}}</td>
                  @if($usuario->activeAccount == 1)
                  <td class="resp-table">Ativo</td>
                  @else
                  <td class="resp-table">Inativo</td>
                  @endif
                  @if($usuario->typeAccount == 0)
                  <td class="resp-table">Comum</td>
                  @elseif($usuario->typeAccount == 1)
                  <td class="resp-table">Mod</td>
                  @else
                  <td class="resp-table">Admin</td>
                  @endif
                  <td><i class="fas fa-edit" data-toggle="modal" data-target="#editarProfile" title="Editar"></i></td>
                  <td><i class="fas fa-trash-alt" data-toggle="modal" data-target="#removerProfile" title="Remover"></i>
                  </td>
                  <td><i class="fas fa-envelope" data-toggle="modal" data-target="#getEmailProfile" title="Enviar e-mail"></i></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane fade" id="patrocinio" role="tabpanel" aria-labelledby="patrocinio-tab">
          <div class="title-tab">
            <h2>Cadastrar Patrocinadores</h2>
          </div>
          <form action="/patrocinadores/cadastrar" enctype="multipart/form-data" method="POST" class="row" id="cadastrarPatrocinio">
            @csrf
            <div class="form-group col-md-12">
              <label>Nome</label>
              <input type="text" class="form-control" name="namePatrocinio" id="namePatrocinio"
                placeholder="Nome do patrocinador">
            </div>
            <div class="form-group col-md-6">
              <label>E-mail</label>
              <input type="email" class="form-control" name="emailPatrocinio" id="emailPatrocinio"
                placeholder="E-mail do patrocinador">
            </div>
            <div class="form-group col-md-6">
              <label>Contato</label>
              <input type="text" class="form-control celNum" name="celPatrocinio" id="celPatrocinio"
                placeholder="(xx)xxxxx-xxxx">
            </div>
            <div class="form-group col-md-6"></div>
            <div class="form-group col-md-6">
              <label>Imagem Patrocínio</label>
              <input type="file" class="form-control-file" name="image" id="logoPatrocinio" required>
            </div>
            <button type="submit" class="btn">Salvar</button>
          </form>
          <hr>
          <div class="table-responsive">
            <div class="title-list">
              <div>
                <h2>Patrocinadores</h2>
              </div>
            </div>
            <table class="table text-center" id="tabelaPatrocinador">
              <thead>
                <tr>
                  <th scope="col">#ID</th>
                  <th class="resp-table" scope="col"></th>
                  <th scope="col">Nome</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Contato</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($sponsors as $patrocinador)
                <tr>
                  <th scope="row">{{$patrocinador->id}}</th>
                  <td class="resp-table">
                    <div class="avatar-list">
                      <img src="{{$patrocinador->logotypeUrl}}" alt="Avatar" height="50px;">
                    </div>
                  </td>
                  <td>{{$patrocinador->name}}</td>
                  <td>{{$patrocinador->email}}</td>
                  <td>{{$patrocinador->cellphone}}</td>
                  <td><i class="fas fa-edit" data-toggle="modal" data-target="#editarPratrocinio" title="Editar"></i>
                  </td>
                  <td><i class="fas fa-trash-alt" data-toggle="modal" data-target="#removerProfile" title="Remover"></i>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="editarAnimais" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar animais</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/animais/update" method="post" enctype="multipart/form-data" id="editarAnimal">
            @csrf
            <div class="form-group" id="idModalEditarAnimal">
              <label>ID</label>
              <input type="text" class="form-control" name="idAnimal" id="idAnimal" placeholder="Nome do animal">
            </div>
            <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" name="nameAnimal" id="nameAnimal" placeholder="Nome do animal">
            </div>
            <div class="form-group">
              <label>Porte</label>
              <select class="form-control" name="porteAnimal" id="porteAnimal">
                <option selected disabled>Ex: Grande, Medio ou Pequeno</option>
                <option>Grande</option>
                <option>Médio</option>
                <option>Pequeno</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tipo</label>
              <select class="form-control" name="typeAnimal" id="typeAnimal">
                <option selected disabled>Ex: Cachorro, Gato ou Outro</option>
                <option>Cachorro</option>
                <option>Gato</option>
                <option>Outro</option>
              </select>
            </div>
            <div class="form-group">
              <label>Processo de adoção</label>
              <select class="form-control" name="adoptedAnimal" id="adoptedAnimal">
                <option selected disabled>Ex: Adotado, Aguardando ou Processo</option>
                <option value="2">Adotado</option>
                <option value="0">Aguardando</option>
                <option value="1">Processo</option>
              </select>
            </div>
            <div class="form-group">
              <label>Selecione a imagem</label>
              <input type="file" name="image"  id="fileElemModal" required>
            </div>
            <div class="form-group">
              <label for="description">Descrição</label>
              <textarea class="form-control" name="descriptionAnimal" id="descriptionAnimal"
                placeholder="Insira uma descrição sobre o animal..." rows="3"></textarea>
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

  <div class="modal fade" id="editarProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/users/update" method="post" id="editarUsuario">
            @csrf
            <div class="form-group"  id="idModalEditarProfile">
              <label>ID</label>
              <input type="text" class="form-control" name="idProfile" id="idProfile">
            </div>
            <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" name="nomeProfile" id="nomeProfile" placeholder="Nome do usuário">
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" class="form-control" name="mailProfile" id="mailProfile"
                placeholder="E-mail do usuário">
            </div>
            <div class="form-group">
              <label>Celular</label>
              <input type="text" class="form-control celNum" name="celProfile" id="celProfile" placeholder="(xx) xxxxx-xxxx">
            </div>
            <div class="form-group">
              <label>Permissão</label>
              <select class="form-control" name="tipoConta" id="tipoConta">
                <option selected disabled>Ex: Comum, Moderador ou Administrador</option>
                <option value="0">Comum</option>
                <option value="1">Moderador</option>
                <option value="2">Administrador</option>
              </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="statusProfile" id="statusProfile">
                  <option selected disabled>Defina o Status</option>
                  <option value="0">Inativo</option>
                  <option value="1">Ativo</option>
                </select>
              </div>
            <button type="submit" class="btn btn-block btn-modal">Salvar</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="removerProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Remover usuário</h5>
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

  <div class="modal fade" id="getEmailProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar e-mail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>A mensagem chegará em breve!<p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-block btn-modal" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editarPratrocinio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar patrocinador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/patrocinadores/atualizar" method="post" id="editarPatrocinador">
            @csrf
            <div class="form-group" id="idModalEditarPatrocinador">
              <label>ID</label>
              <input type="text" class="form-control" name="idPatrocinador" id="idPatrocinador">
            </div>
            <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" name="nomePatrocinador" id="nomePatrocinador"
                placeholder="Nome do patrocinador">
            </div>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" class="form-control" name="mailPatrocinador" id="mailPatrocinador"
                placeholder="E-mail do patrocinador">
            </div>
            <div class="form-group">
              <label>Celular</label>
              <input type="text" class="form-control celNum" name="celPatrocinador" id="celPatrocinador" placeholder="(xx) xxxxx-xxxx">
            </div>
            <button type="submit" class="btn btn-block btn-modal">Salvar</button>
            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
