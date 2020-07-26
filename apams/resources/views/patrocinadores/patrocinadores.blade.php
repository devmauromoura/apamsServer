@php
	$cadastrar = (in_array("patrocinadorC", $permissoes)) ? true : false;
	$editar = (in_array("patrocinadorE", $permissoes)) ? true : false;
	$remover = (in_array("patrocinadorR", $permissoes)) ? true : false;
@endphp
@extends('Layouts.app')
@section('title', 'Postagens')
@section('conteudo')

<div id="conteudo">

	<div class="title">
		<h1>
			<i class="fas fa-building"></i>Patrocinadores
		</h1>
		<h5 class="subtitle">Cadastro de patrocinadores</h5>
	</div>

	<div class="modal fade" id="modalformpost" tabindex="-1" role="dialog" aria-labelledby="cadastrarPost" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Formulário de cadastro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="bodyformpost">

				</div>
			</div>
		</div>
	</div>

	<div class="article">

		<div class="table-responsive">

			<div class="title-list">
				<div>
					<h2>Patrocinadores</h2>
				</div>
				@if($cadastrar == true)
				<div>
					<button type="button" class="btn-default modalcadpatr" data-href="{{ url('/patrocinadores/form') }}" data-bodyform="bodyformpost" data-modalname="modalformpost"><i class="fas fa-plus"></i>Novo</button>
				</div>
				@endif
			</div>

			<table class="display table text-center" id="listPost">
				<thead>
					<tr>
						<th scope="col">#ID</th>
						<th scope="col">Nome</th>
						<th scope="col">E-mail</th>
						<th scope="col">Contato</th>
						<th scope="col"></th>
					</tr>
				</thead>
			</table>
			
		</div>

	</div>

</div>

<script>

	$(document).ready(function() {
		$('#listPost').DataTable( {
			"ajax": "{{ url('/patrocinadores/dados') }}",
			"columns": [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "email" },
				{ "data": "cellphone" },
				{ "data": "items",
					render: function ( data, type, row ) {
						return `
								@if($editar == true)
								<button type="button" class="btn-detail modaleditpatr" data-href="{{ url('/patrocinadores/form') }}/${row.id}" data-bodyform="bodyformpost" data-modalname="modalformpost" title="Editar"><i class="fas fa-pencil-alt"></i></button>
								@endif
								@if($remover == true)
								<button type="button" class="btn-detail modalremovepatr" data-href="{{ url('/patrocinadores/remover') }}/${row.id}" title="Remover"><i class="fas fa-trash-alt"></i></button>
								@endif
							`;
					} 	
				}
			],
			"ordering": false,
			"info":     false,
			"language": {
				"decimal": "",
				"emptyTable": "Nenhuma informação encontrada.",
				"info": " ",
				"infoEmpty": " ",
				"infoFiltered": " ",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Número de posts por página _MENU_",
				"loadingRecords": "Carregando...",
				"processing": "Processando...",
				"search": "",
				"zeroRecords": "Nenhuma informação encontrada.",
				"paginate": {
					"first": "Primeira",
					"last": "Última",
					"next": "Próxima",
					"previous": "Anterior"
				}
			},
		} );
		$('#listPost_filter label input').attr('placeholder','Pesquisar');
	});

	$(document).on('click','.modalcadpatr', function(e){

		e.preventDefault();

		var href = $(this).data('href');
		var bodyFormName = '#'+$(this).data("bodyform");
		var modalName = '#'+$(this).data("modalname");

		$(modalName).modal('show'); 

		$.ajax({ 
			url: href, 
			type: 'get', 
			success: function(response){ 
				$(bodyFormName).html(response); 
			},
			error: function (ajaxContext) {
				$(modalName).modal('hide'); 
				$.notify({
					message: 'Erro ao concluir a ação.' 
				},{
					type: 'danger'
				});
			}
		}); 

		return false; 
	});

	$(document).on('click','.modaleditpatr', function(e){

		e.preventDefault();

		var href = $(this).data('href');
		var bodyFormName = '#'+$(this).data("bodyform");
		var modalName = '#'+$(this).data("modalname");

		$(modalName).modal('show'); 

		$.ajax({ 
			url: href, 
			type: 'get', 
			success: function(response){ 
				$(bodyFormName).html(response); 
			},
			error: function (ajaxContext) {
				$(modalName).modal('hide'); 
				$.notify({
					message: 'Erro ao concluir a ação.' 
				},{
					type: 'danger'
				});
			}
		}); 

		return false; 
	});

	$(document).on('click','.modalremovepatr', function(e){

		e.preventDefault();

		var href = $(this).data('href');

		Swal.fire({
			title: 'Deseja remover este post?',
			text: "O processo não pode ser recuperado!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#f93',
			cancelButtonColor: '#37474f',
			confirmButtonText: 'Sim',
			cancelButtonText: 'Não',
		}).then((result) => {
			if(result.isConfirmed == true){
				window.location.href = href;
			}
		})

		return false; 
	});

</script>
@endsection