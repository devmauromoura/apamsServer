@extends('Layouts.app')
@section('title', 'Postagens')
@section('conteudo')

<div id="conteudo">

	<div class="title">
		<h1>
			<i class="fas fa-paw"></i>Animais
		</h1>
		<h5 class="subtitle">Cadastro de animais</h5>
	</div>

	<div class="modal fade" id="modalformpost" tabindex="-1" role="dialog" aria-labelledby="cadastrarPost" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Formulário de animais</h5>
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
					<h2>Animais</h2>
				</div>
				<div>
					<button type="button" class="btn-default modalcadanimal" data-href="{{ url('/animais/form') }}" data-bodyform="bodyformpost" data-modalname="modalformpost"><i class="fas fa-plus"></i>Novo</button>
				</div>
			</div>

			<table class="display table text-center" id="listPost">
				<thead>
					<tr>
						<th scope="col">#ID</th>
						<th scope="col">Nome</th>
						<th scope="col">Porte</th>
						<th scope="col">Idade</th>
						<th scope="col">Sexo</th>
						<th scope="col">Peso</th>
						<th scope="col">Tipo</th>
						<th scope="col">Status</th>
						<th scope="col">História</th>
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
			"ajax": "{{ url('/animais/dados') }}",
			"columns": [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "size" },
				{ "data": "age" }, 
				{ "data": "sex" }, 
				{ "data": "weight" }, 
				{ "data": "type"},
				{ "data": "adopted",
					render: function ( data, type, row ) {
						switch (row.adopted) {
							case "0":
								return `Não adotado`;
								break;
							case "1":
								return `Em adoção`;
								break;
							case "2":
								return `Adotado`;
								break;
						
							default:
								return `Indefinido`;
								break;
						}
						
					} 
				},
				{ "data": "history" },
				{ "data": "items",
					render: function ( data, type, row ) {
						return `
								<button type="button" class="btn-detail modaleditanimal" data-href="{{ url('/animais/form') }}/${row.id}" data-bodyform="bodyformpost" data-modalname="modalformpost" title="Editar"><i class="fas fa-pencil-alt"></i></button>
								<button type="button" class="btn-detail modalremoveanimal" data-href="{{ url('/animais/remover') }}/${row.id}" title="Remover"><i class="fas fa-trash-alt"></i></button>
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

	$(document).on('click','.modalcadanimal', function(e){

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

	$(document).on('click','.modaleditanimal', function(e){

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

	$(document).on('click','.modalremoveanimal', function(e){

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