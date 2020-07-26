<form action="{{ (isset($dados['animal']->id)) ? url('/animais/editar/'.$dados['animal']->id) : url('/animais/salvar') }}" method="post" id="form_animais" enctype="multipart/form-data">

	@csrf

	<div class="row">

		<div class="form-group col-lg-6">
			<label>Nome</label>
			<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="{{ (isset($dados['animal']->name)) ? $dados['animal']->name : "" }}">
		</div>

		<div class="form-group col-lg-3">
			<label>Idade</label>
			<input type="text" class="form-control" name="idade" id="idade" placeholder="Idade" value="{{ (isset($dados['animal']->age)) ? $dados['animal']->age : "" }}">
		</div>

		<div class="form-group col-lg-3">
			<label>Peso</label>
			<input type="text" class="form-control" name="peso" id="peso" placeholder="Peso" value="{{ (isset($dados['animal']->weight)) ? $dados['animal']->weight : "" }}">
		</div>
	

	</div>

	<div class="row">
	
		<div class="form-group col-lg-3">
			<label>Porte</label>
			<select class="form-control" name="porte" id="porte">
				<option selected disabled>Selecione</option>
				<option {{ isset($dados['animal']->size) ? ($dados['animal']->size == "Grande") ? 'selected' : '' : '' }}>Grande</option>
				<option {{ isset($dados['animal']->size) ? ($dados['animal']->size == "Medio") ? 'selected' : '' : '' }}>Medio</option>
				<option {{ isset($dados['animal']->size) ? ($dados['animal']->size == "Pequeno") ? 'selected' : '' : '' }}>Pequeno</option>
			</select>
		</div>

		<div class="form-group col-lg-3">
			<label>Tipo</label>
			<select class="form-control" name="tipo" id="tipo">
				<option selected disabled>Selecione</option>
				<option {{ isset($dados['animal']->type) ? ($dados['animal']->type == "Cachorro") ? 'selected' : '' : '' }}>Cachorro</option>
				<option {{ isset($dados['animal']->type) ? ($dados['animal']->type == "Gato") ? 'selected' : '' : '' }}>Gato</option>
				<option {{ isset($dados['animal']->type) ? ($dados['animal']->type == "Outro") ? 'selected' : '' : '' }}>Outro</option>
			</select>
		</div>

		<div class="form-group col-lg-3">
			<label>Sexo</label>
			<select class="form-control" name="sexo" id="sexo">
				<option selected disabled>Selecione</option>
				<option {{ isset($dados['animal']->sex) ? ($dados['animal']->sex == "M") ? 'selected' : '' : '' }}>M</option>
				<option {{ isset($dados['animal']->sex) ? ($dados['animal']->sex == "F") ? 'selected' : '' : '' }}>F</option>
			</select>
		</div>

		<div class="form-group col-lg-3">
			<label>Processo de adoção</label>
			<select class="form-control" name="status" id="status">
				<option selected disabled>Selecione</option>
				<option value="0" {{ isset($dados['animal']->adopted) ? ($dados['animal']->adopted == "0") ? 'selected' : '' : '' }}>Não adotado</option>
				<option value="1" {{ isset($dados['animal']->adopted) ? ($dados['animal']->adopted == "1") ? 'selected' : '' : '' }}>Em adoção</option>
				<option value="2" {{ isset($dados['animal']->adopted) ? ($dados['animal']->adopted == "2") ? 'selected' : '' : '' }}>Adotado</option>
			</select>
		</div>

	</div>

	<div class="row">
		
		<div class="form-group col-lg-3">
			<label>Avatar</label>
			<div class="input-images-avatar"></div>
		</div>

		<div class="form-group col-lg-9">
			<label>Galeria</label>
			<div class="input-images-gallery"></div>
		</div>

	</div>

	<div class="form-group">
		<label for="description">História</label>
		<textarea class="form-control" name="historia" id="historia" placeholder="Insira uma história sobre o animal..." rows="3">{{ (isset($dados['animal']->history)) ? $dados['animal']->history : "" }}</textarea>
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

	$("#form_animais").validate({
		rules: {
			nome: {
				required: true
			},
			idade: {
				required: true
			},
			peso: {
				required: true
			},
			porte: {
				required: true
			},
			tipo: {
				required: true
			},
			sexo: {
				required: true
			},
			status: {
				required: true
			},
		},
		messages: {
			nome: {
				required: "Nome é obrigatório"
			},
			idade: {
				required: "Idade é obrigatório"
			},
			peso: {
				required: "Peso é obrigatório"
			},
			porte: {
				required: "Porte é obrigatório"
			},
			tipo: {
				required: "Tipo é obrigatório"
			},
			sexo: {
				required: "Sexo é obrigatório"
			},
			status: {
				required: "Processo é obrigatório"
			},
		}
	});

	$('.input-images-avatar').imageUploader({
		@isset($dados['animal']->id)
			@if($dados['animal']->avatar_url !== "" && $dados['animal']->avatar_url !== null)
				preloaded: [
						{ id:{{ $dados['animal']->id }}, src:'{{ asset($dados['animal']->avatar_url) }}' },
				],
			@endif
		@endisset
		label:'Abrir imagem',
		imagesInputName: "images_avatar",
		preloadedInputName: "preloaded_avatar",
		maxFiles: 1
	});

	$('.input-images-gallery').imageUploader({
		@isset($dados['animal']->id)
			preloaded: [
				@foreach($dados['galeria'] as $glr)
					{id:{{ $glr->id }}, src:'{{ asset($glr->image_url) }}'},
				@endforeach
			],
		@endisset
		label:'Arraste e solte arquivos aqui ou clique para navegar',
		imagesInputName: "images_gallery",
        preloadedInputName: "preloaded_gallery",
	});

</script>