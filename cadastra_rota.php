<?php require_once('sessao.php'); ?>
<?php

require_once('veiculo.php');
header('Content-type: text/html');

?>
<!DOCTYPE HTML>
<html lang="en-US">
    
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Anunciar Rota</title> 

<?php require_once('includes-basicos.php');?>
<style>
 #valor_rota{
  text-align: center;
 }
</style>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="lib/jquery/jquery.ui.autocomplete.min.js"></script>	
<script src="lib/jquery/jquery.ui.map.full.min.js"></script>
<script src="lib/jquery/jquery.ui.map.extensions.js"></script>        
<script src="lib/jquery/jquery.geocomplete.js"></script>
<script src="lib/jquery/jquery.price_format.1.8.min.js"></script>
<style>
 .destino_erro{
   visibility: hidden;
   color: red;
 }
 
 .origem_erro{
   visibility: hidden;
   color: red;
 }
</style>

<script src="js/cadastra_rota.js"></script>    

 <script>
  $(document).ready(function(){
   
  $('#valor_rota').priceFormat({
      prefix: 'R$ ',
      centsSeparator: ',',
      thousandsSeparator: '.'
  });
});
</script>
 <script>

 </script>
</head>    

 <body>
<!-- Inicio da pagina -->
<div id="page_pesquisa" data-role="page">
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel -->
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>
		<h1>Anunciar Rota</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">

		<a class="pesquisa_lugar_btn" id="origem_buton" href="#" data-role="button" data-theme="a"><div id="label_btn_origem">Origem</div></a>
                <div class="origem_erro"> Campo requerido</div>

		<a class="pesquisa_lugar_btn" id="destino_buton" href="#" data-role="button" data-theme="a"><div id="label_btn_destino">Destino</div></a>
		<div class="destino_erro"> Campo requerido</div>
		
		<div data-role="fieldcontain">
		  
		  
       
		 
		 <?php
		 
			 $result = getTodosVeiculos(getUsuarioLogadoID());
			 
			 if($result  && mysql_num_rows($result) > 0){
		
			      echo "<select name=\"select-tipo-veiculo\" id=\"select-tipo-veiculo\">";
			       
			       while($linha = mysql_fetch_array($result)){
				     $value = $linha['ID'];
				     $modelo = $linha['MODELO'];
				     echo "<option value=\"$value\">$modelo</option>";
			       }
			      echo "</select>";
			 }else{
			       echo "<a class=\"pesquisa_lugar_btn\"  href=\"cadastroveiculo.php\" data-role=\"button\" data-theme=\"a\" data-icon=\"menu\" rel=\"external\">Ve&iacute;culo</a>";
			 }
		 ?>	  
		 
		  
		 
		</div>
		
		<input id="valor_rota" placeholder="R$ 0,00"/>
		
		<a href="#" id="salva_rota" data-role="button" data-icon="check" data-theme="a">Salvar Rota</a>
	     

	</div>
	<!-- Fim conteudo da pagina -->
</div>
<!-- Fim da pagina-->

<!-- Popup de origem -->
 <div data-role="popup" id="popupOrigem">
  <div data-role="content" class="content">
   
   <div class="div_origem_criteria">
    <form>
      <input id="origem_criteria" type="text" placeholder="Type in an address" size="90" />
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
</body>

</html>