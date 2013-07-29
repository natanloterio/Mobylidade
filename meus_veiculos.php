<?php include_once('sessao.php');?>
<?php
require_once('connection.php');
require_once('veiculo.php');
header('Content-type: text/html');

?>
<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 

<?php require_once('includes-basicos.php');?>
<script type="application/x-javascript" src="js/meus_veiculos.js"></script>


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
	<div id="pagina" data-role="page" >
	<!--<div id="page_meus_veiculos" data-role="page" >-->
	
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->		
	  
	  
	  
       <!-- Inicio cabecalho da pagina -->
       <div data-role="header"> 
	       <a class="ui-icon-menu" id="btn_menu" href="#" data-role="button" data-icon="" data-theme="a">Menu</a>
	       <h1>Meus Ve&iacute;culos</h1>
	       <a  href="cadastroveiculo.php" data-role="button" data-icon="menu" data-theme="a">Ve&iacute;culo</a>
	       
		  <div data-demo-html="true">	
				

				<div data-role="popup" id="popup_veiculo" data-theme="a">
				 
					<div data-role="header" data-theme="a" class="ui-corner-top">
						<h1 id="titulo_popup_veiculo">_Veiculo</h1>
					</div>
					<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">						
						<a href="cadastra_rota.php" id="btn_adicionar_rota" data-role="button" data-inline="true" data-icon="menu" rel="external">Anunciar Rota</a>
						<a href="#" id="btn_exclui_veiculo" data-role="button" data-inline="true" >Excluir</a>
						<input type="hidden" id="id_veiculo_popup" value="0"/>
					</div>				 
				 
				   
			       </div><!--/demo-html -->	       
		  </div>

       </div>
       <!-- Fim cabecalho da pagina -->
	  
       <!-- Inicio conteudo da pagina -->  
       <div data-role="content"  class="content"> 		  
	 <div data-demo-html="true">
	  <ul id="lst-meus-carros" data-role="listview">

	  
	  <?php
	  
		  $result = getTodosVeiculos(getUsuarioLogadoID());
		  
		  if($result){
			
			while($linha = mysql_fetch_array($result)){
			      $id = $linha['ID'];
			      $modelo = $linha['MODELO'];
			      $placa = $linha['PLACA'];
			      echo "<li><a href=\"#\" value=\"$id\">$modelo | $placa</a></li>";
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