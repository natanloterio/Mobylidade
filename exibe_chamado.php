<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Exibir chamado</title> 

<?php require_once('includes-basicos.php');
include_once ("connection.php");
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
  .areaInformacao{
    background-color: white;
    border-radius: 20px;
    width: 80%;
    padding: 20px;
  }
</style>
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
		<h1>Exibir chamado</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
	  <center> <div class="areaInformacao">
	    <?
	    $consultaInfos=ExecSQL("SELECT * FROM chamados WHERE CHAMADOS_ID='".$_GET['chamado_id']."'");
	    $dadosInfos=mysql_fetch_array($consultaInfos);
	    if($dadosInfos['STATUS']==0){
	      echo "Aten&ccedil;&atilde;o: Para dar continuidade ao seu pedido de guincho, voc&ecirc; precisa aguardar a confirma&ccedil;&atilde;o da empresa que representa o guincho!";
	      ?>
	      <br><br><a data-rel="back" data-icon="back" data-role="button" data-theme="d">Voltar</a>
	      <?
	    }elseif($dadosInfos['STATUS']==1){
	      echo "Estamos aguardando o seu pagamento para disponibilizar os dados para voc&ecirc;!<br><br>
	      <a data-icon='info' data-role='button' data-theme='d'>Clique aqui para efetuar o pagamento</a>
	      ";
	    }elseif($dadosInfos['STATUS']==2){
	      echo "AQUI DADOS DO MOTORISTA";
	    }elseif($dadosInfos['STATUS']==3){
	      echo "Por algum motivo o seu pagamento foi rejeitado.<br><br>
	      <a data-icon='info' data-role='button' data-theme='d'>Clique aqui para efetuar o pagamento</a>
	      ";
	    }elseif($dadosInfos['STATUS']==4){
	      echo "A empresa rejeitou o seu chamado.<br><br><a data-rel=\"back\" data-icon=\"back\" data-role=\"button\" data-theme=\"d\">Voltar</a>
	      ";
	    }
	    ?>
	    
	  </div></center> 
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>