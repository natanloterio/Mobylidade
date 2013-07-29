<?php include_once('login_util.php');?>
<?php
require_once('connection.php');
require_once('rota.php');
header('Content-type: text/html');
error_reporting(0);

?>
<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 

<?php require_once('includes-basicos.php');?>
<script type="application/x-javascript" src="js/minhas_rotas.js"></script>


 <script>
  $(document).ready(function(){
	
	$('#btn_menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
  
  });
</script>
</head>    

    <body>
  <!-- Inicio da pagina -->
	<div id="page_minhas_rotas" data-role="page" >
	
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->		
	  
	  
	  
       <!-- Inicio cabecalho da pagina -->
       <div data-role="header"> 
	       <a class="ui-icon-menu" id="btn_menu" href="#" data-role="button" data-icon="" data-theme="a">Menu</a>
	       <h1>Minhas Rotas</h1>
	       <a  href="cadastra_rota.php" data-role="button" rel="external" data-icon="menu" data-theme="a">Rota</a>
	       
		  <div data-demo-html="true">	
				

				<div data-role="popup" id="popup_rota" data-theme="a">
				 
					<div data-role="header" data-theme="a" class="ui-corner-top">
						<h1 id="titulo_popup_rota">Rota</h1>
					</div>
					<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					        <a href="#" id="btn_ativar_rota" data-role="button" data-inline="true" >Ativar</a>
						<a href="#" id="btn_desativar_rota" data-role="button" data-inline="true" >Desativar</a>
						<a href="#" id="btn_exclui_rota" data-role="button" data-inline="true" >Excluir</a>
						
						<input type="hidden" id="id_rota_popup" value="0"/>
					</div>				 
				 
				   
			       </div><!--/demo-html -->	       
		  </div>

       </div>
       <!-- Fim cabecalho da pagina -->
	  
       <!-- Inicio conteudo da pagina -->  
       <div data-role="content"  class="content"> 		  
	 <div data-demo-html="true">
	  <ul id="lst_minhas_rotas" data-role="listview">

	  
	  <?php
	     
		  $result = getMinhasRotas(getUsuarioLogadoID());
		  
		  if($result){
			
			
			while($linha = mysql_fetch_array($result)){
			  
			      $id = $linha['ID'];
			      $status = $linha['STATUS'];
			      $origem = $linha['ORIGEM_CIDADE'];
			      $destino = $linha['DESTINO_CIDADE'];
			      $valor = $linha['VALOR'];
			      
			      if($status == 1){
			       $status = "| Rota atual";
			      }else{
			       $status = "";
			      }
			      
			      echo "<li><a href=\"#\" value=\"$id\">De $origem at&eacute;  $destino | R$ $valor $status </li>";
			}
			
		  }else{
			echo mysql_error();
		  }
	  ?>	  
	  
	  </ul>	
	 </div>	  
			
	</div>
       
	<!-- Fim conteudo da pagina -->  
	   
	   
	</div>
  <!-- Fim da pagina-->
 
  <!-- Popup de edicao -->
  

  <!-- Popup de edicao -->
  
    </body>

</html>