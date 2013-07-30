<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Chamados recebidos</title> 

<?php require_once('includes-basicos.php');
require_once('login_util.php');
if(getUsuarioTipo()!='E') die("<script>window.location='fazer_login.php';</script>");

$consulta=ExecSQL("SELECT * FROM chamados c, rota r WHERE c.ROTA_ID=r.ID AND r.USUARIO_ID='".$_COOKIE['USUARIO_ID']."'");
if($_GET['acao']=="aceitar"){
  //echo "caiuAceitar";
  if(mysql_num_rows($consulta)>0){
    //echo "caiuMais0";
    ExecSQL("UPDATE chamados SET STATUS=1 WHERE CHAMADOS_ID=".$_GET['id']);
    echo "<script>window.location='exibe_chamados_empresa.php';</script>";
  }
}
?>

<script src="js/script da pagina.js"></script>
<script language="Javascript">
 
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
	
	
  
  });
  var idChamado=0;
  function abrirPop(id) {
    idChamado=id;
    $('#popupChamado').popup();
    $('#popupChamado').popup('open');
  }
  
</script>
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
		<h1>Chamados recebidos</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
          <div data-role="content" class="content"> 		   
			<ul data-role="listview" data-theme="d">
			  <?
		
			  $consulta=ExecSQL("SELECT c.ROTA_ID,c.STATUS,c.CHAMADOS_ID FROM chamados c, rota r WHERE c.ROTA_ID=r.ID AND r.USUARIO_ID='".$_COOKIE['USUARIO_ID']."'");
			  $total_chamados = mysql_numrows($consulta);
			  
			  if($total_chamados > 0){
			    while($dadosConsulta=mysql_fetch_array($consulta)){
			      $consultaRota=ExecSQL("SELECT * FROM rota WHERE ID='".$dadosConsulta['ROTA_ID']."'");
			      $dadosRota=mysql_fetch_array($consultaRota);
			      $cor="";
			      if($dadosConsulta['STATUS']==1) $cor="Color: #b8b800;"; elseif($dadosConsulta['STATUS']==2) $cor="Color: green;"; elseif($dadosConsulta['STATUS']==3) $cor="Color: red;"; elseif($dadosConsulta['STATUS']==4) $cor="Color: orange;";
			      ?>
				<li><a <? if($dadosConsulta['STATUS']!=0) { ?> href="exibe_chamado_empresa.php?chamado_id=<?= $dadosConsulta['CHAMADOS_ID']; ?>" <? }else{ echo "onclick='abrirPop($dadosConsulta[CHAMADOS_ID]);'"; } ?>><h3>De <?= $dadosRota['ORIGEM_CIDADE']."-".$dadosRota['ORIGEM_UF']; ?> para <?= $dadosRota['DESTINO_CIDADE']."-".$dadosRota['DESTINO_UF']; ?></h3>
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
	    <div data-role="popup" id="popupChamado" data-theme="a">
				 
					<div data-role="header" data-theme="a" class="ui-corner-top">
						<h1>Chamado</h1>
					</div>
					<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
					  <h3>Voc&ecirc; deseja aceitar esse chamado?</h3>
					      <center><a id="aceitarChamado" data-role="button" data-inline="true" style="background: #bbeed5;" >Sim</a>
						<a data-rel="back" data-role="button" data-inline="true" >Cancelar</a>
						<a data-role="button" data-inline="false" id="rejeitarChamado" style="background: #ffcd7c;" >Rejeitar chamado</a></center>
					      
					</div>				 
				 
				   
			       </div>  
	   
      </div>
	   <script>
	    $("#aceitarChamado").click(function(){
	      window.location='exibe_chamados_empresa.php?acao=aceitar&id='+idChamado;
	    });
	    $("#rejeitarChamado").click(function(){
	      if (confirm('Você tem certeza que deseja cancelar esse chamado?')) {
		window.location='exibe_chamado_empresa.php?acao=cancelar&voltarC=true&chamado_id='+idChamado;
	      }
	    });
	   </script>
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>