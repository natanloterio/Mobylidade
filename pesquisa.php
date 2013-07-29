<?php require_once('login_util.php');

function mostraBotaoDireitaHeader(){
 // se o carinha estiver logado
 $usuarioLogadoID = getUsuarioLogadoID();
 $usuarioLogadoNome = getUsuarioLogadoNomeCompleto();
  
 if($usuarioLogadoID > 0){
  ?>
  
  <a  href="perfil.php?pid=<?php echo $usuarioLogadoID;?>" class="ui-btn-right" data-role="button" data-icon="menu" data-theme="c"><?php echo $usuarioLogadoNome;?></a>
  
  <?php
 }else{
  ?>
  <a  href="fazer_login.php" class="ui-btn-right" data-role="button" data-icon="menu" data-theme="a">Login</a>
  <?php
 }
 
 
}

function mostraBotaoEsquerdaHeader(){
 // se o carinha estiver logado
 $usuarioLogadoID = getUsuarioLogadoID();
 $usuarioLogadoNome = getUsuarioLogadoNomeCompleto();
  
 if($usuarioLogadoID > 0){
  ?>
  
  <a class="ui-icon-menu" href="#" data-role="button" data-icon="home" data-theme="a">Menu</a>
  
  <?php
 }else{
  ?>
  
  <?php
 } 
 
}



?>
<!DOCTYPE HTML>
<html lang="en-US">
    
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Procurar guinchos</title> 

<?php require_once('includes-basicos.php');?>

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
 .info_busca{
  position: relative;
  
  height: 100px;
 }
 .box_enderecos{
  display: inline;
 }
 .endereco{
 position: relative;
 max-width: 350px;
 display: inline-block;
 
 }
 
 .ui-content{
  min-height: 400px;
  margin-left: 50px;
  margin-right: 50px;
 }
 
 #div_resultado_busca{
  padding: 15px;
  margin-top: 10px;
  margin-right: 40px;

 }
 
 .div_valor{
  float: right;
  display: inline-table;
 }

 </style>
 <body>
<!-- Inicio da pagina -->

<div id="pagina" data-role="page" >
	<!-- Menu lateral esquerda-->
	<?php include('menu-lateral.php'); ?>
	<!-- /panel --> 
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		<?php mostraBotaoEsquerdaHeader();?>
		<h1>Procurar Ve&iacute;culos</h1>
		<?php mostraBotaoDireitaHeader();?>
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">
	 
	 <div class="info_busca">
	   <h1>Encontre um guincho perto de voc&ecirc;</h1>
	 </div>
	 
	 <div class="box_enderecos">
	  <div class="endereco">
	   <input id="origem_criteria" type="text" placeholder="Origem" size="90" />
	  </div>
	  
	  <!--<a class="pesquisa_lugar_btn" id="origem_buton" href="#" data-role="button" data-icon="menu" data-theme="a"><div id="label_btn_origem">Origem</div></a>-->
	  <div class="endereco">
	   <input id="destino_criteria" type="text" placeholder="Destino" size="90" />
	  </div>
	 
	  <div class="endereco">
	   <a href="#" id="pesquisa_pesquisar_btn" data-role="button" data-icon="search" data-theme="a">Procurar</a>
	  </div>
	  
	 </div>
	 <br>
	 <div id="div_resultado_busca">
	  <div data-demo-html="true">
	   <ul id="lista_resultado_busca" data-role="listview">
	   
	    

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