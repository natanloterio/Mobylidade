<?php require_once('sessao.php'); ?>
<!DOCTYPE HTML>
<html lang="en-US">
    
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Procurar guinchos</title> 

<?php //require_once('includes-basicos.php');?>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="lib/jquery/jquery.ui.autocomplete.min.js"></script>	
<script src="lib/jquery/jquery.ui.map.full.min.js"></script>
<script src="lib/jquery/jquery.ui.map.extensions.js"></script>        
<script src="lib/jquery/jquery.geocomplete.js"></script>


<script src="js/pesquisa.js"></script>    

 <script>
 
</script>
 <script>

 </script>
</head>    
<style>
 .box_enderecos{
  display: inline;
 }
 .endereco{
 max-width: 350px;
 display: inline-block;
 }
 </style>
 <body>
<!-- Inicio da pagina -->
<div id="page_pesquisa" data-role="page">
 
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>
		<h1>Procurar Ve&iacute;culos</h1>
		<a  href="cadastroveiculo.php" data-role="button" data-icon="menu" data-theme="a">Ve&iacute;culo</a>
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">
	 <div class="box_enderecos">
	  <div class="endereco">
	   <input id="origem_criteria" type="text" placeholder="Type in an address" size="90" />
	  </div>
	  
	  <!--<a class="pesquisa_lugar_btn" id="origem_buton" href="#" data-role="button" data-icon="menu" data-theme="a"><div id="label_btn_origem">Origem</div></a>-->
	  <div class="endereco">
	   <input id="destino_criteria" type="text" placeholder="Type in an address" size="90" />
	  </div>
	 </div>
	 
	 <div class="endereco">
	 <a href="#" id="pesquisa_pesquisar_btn" data-role="button" data-icon="search" data-theme="a">Procurar</a>
	 </div>
	 <br>
	 <div id="div_resultado_buca">
	  <div data-demo-html="true">
	   <ul id="lista_resultado_buca" data-role="listview">
	   
	    

	   </ul>		  
	  </div>
	 </div>	  	     

	</div>
	<!-- Fim conteudo da pagina -->
</div>
<!-- Fim da pagina-->

<!-- Popup de origem -->
 <div data-role="popup" id="popupOrigem">
  <div data-role="content" class="content">
   
   <div class="div_origem_criteria">
    <form>
      
    </form>
   </div>
   
  </div>
 </div>
 <!-- Fim Popup de origem -->
 
<!-- Popup de Destino -->
 <div data-role="popup" id="popupDestino">
  <div data-role="content" class="content">
   
   <div class="div_destino_criteria">
    <form>
      <input id="destino_criteria" type="text" placeholder="Type in an address" size="90" />
    </form>
   </div>
   
  </div>
 </div>
 <!-- Fim Popup de Destino -->
 
 
 <!-- Inicio da Página de informação sobre a rota -->
 <div id="page_rota" data-role="page">
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		
		<h1 id="rota_titulo">Procurar Ve&iacute;culos</h1>
		
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">
	 
	 
	 
	</div>
 </div>	
 <!-- Fim da Página de informação sobre a rota -->
</body>

</html>