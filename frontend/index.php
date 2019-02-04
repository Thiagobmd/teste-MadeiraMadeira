<!DOCTYPE html>
<html>
	<head>
		<title>Teste MadeiraMadeira - Crud Lista de Telefones - Thiago Barbosa M. Dias</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="assets/js/jquery.min.js"></script>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.mask.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">Teste MadeiraMadeira - Crud Lista de Telefones - Thiago Barbosa M. Dias</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Adicionar</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Sobrenome</th>
							<th>Telefone</th>
							<th>Data de Criação</th>
							<th>Editar</th>
							<th>Deletar</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Adicionar Contato</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Insira seu nome</label>
			        	<input type="text" name="first_name" id="first_name" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Insira o Sobrenome</label>
			        	<input type="text" name="last_name" id="last_name" class="form-control" />
			        </div>

					<div class="form-group">
			        	<label>Insira o Telefone</label>
			        	<input type="text" name="number" id="number" class="form-control number" />
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Inserir" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	// mascara de telefone
	$('.number').mask('(00) 0000-0000');
	
	// chamo a função responsavel por gerar a lista de telefones
	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Inserir');
		$('.modal-title').text('Adicionar Dados');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#first_name').val() == '')
		{
			alert("Insira o Nome");
		}
		else if($('#last_name').val() == '')
		{
			alert("Insira o sobrenome");
		}
		else if($('#number').val() == '')
		{
			alert("Insira o Telefone");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Dados inseridos com sucesso!");
					}
					if(data == 'update')
					{
						alert("Dados atualizados com sucesso!");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				// Quebro a variavel para pegar o DDD separado do numero e inserir a mascara
				let ddd = data.number.substring(0, 2);			
				
				ddd = "("+ ddd +")";

				// Pego a primeira parte do telefone
				let telefone_parte1 = data.number.substring(2, 6);

				// Pego a segunda parte do telefone
				let telefone_parte2 = data.number.substring(6, 10);

				// concateno inserindo o traço entre a primeira parte e a segunda parte do telefone. Ex: (41) 2233-4455
				let telefone = ddd + " " + telefone_parte1 + "-" + telefone_parte2;	

				$('#hidden_id').val(id);
				$('#first_name').val(data.first_name);
				$('#last_name').val(data.last_name);
				$('#number').val(telefone);
				$('#action').val('update');
				$('#button_action').val('Atualizar');
				$('.modal-title').text('Editar Dados');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Tem certeza que deseja remover este registro?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Registro deletado com sucesso!");
				}
			});
		}
	});

});
</script>