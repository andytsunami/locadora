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
      			
		<!-- Datepicker -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		
		<link type="text/css" rel="stylesheet" href="css/estilos.css"  media="screen,projection"/>
		
		<title>Locadora Bomtempo</title>
		
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
				
				$("#table tbody").on('click', '.dependentes',function(){
					var cliente = $(this).parents("tr").attr("id");
					$.fancybox.open({
						href : 'listaDependente.php?cod_cliente=' + cliente,
						type: "iframe",
						padding : 0,
						fitToView	: false,
						width		: '80%',
						height		: '80%',
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none',
					}	
					);
				});
				
				
				//Preguiça de fazer dinamico....
				$("#table tbody").on('click', '.edit-clie',function(){
					var cliente = $(this).parents("tr").attr("id");
					$.fancybox.open({
						href : 'cadastro.php?fancy=1&cod_cliente=' + cliente,
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
							parent.location.reload(true);
						},
					}	
					);
				});
				
				$("#table tbody").on('click', '.add',function(){
					var cliente = $(this).parents("tr").attr("id");
					$.fancybox.open({
						href : 'dependente.php?fancy=1&cod_cliente=' + cliente,
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
							parent.location.reload(true);
						},
					}	
					);
				});
				
				$(".salvar").click(function(){
					var fancy = $("input[name='fancy']").val();
					$.ajax({
						type: "POST",
						url : $(this).attr("data-target"),
						data: $("#form").serialize(),
						success: function(){
							if(fancy){
								parent.$.fancybox.close();
							} else {
								window.location = "index.php";
							}
						}
					});
					
				});
				
				$("#table tbody").on('click', '.remove-clie',function(){
					var cli = $(this).parents("tr").attr("id");
					var linha = $(this).parents('tr');
					$.post("deleta.php", {cod: cli, cliente: 1}).done(function(data){
							$(linha).fadeOut("slow",function(){
								table.row(linha).remove().draw();
							});
					});
					
				});
				$( ".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
			});
			
		</script>
		
	</head>
	<body>
<?php 
			if(!$_REQUEST['fancy']){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        	<div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Muda navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.png" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Listagem de clientes</a>
                    </li>
                    <li>
                        <a href="cadastro.php">Cadastro de clientes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php }?>
	<div class="container corpo">
			    
