<?php 
	require_once 'config.php';
	header('Content-Type: text/html; charset=utf-8');
	
	$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
	mysql_set_charset("utf8", $conexao);
	
	mysql_select_db($banco);
	
	$nome = htmlentities($_POST['nome'],ENT_QUOTES);
	$dataNascimento = date('Y-m-d',strtotime(str_replace('/','-',htmlentities($_POST['data_nascimento'],ENT_QUOTES))));
	$email = htmlentities($_POST['email'],ENT_QUOTES);
	
	$sql = "";
	$retorno = "";
	
	if(isset($_POST['cod'])){
		$cod = $_POST['cod'];
		$sql = "update cliente set nome = '{$nome}', data_nascimento = '{$dataNascimento}', email = '{$email}' where cod = {$cod}";
		$retorno = "Cadastro alterado com sucesso!";
		
	} else {
		$sql = "INSERT INTO cliente (nome, data_nascimento, email) VALUES ('".$nome."','".$dataNascimento."','".$email."');";
		$retorno = "Cliente {$nome} cadastrado com sucesso!";
		
	}
	
	$query = mysql_query($sql, $conexao);
	  
		echo http_response_code(200);
?>