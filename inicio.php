<?php require_once('sessao.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'pesquisa.php';
$header = "Location: http://$host$uri/$extra";
//echo "redirecionando para $header";
header($header);

?>

<!DOCTYPE HTML>
<html lang="en-US">
    
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Mobylidade</title> 

<?php require_once('includes-basicos.php');?>
 
 <script>
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
	
	
	
  
  });
</script>
 <style>
  
  .tipo_veiculo{
    width: 260px;
    height: 200px;
  }
  
  .metade{
   height: 50%;
   
  }
  
  .content{
   min-height: 400px;
   
  }
 </style>
</head>    

    <body>
      <!-- Inicio da pagina -->
      <div id="pagina" data-role="page" >
      <!--<div id="div_cadastrousuario" data-role="page" >-->
	
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->		

	<!-- Inicio cabecalho da pagina  de consulta-->
	<div data-role="header"> 
	 <a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">
	 Menu
	 </a>
	 <h1>Mobylidade</h1>

	</div>
	<!-- Fim cabecalho da pagina -->
	  
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 
      
	 <div class="center-wrapper_">
	   <div class="metade" id="request_btn"><a data-role="button" href="pesquisa.php" rel="external"><img class="tipo_veiculo" src="image/icone_carro.png"> Preciso de um guincho</a></div>
	   
	 </div>		   
	   
	</div>
        <!-- Fim conteudo da pagina -->  
	   
	   
	</div>
  <!-- Fim da pagina-->

    </body>

</html>