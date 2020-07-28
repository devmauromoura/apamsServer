<form action="{{ (isset($dados->id)) ? url('/postagens/editar/'.$dados->id) : url('/postagens/salvar') }}" method="post" id="form_post" enctype="multipart/form-data">

	@csrf

	<div class="form-group">
		<label>Titulo</label>
		<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo da postagem" value="{{ (isset($dados->title)) ? $dados->title : '' }}">
	</div>

	<div class="form-group">
		<label for="description">Descrição</label>
		<textarea class="form-control" name="descricao" id="descricao" placeholder="Insira uma descrição..." rows="3">{{ (isset($dados->description)) ? $dados->description : '' }}</textarea>
	</div>

	<div class="form-group" style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
		<label>Imagem</label>
		<div class="input-images-post"></div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<button type="submit" class="btn btn-block btn-modal">Salvar</button>
		</div>
		<div class="col-lg-6">
			<button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Sair</button>
		</div>
	</div>

</form>

<script>
	
	$("#form_post").validate({
		rules: {
			titulo: {
				required: true
			},
			descricao: {
				required: true
			},
		},
		messages: {
			titulo: {
				required: "Titulo obrigatório",
			},
			descricao: {
				required: "Descrição obrigatório",
			},
		}
	});

	$('.input-images-post').imageUploader({
		@isset($dados->id)
			@if($dados->image !== "" && $dados->image !== null)
				preloaded: [
					{id:{{ $dados->id }}, src:'{{ asset($dados->image) }}'},
				],
			@endif
		@endisset
		label:'Abrir imagem',
		maxFiles: 1
	});

</script>