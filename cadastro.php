<?php 
	
	
	//header("Location: listagem.php")
?>
<?php include("cabecalho.php");?>
<div class="container">
	<form class="form-horizontal" method="post" id="form">
		<?php 
			if($_GET['ra'] > 0 ){
				require 'config.php';
				$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
				mysql_set_charset("utf8", $conexao);
				
				mysql_select_db($banco);
				$sql = "SELECT RA,NOME,CURSO,EMAIL FROM aluno WHERE RA = ".$_GET['ra'].";";
				$query = mysql_query($sql, $conexao);
				
				$registros = mysql_fetch_array($query); 
				header('Content-Type: text/html; charset=utf-8');
				
				$ra = $registros["RA"];
				$nome = $registros["NOME"];
				$curso = $registros["CURSO"];
				$email = $registros["EMAIL"];
				
		?>
		
		<input type="hidden" value="" name="cod" />
		
		<?php 
			}
		?>
		<div class="control-group">
			<label class="control-label" for="name">Nome</label>
			<div class="controls">
				<input type="text" class="input-xxlarge" maxlength="255" placeholder="Nome do cliente" name="nome" id="name"/>
			</div>
			
			
		</div>
      
    </form>
    </div>
<?php include( 'rodape.php'); ?>