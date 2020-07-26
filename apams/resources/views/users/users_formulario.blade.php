@php
	if(isset($dados->id)){
		$arr = json_decode($dados->permissoes);

		$postV = (in_array("postV", $arr)) ? true : false;
		$postC = (in_array("postC", $arr)) ? true : false;
		$postE = (in_array("postE", $arr)) ? true : false;
		$postR = (in_array("postR", $arr)) ? true : false;
		$animalV = (in_array("animalV", $arr)) ? true : false;
		$animalC = (in_array("animalC", $arr)) ? true : false;
		$animalE = (in_array("animalE", $arr)) ? true : false;
		$animalR = (in_array("animalR", $arr)) ? true : false;
		$userV = (in_array("userV", $arr)) ? true : false;
		$userC = (in_array("userC", $arr)) ? true : false;
		$userE = (in_array("userE", $arr)) ? true : false;
		$userR = (in_array("userR", $arr)) ? true : false;
		$patrocinadorV = (in_array("patrocinadorV", $arr)) ? true : false;
		$patrocinadorC = (in_array("patrocinadorC", $arr)) ? true : false;
		$patrocinadorE = (in_array("patrocinadorE", $arr)) ? true : false;
		$patrocinadorR = (in_array("patrocinadorR", $arr)) ? true : false;
		$configuracaoE = (in_array("configuracaoE", $arr)) ? true : false;
	}	
@endphp

<form action="{{ (isset($dados->id)) ? url('/usuarios/editar/'.$dados->id) : url('/usuarios/salvar') }}" method="POST" id="form_post" enctype="multipart/form-data">

	@csrf

	<div class="row">
		<div class="form-group col-lg-3">
			<label>Imagem</label>
			<div class="input-images-user"></div>
		</div>
		<div class="col-lg-9 row">
			<div class="form-group col-md-12">
				<label>Nome</label>
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="{{ (isset($dados->name)) ? $dados->name : '' }}">
			</div>
		
			<div class="form-group col-md-12">
				<label>E-mail</label>
				<input type="email" class="form-control {{ (isset($dados->id)) ? "disabled" : '' }}" name="email" id="email" placeholder="E-mail" value="{{ (isset($dados->email)) ? $dados->email : '' }}" >
			</div>

			<div class="form-group col-md-12">
				<label>Senha</label>
				<input type="text" class="form-control" name="senha" id="senha" placeholder="Senha">
			</div>
		</div>

	</div>

	<div class="form-group">
		<fieldset style="border: 1px solid #ffdebd;border-radius: 0.3rem;padding: 0.7rem;">
			<legend style="font-size: 1rem;margin: 0rem 0.5rem;padding: 0.3rem;width: auto;">Permissões</legend>

			<div class="row">
				<div class="col-md-12"><small>Posts</small></div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vis_post" name="vis_post" value="true" {{ (isset($postV)) ? ($postV == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="vis_post">Visualizar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="cad_post" name="cad_post" value="true" {{ (isset($postC)) ? ($postC == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="cad_post">Cadastrar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="edit_post" name="edit_post" value="true" {{ (isset($postE)) ? ($postE == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="edit_post">Editar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="del_post" name="del_post" value="true" {{ (isset($postR)) ? ($postR== true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="del_post">Remover</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12"><small>Animais</small></div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vis_animal" name="vis_animal" value="true" {{ (isset($animalV)) ? ($animalV == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="vis_animal">Visualizar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="cad_animal" name="cad_animal" value="true" {{ (isset($animalC)) ? ($animalC == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="cad_animal">Cadastrar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="edit_animal" name="edit_animal" value="true" {{ (isset($animalE)) ? ($animalE == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="edit_animal">Editar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="del_animal" name="del_animal" value="true" {{ (isset($animalR)) ? ($animalR == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="del_animal">Remover</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12"><small>Usuários</small></div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vis_user" name="vis_user" value="true" {{ (isset($userV)) ? ($userV == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="vis_user">Visualizar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="cad_user" name="cad_user" value="true" {{ (isset($userC)) ? ($userC == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="cad_user">Cadastrar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="edit_user" name="edit_user" value="true" {{ (isset($userE)) ? ($userE == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="edit_user">Editar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="del_user" name="del_user" value="true" {{ (isset($userR)) ? ($userR == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="del_user">Remover</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12"><small>Patrocinadores</small></div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="vis_patrocinador" name="vis_patrocinador" value="true" {{ (isset($patrocinadorV)) ? ($patrocinadorV == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="vis_patrocinador">Visualizar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="cad_patrocinador" name="cad_patrocinador" value="true" {{ (isset($patrocinadorC)) ? ($patrocinadorC == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="cad_patrocinador">Cadastrar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="edit_patrocinador" name="edit_patrocinador" value="true" {{ (isset($patrocinadorE)) ? ($patrocinadorE == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="edit_patrocinador">Editar</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="del_patrocinador" name="del_patrocinador" value="true" {{ (isset($patrocinadorR)) ? ($patrocinadorR == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="del_patrocinador">Remover</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12"><small>Configurações</small></div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="edit_configuracao" name="edit_configuracao" value="true" {{ (isset($configuracaoE)) ? ($configuracaoE == true) ? "checked" : "" : "" }}>
						<label class="form-check-label" for="edit_configuracao">Editar</label>
					</div>
				</div>
			</div>
	
		</fieldset>
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
			@if(!isset($dados->id))
			senha: {
				required: true
			},
			@endif
			estado: {
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
			senha: {
				required: "Senha obrigatório",
			},
			estado: {
				required: "Estado obrigatório",
			}
		}
	});

	$('.input-images-user').imageUploader({
		@isset($dados->id)
			@if($dados->avatar !== "" && $dados->avatar !== null)
			preloaded: [
				{id:{{ $dados->id }}, src:'{{ asset('storage/users_avatar/'.$dados->avatar) }}'},
			],
			@endif
		@endisset
		label:'Abrir imagem',
		maxFiles: 1
	});
</script>