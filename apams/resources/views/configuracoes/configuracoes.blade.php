@extends('Layouts.app')
@section('title', 'Postagens')
@section('conteudo')

<div id="conteudo">

	<div class="title">
		<h1>
			<i class="fas fa-cog"></i>Configurações
		</h1>
		<h5 class="subtitle">Configurações do sistema</h5>
	</div>

	<div class="article">

		<div class="">

			<div class="title-list">
				<div>
					<h2>Configurações</h2>
				</div>
			</div>

			<form action="{{ url('/configuracoes/salvar') }}" method="POST" id="form_post_settings">

				@csrf

				<h4>Sobre</h4>
				<hr>

				<div class="row mb-3">
					<div class="col-lg-6">
						<label>E-mail</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ (isset($dados->adopt_mail)) ? $dados->adopt_mail : "" }}">
					</div>
					<div class="col-lg-6">
						<label>Título</label>
						<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value="{{ (isset($dados->title)) ? $dados->title : "" }}">
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-lg-12">
						<label>Descrição</label>
						<textarea class="form-control" name="descricao" id="descricao" placeholder="Insira uma descrição" rows="3">{{ (isset($dados->description)) ? $dados->description : "" }}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3">
						<button type="submit" class="btn btn-block btn-modal">Salvar</button>
					</div>
				</div>
			
			</form>

			
		</div>

	</div>

</div>

<script>
		$("#form_post_settings").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				titulo: {
					required: true
				},
				descricao: {
					required: true
				}
			},
			messages: {
				email: {
					required: "E-mail obrigatório",
				},
				titulo: {
					required: "Titulo obrigatório",
				},
				descricao: {
					required: "Descrição obrigatório",
				}
			}
		});
</script>
@endsection