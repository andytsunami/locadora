<?php
require 'config.php';
$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
mysql_set_charset("utf8", $conexao);

mysql_select_db($banco);

$sql = "select c.cod, c.nome, c.data_nascimento, c.email, count(d.cod) as dependentes from cliente c
left join dependente d on d.cod_cliente = c.cod
group by c.cod, c.nome, c.data_nascimento, c.email;";


$query = mysql_query($sql, $conexao);

$registros = mysql_num_rows($query);
$result;
header('Content-Type: text/html; charset=utf-8');

?>

<?php
	include ("cabecalho.php");
?>
	<div class="row">
		<div class="col-leg-12">
			<h1 class="well text-center">Listagem de clientes</h1>
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
						Qtd. Dependentes
					</th>
					<th>
						Add Dependente
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
							<td class="dependentes">
								<?=$result["dependentes"]?>
							</td>
							<td class="add">
								<i class="glyphicon glyphicon-plus"></i>
							</td>
							<td class="adm edit-clie"><i class="glyphicon glyphicon-pencil"></i></td>
							<td class="adm remove-clie"><i class="glyphicon glyphicon-remove"></i></td>
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
						Qtd. Dependentes
					</th>
					<th>
						Add Dependente
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
		
<?php
	include ("rodape.php");
?>