<?php 
	$codClie;
	$cod;
	$nome;
	$dataNascimento;
	$email;
	
	$codClie = $_REQUEST['cod_cliente'];
	
	
	//header("Location: listagem.php")
?>
<?php include("cabecalho.php");?>

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
		?>
		<input type="hidden" value="<?=$codClie?>" name="cod_cliente" />
		<div class="control-group">
			<label class="control-label" for="name">Nome</label>
			<div class="controls">
				<input type="text" value="<?=$nome?>" class="input-xxlarge" maxlength="255" placeholder="Nome do cliente" name="nome" id="name"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nascimento">Data Nascimento</label>
			<div class="controls">
				<input type="datetime" value="<?=$dataNascimento?>" class="input-xxlarge" name="data_nascimento" id="nascimento"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="mail">E-mail</label>
			<div class="controls">
				<input type="email" value="<?=$email?>" class="input-xxlarge" maxlength="255" placeholder="Email do cliente" name="email" id="mail"/>
			</div>
		</div>
      <button type="button" class="btn salvar" data-target="salvaDependente.php">Salvar</button>
    </form>
<?php include( 'rodape.php'); ?>