<?php 
	$codClie;
	$cod;
	$nome;
	$dataNascimento;
	$email;
	
	$texto = "Cadastrar";
	
	if($_GET['cod'] > 0){
		$texto = "Editar";
	}
	
	$codClie = $_REQUEST['cod_cliente'];
?>
<?php include("cabecalho.php");?>



	<div class="row">
		<div class="col-leg-12">
			<h1 class="well text-center"><?=$texto?> dependente</h1>
		</div>
	</div>

	<form class="form-horizontal" id="form" method="post">
		<?php 
			if($_GET['cod'] > 0 ){
				require 'config.php';
				$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
				mysql_set_charset("utf8", $conexao);
				
				mysql_select_db($banco);
				$sql = "SELECT cod,cod_cliente,nome,data_nascimento,email FROM dependente WHERE cod = ".$_GET['cod'].";";
				$query = mysql_query($sql, $conexao);
				
				$registros = mysql_fetch_array($query); 
				header('Content-Type: text/html; charset=utf-8');
				
				$cod = $registros["cod"];
				$codClie = $registros["cod_cliente"];
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
		
		<input type="hidden" value="<?=$codClie?>" name="cod_cliente" />
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
      <button type="button" class="btn btn-lg btn-primary salvar" data-target="salvaDependente.php">
      	<span class="glyphicon glyphicon-floppy-disk glyphicon-align" aria-hidden="true"></span>
      	Salvar</button>
    </form>
<?php include( 'rodape.php'); ?>