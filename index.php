<?php
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'inicio.php';
  header("Location: http://$host$uri/$extra");
  exit;

?>

<!DOCTYPE HTML>
<html lang="en-US">
    
    <?php header('Location : inicio.php');?>
    
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
</head>    

    <body>
  <!-- Inicio da pagina -->
	<div id="div_cadastrousuario" data-role="page" >
	<?php include('menu-lateral.php'); ?>
	  
	  
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