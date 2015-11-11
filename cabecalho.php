<html>
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
      	<!-- Datatable -->
	    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.js"></script>
	    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.css"  media="screen,projection"/>
	    
      	<!-- FancyBox -->
		<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/jquery.fancybox.pack.js"></script>
      	<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
		<script type="text/javascript" src="https://dl.dropboxusercontent.com/u/35720465/locadora/fancybox/helpers/jquery.fancybox-thumbs.js"></script>
      			
		
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
				
				
			
			});
			
		</script>
		
	</head>
	<body>
		<div class="container">
			    <div class="navbar">
			      <div class="navbar-inner">
			        <a class="brand" href="#">Locadora</a>
			        <ul class="nav">
			          <li class="active"><a href="index.php">Listagem de clientes</a></li>
			          <li><a href="cadastro.php">Cadastro de clientes</a></li>
			        </ul>
			      </div>
			    </div>
			    </div>
		<div id="wrap">
			<div class="container">
			    
