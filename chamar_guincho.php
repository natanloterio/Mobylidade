<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Requisicao enviada com sucesso!</title> 

<?php require_once('includes-basicos.php');?>


<?
include_once ("connection.php");
if(isset($_GET['rota_id']))
  ExecSQL("
	INSERT INTO chamados(ROTA_ID,USUARIOS_ID,DATA,STATUS) VALUES(".$_GET['rota_id'].",".$_COOKIE['USUARIO_ID'].",NOW(),0)
	");
?>
<script src="js/script da pagina.js"></script>
<script>
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
	
	
  
  });
</script>
<style>
  .conteudoMensagem{
    background-color: white;
    border-radius: 20px;
    padding: 20px;
    width: 80%;
  }
</style>
</head>    

  <body>
   
      <!-- Inicio da pagina -->
      <div id="pagina" data-role="page" >
	
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->		
	  

	<!-- Inicio cabecalho da pagina -->
	<div data-role="header"> 
		<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>	
		<h1>Requisicao enviada!</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
	      <center>
		<div class="conteudoMensagem">
		  Voce requisitou com sucesso o seu frete, por favor aguarde a confirmacao da empresa para efetuar o pagamento.<br><br>
		  <a href="meus_chamados.php" data-role="button" data-icon="forward" data-theme="a">Ir para meus pedidos</a>
		</div>
	      </center>
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>