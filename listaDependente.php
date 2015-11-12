<?php
require 'config.php';
$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
mysql_set_charset("utf8", $conexao);

mysql_select_db($banco);

$codCliente = $_GET['cod_cliente'];

/*Inicio cliente*/
$sqlCliente = "select cod, nome, data_nascimento, email from cliente where cod = {$codCliente}";
$queryCliente = mysql_query($sqlCliente, $conexao);

$resultCliente = mysql_fetch_array($queryCliente);
/*Fim cliente*/

/*Inicio dependente*/
$sql = "select cod, nome, data_nascimento, email from dependente where cod_cliente = {$codCliente};";

$query = mysql_query($sql, $conexao);

$registros = mysql_num_rows($query);
$result;
/*Fim dependente*/

header('Content-Type: text/html; charset=utf-8');

?>
<html>
		<head>
			<meta charset="UTF-8" />
			<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,300italic,500' rel='stylesheet' type='text/css'>	
			<link type="text/css" rel="stylesheet" href="css/reset.css"  media="screen,projection"/>
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			
			
			<!-- Bootstrap -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
			
			
			
			
	      	<!-- Datatable -->
		    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.js"></script>
		    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.css"  media="screen,projection"/>
		    
	      	<!-- FancyBox -->
			<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
			<script type="text/javascript" src="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/jquery.fancybox.pack.js"></script>
	      	<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
			<script type="text/javascript" src="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
	      			
			
			<link type="text/css" rel="stylesheet" href="css/estilos.css"  media="screen,projection"/>
			
			<script type="text/javascript">
			$(document).ready(function() {
				var table = $("#table").DataTable({
					"order": [[ 0, "desc" ]],
					language: {
							    "sEmptyTable": "Nenhum registro encontrado",
							    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
							    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
							    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
							    "sInfoPostFix": "",
							    "sInfoThousands": ".",
							    "sLengthMenu": "Exibir  _MENU_ registros por página",
							    "sLoadingRecords": "Carregando...",
							    "sProcessing": "Processando...",
							    "sZeroRecords": "Nenhum registro encontrado",
							    "sSearch": "Pesquisar",
							    "oPaginate": {
							        "sNext": "Próximo",
							        "sPrevious": "Anterior",
							        "sFirst": "Primeiro",
							        "sLast": "Último"
							    },
							    "oAria": {
							        "sSortAscending": ": Ordenar colunas de forma ascendente",
							        "sSortDescending": ": Ordenar colunas de forma descendente"
							    }
					    }
				});
				
				$("#table tbody").on('click', '.remove-dep',function(){
					var dep = $(this).parents("tr").attr("id");
					var linha = $(this).parents('tr');
					$.post("deleta.php", {cod: dep, dependente: 1}).done(function(data){
							$(linha).fadeOut("slow",function(){
								table.row(linha).remove().draw();
							});
					});
					
				});
				
				$("#table tbody").on('click', '.edit-dep',function(){
					var dependente = $(this).parents("tr").attr("id");
					$.fancybox.open({
						href : 'dependente.php?fancy=1&cod=' + dependente,
						type: "iframe",
						padding : 0,
						fitToView	: false,
						width		: '80%',
						height		: '80%',
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none',
						afterClose : function(){
							location.reload(true);
						},
					}	
					);
				});
			});
			
		</script>
			
		</head>
		<body>
		<div class="container corpo">
			<div class="row">
				<div class="col-leg-12">
					<h1 class="well text-center">Listagem de dependentes do cliente <?=$resultCliente["nome"]?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-condensed table-hover" id="table">
						<thead>
							<th>
								Cod
							</th>
							<th>
								Nome
							</th>
							<th>
								Data Nascimento
							</th>
							<th>
								Email
							</th>
							<th>
								Editar
							</th>
							<th>
								Excluir
							</th>
						</thead>
						<tbody>
							<?php if ($registros){
								while ($result = mysql_fetch_array($query)) {
							?>	
								<tr id='<?=$result["cod"]?>'>
									<td>
										<?=$result["cod"]?>
									</td>
									<td>
										<?=$result["nome"]?>
									</td>
									<td>
										<?=date('d/m/Y',strtotime($result["data_nascimento"]))?>
									</td>
									<td>
										<?=$result["email"]?>
									</td>
									<td class="adm edit-dep"><i class="glyphicon glyphicon-pencil"></i></td>
									<td class="adm remove-dep"><i class="glyphicon glyphicon-remove"></i></td>
								</tr>
							<?php }}?>
						</tbody>
						<tfoot>
							<th>
								Cod
							</th>
							<th>
								Nome
							</th>
							<th>
								Data Nascimento
							</th>
							<th>
								Email
							</th>
							<th>
								Editar
							</th>
							<th>
								Excluir
							</th>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>