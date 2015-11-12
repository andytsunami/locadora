<?php 
	$cod;
	$nome;
	$dataNascimento;
	$email;
	
	$texto = "Cadastrar";
	
	if($_GET['cod_cliente'] > 0){
		$texto = "Editar";
	}
?>
<?php include("cabecalho.php");?>

	<div class="row">
		<div class="col-leg-12">
			<h1 class="well text-center"><?=$texto?> cliente</h1>
		</div>
	</div>

	<form id="form" method="post" class="form-horizontal">
		<?php 
			if($_GET['cod_cliente'] > 0 ){
				require 'config.php';
				$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
				mysql_set_charset("utf8", $conexao);
				
				mysql_select_db($banco);
				$sql = "SELECT cod,nome,data_nascimento,email FROM cliente WHERE cod = ".$_GET['cod_cliente'].";";
				$query = mysql_query($sql, $conexao);
				
				$registros = mysql_fetch_array($query); 
				header('Content-Type: text/html; charset=utf-8');
				
				$cod = $registros["cod"];
				$nome = $registros["nome"];
				$dataNascimento = $registros["data_nascimento"];
				$email = $registros["email"];
				
		?>
		
			<input type="hidden" value="<?=$cod?>" name="cod" />
		
		<?php 
			}
			if($_GET['fancy']){
		?>
			<input type="hidden" value="1" name="fancy" />
		<?php 
			}
		?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="name">Nome</label>
			<div class="col-sm-10">
				<input type="text" value="<?=$nome?>" class="form-control input-lg" maxlength="255" placeholder="Nome do cliente" name="nome" id="name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="nascimento">Data Nascimento</label>
			<div class="col-sm-10">
				<input type="datetime" value="<?=$dataNascimento?>" class="form-control input-lg" name="data_nascimento" id="nascimento"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="mail">E-mail</label>
			<div class="col-sm-10">
				<input type="email" value="<?=$email?>" class="form-control input-lg" maxlength="255" placeholder="Email do cliente" name="email" id="mail"/>
			</div>
		</div>
      <button type="button" class="btn btn-lg btn-primary salvar" data-target="salvaCliente.php">
      	<span class="glyphicon glyphicon-floppy-disk glyphicon-align" aria-hidden="true"></span>
      	Salvar</button>
    </form>
<?php include( 'rodape.php'); ?>