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
          <div data-role="content" class="content"> 		   
			<ul data-role="listview" data-theme="d">
			  <?
		
			  $consulta=ExecSQL("SELECT * FROM chamados c, rota r WHERE c.ROTA_ID=r.ID AND r.USUARIO_ID='".$_COOKIE['USUARIO_ID']."'");
			  $total_chamados = mysql_numrows($consulta);
			  
			  if($total_chamados > 0){
			    while($dadosConsulta=mysql_fetch_array($consulta)){
			      $consultaRota=ExecSQL("SELECT * FROM rota WHERE ID='".$dadosConsulta['ROTA_ID']."'");
			      $dadosRota=mysql_fetch_array($consultaRota);
			      $cor="";
			      if($dadosConsulta['STATUS']==1) $cor="Color: #b8b800;"; elseif($dadosConsulta['STATUS']==2) $cor="Color: green;"; elseif($dadosConsulta['STATUS']==3) $cor="Color: red;";
			      ?>
				<li><a href="exibe_chamado.php?chamado_id=<?= $dadosConsulta['CHAMADOS_ID']; ?>"><h3>De <?= $dadosRota['ORIGEM_CIDADE']."-".$dadosRota['ORIGEM_UF']; ?> para <?= $dadosRota['DESTINO_CIDADE']."-".$dadosRota['DESTINO_UF']; ?></h3>
				<p style="<?= $cor; ?>"><?=  $statusChamadosEmpresa[$dadosConsulta['STATUS']]; ?></p></a>
				</li>
			      <?
			    }
			  }else{
			    ?>
			      <div class="no_record_found">
				Nenhum chamado encontrado
			      </div>
			    <?
			  }?>
			</ul>
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>