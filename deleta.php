<?php 
	require_once 'config.php';
	header('Content-Type: text/html; charset=utf-8');
	
	$conexao = @mysql_connect($host, $usuario, $senha) or exit(mysql_error());
	mysql_set_charset("utf8", $conexao);
	
	mysql_select_db($banco);
	
	$cod = $_POST['cod'];
	$isCliente = $_POST['cliente'];
	$email = htmlentities($_POST['email'],ENT_QUOTES);
	
	$sql = "";
	
	
	if($isCliente){
		$sql = "DELETE FROM cliente WHERE cod = {$cod};";
		
	} else {
		
		$sql = "DELETE FROM dependente WHERE COD = {$cod}";
		
	}
	
	$query = mysql_query($sql, $conexao);
	  
	echo http_response_code(200);
?>