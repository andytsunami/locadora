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
	<body>
		<head>
			<meta charset="UTF-8" />
			<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,300italic,500' rel='stylesheet' type='text/css'>	
			<link type="text/css" rel="stylesheet" href="css/reset.css"  media="screen,projection"/>
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			
			
			<!-- Globo.com Bootstrap -->
	      	<script type="text/javascript" src="https://dl.dropboxusercontent.com/u/35720465/locadora/js/bootstrap.min.js"></script>
			<link type="text/css" rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/css/bootstrap.min.css"  media="screen,projection"/>
			<link type="text/css" rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/css/bootstrap-responsive.min.css"  media="screen,projection"/>
			
			
			
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
			});
			
		</script>
			
		</head>
			<div class="page-header">
				<h1>Listagem de dependentes</h1>
			</div>
			<table class="table table-bordered table-condensed" id="table">
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
								<?=$result["data_nascimento"]?>
							</td>
							<td>
								<?=$result["email"]?>
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
				</tfoot>
			</table>
	</body>
</html>