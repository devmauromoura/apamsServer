<form action="{{ (isset($dados->id)) ? url('/patrocinadores/editar/'.$dados->id) : url('/patrocinadores/salvar') }}" method="post" id="form_post"  enctype="multipart/form-data">

	@csrf

	<div class="form-group">
		<label>Nome</label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do patrocinador" value="{{ (isset($dados->name)) ? $dados->name : "" }}">
	</div>

	<div class="form-group">
		<label>E-mail</label>
		<input type="email" class="form-control" name="email" id="email" placeholder="E-mail do patrocinador" value="{{ (isset($dados->email)) ? $dados->email : "" }}">
	</div>

	<div class="form-group">
		<label>Contato</label>
		<input type="text" class="form-control" name="contato" id="contato" value="{{ (isset($dados->cellphone)) ? $dados->cellphone : "" }}">
	</div>

	<div class="form-group" style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
		<label>Imagem</label>
		<div class="input-images-patrocinador"></div>
	</div>

	<div class="form-group">
		<label for="description">Descrição</label>
		<textarea class="form-control" name="descricao" id="descricao" placeholder="Insira uma descrição..." rows="3">{{ (isset($dados->description)) ? $dados->description : '' }}</textarea>
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
			nome: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			contato: {
				required: true
			}
		},
		messages: {
			nome: {
				required: "Nome obrigatório",
			},
			email: {
				required: "E-mail obrigatório",
			},
			contato: {
				required: "Contato obrigatório",
			}
		}
	});

	$('.input-images-patrocinador').imageUploader({
		@isset($dados->id)
			@if($dados->avatar !== "" && $dados->avatar !== null)
				preloaded: [
					{id:'{{ $dados->avatar }}', src:'{{ asset('storage/patrocinadores/'.$dados->avatar) }}'},
				],
			@endif
		@endisset
		label:'Abrir imagem',
		maxFiles: 1
	});
</script>