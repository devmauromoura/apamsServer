@extends('Layouts.app')
@section('title', 'Postagens')
@section('conteudo')

<div id="conteudo">

	<div class="title">
		<h1>
			<i class="fas fa-th-list"></i>Postagens
		</h1>
		<h5 class="subtitle">Cadastro de posts</h5>
	</div>

	<div class="modal fade" id="modalformpost" tabindex="-1" role="dialog" aria-labelledby="cadastrarPost" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Formulário de postagens</h5>
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
					<h2>Posts</h2>
				</div>
				<div>
					<button type="button" class="btn-default modalcadpost" data-href="{{ url('/postagens/form') }}" data-bodyform="bodyformpost" data-modalname="modalformpost"><i class="fas fa-plus"></i>Novo</button>
				</div>
			</div>

			<table class="display responsive nowrap table text-center" id="listPost">
				<thead>
					<tr>
						<th scope="col">#ID</th>
						<th scope="col">Titulo</th>
						<th scope="col">Descrição</th>
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
			"ajax": "{{ url('/postagens/dados') }}",
			"columns": [
				{ "data": "id" },
				{ "data": "title" },
				{ "data": "description" },
				{ "data": "items",
					render: function ( data, type, row ) {
						return `
								<button type="button" class="btn-detail modalinfopost" data-href="{{ url('/postagens/info') }}/${row.id}" data-bodyform="bodyformpost" data-modalname="modalformpost" title="Comentários"><i class="fas fa-th-list"></i></button>
								<button type="button" class="btn-detail modaleditpost" data-href="{{ url('/postagens/form') }}/${row.id}" data-bodyform="bodyformpost" data-modalname="modalformpost" title="Editar"><i class="fas fa-pencil-alt"></i></button>
								<button type="button" class="btn-detail modalremovepost" data-href="{{ url('/postagens/remover') }}/${row.id}" title="Remover"><i class="fas fa-trash-alt"></i></button>
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
			"responsive": true
		});

		$('#listPost_filter label input').attr('placeholder','Pesquisar');
	});

	$(document).on('click','.modalcadpost', function(e){

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

	$(document).on('click','.modaleditpost', function(e){

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

	$(document).on('click','.modalremovepost', function(e){

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

	$(document).on('click','.modalinfopost', function(e){

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

</script>
@endsection