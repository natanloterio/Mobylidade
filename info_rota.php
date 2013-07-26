<?php //require_once('sessao.php'); ?>
<?php
include_once ("connection.php");
error_reporting(E_ALL);

function getRotaID(){
  if(isset($_GET['rota_id'])){
	  return intval($_GET['rota_id']);
  }else{
	  return -1;
  }
 
}

 $rotaID = getRotaID();
 $usuario_id = 0;
 $usuario_nome = '';
 $origem = '';
 $destino = '';
 
 if($rotaID > 0){
 
  $sql = "SELECT
  U.USUARIO_ID,
  U.nome_usuario,
  R.ORIGEM_LAT,
  R.ORIGEM_LNG,
  R.DESTINO_LAT,
  R.valor,
  R.DESTINO_LNG,  
  concat(R.ORIGEM_CIDADE ,'/',R.ORIGEM_UF) as ORIGEM, 
  concat(R.DESTINO_CIDADE ,'/',R.DESTINO_UF) as DESTINO from rota R, usuarios U
  where R.USUARIO_ID = U.USUARIO_ID
  AND R.excluido = 0
  AND R.ID = $rotaID";
 
  $result = ExecSQL($sql);
  if($result){
   
   $linha = mysql_fetch_array($result);
   
   $usuario_id = $linha['USUARIO_ID'];
   $usuario_nome = $linha['nome_usuario'];
   $origemLat = $linha['ORIGEM_LAT'];
   $origemLng = $linha['ORIGEM_LNG'];
   $destinoLat = $linha['DESTINO_LAT'];
   $destinoLng = $linha['DESTINO_LNG'];   
   $origem = $linha['ORIGEM'];
   $destino = $linha['DESTINO'];
   $valor=$linha['valor'];
   
  }else{
   echo "erro:".mysql_error();
   //TODO redireciona para pagina de erro
  }
  
 }else{
   echo "fora iff";
 }
 
 

?>

<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 

<?php require_once('includes-basicos.php');?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>


var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var chicago = new google.maps.LatLng(<?php echo $origemLat; ?>,<?php echo $origemLng; ?>);
  var mapOptions = {
    zoom:7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: chicago
  }
  map = new google.maps.Map(document.getElementById('mapa_rota'), mapOptions);
  directionsDisplay.setMap(map);
  
  calcRoute();
}

function calcRoute() {
  var start =  new google.maps.LatLng(<?php echo $origemLat; ?>,<?php echo $origemLng; ?>);
  var end =  new google.maps.LatLng(<?php echo $destinoLat; ?>,<?php echo $destinoLng; ?>);
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
} 

 
 google.maps.event.addDomListener(window, "load", initialize);
 
</script>
<style>

 .info_rota{
  display: inline-block;
  margin-bottom: 10px;
  width: 100%;
 }
 
 #mapa_rota{
  display: block;
  min-height: 400px;
  min-width:  350px;
 }
 .chamarRota{
    border-radius: 20px;
    background-color: white;
    height: 70px;
    
    position: relative;
 }
 .botaoChamar{
    position: absolute;
    top: 16px;
    right: 20px;
 }
 .fontePreco{
    color: green;
    font-size: 20px;
    font-family: verdana;
    line-height: 70px;
    margin: 25px;
 }
</style>


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
	<?php //include('menu-lateral.php'); ?>
	<!-- /panel -->		
	  

	<!-- Inicio cabecalho da pagina -->
	<div data-role="header"> 
		<a class="ui-icon-menu" data-rel="back" data-role="button" data-icon="back" data-theme="a">Voltar</a>	
		<h1>Info Rota</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
	 
	 <div class="info_rota">
	  <h3>De <?php echo $origem; ?> até <?php echo $destino; ?></h3>
	  <div class="chamarRota">
	    <font class="fontePreco">R$ <?= $valor; ?></font> <a  class="ui-btn-right botaoChamar"  href="chamar_guincho.php?rota_id=<?php echo $rotaID?>" data-role="button" data-icon="check" data-theme="a">Chamar</a>
	  </div>
	 </div>
	 
	 <div id="mapa_rota">
	  
	 </div>
	
	
			
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>