<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 

<?php require_once('includes-basicos.php');?>

<script src="js/script da pagina.js"></script>
<script>
 
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
	
	
  
  });
</script>
</head>    

  <body>
   
      <!-- Inicio da pagina -->
      <div id="page_nomedapagina" data-role="page" >
	
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->		
	  

	<!-- Inicio cabecalho da pagina -->
	<div data-role="header"> 
		<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>	
		<h1>Nome da pagina</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
			
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>