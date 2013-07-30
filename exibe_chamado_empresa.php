<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Exibir chamado</title> 

<?php require_once('includes-basicos.php');
require_once('login_util.php');
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(getUsuarioTipo()!='E') die("<script>window.location='fazer_login.php';</script>");
$consultaInfos=ExecSQL("SELECT c.ROTA_ID, c.STATUS, c.CHAMADOS_ID, c.USUARIOS_ID FROM chamados c, rota r WHERE c.ROTA_ID=r.ID AND c.CHAMADOS_ID='".$_GET['chamado_id']."' AND c.ROTA_ID=r.ID AND r.USUARIO_ID='".$_COOKIE['USUARIO_ID']."'");
if(mysql_num_rows($consultaInfos)>0){
  if($_GET['acao']=="ativar"){
    ExecSQL("UPDATE chamados SET STATUS=1 WHERE CHAMADOS_ID='".$_GET['chamado_id']."'");
    die("<script>window.location='exibe_chamado_empresa.php?chamado_id=$_GET[chamado_id]';</script>");
  }elseif($_GET['acao']=="cancelar"){
    ExecSQL("UPDATE chamados SET STATUS=4 WHERE CHAMADOS_ID='".$_GET['chamado_id']."'");
    if(!isset($_GET['voltarC']))
      die("<script>window.location='exibe_chamado_empresa.php?chamado_id=$_GET[chamado_id]';</script>");
    else
      die("<script>window.location='exibe_chamados_empresa.php';</script>");
  }
}
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
<script type="application/x-javascript">
  function cancelarChamado() {
    window.location='exibe_chamado_empresa.php?';
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
		<h1>Exibir chamado</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
	  <center> <div class="areaInformacao">
	    <?
	    
	    //echo mysql_num_rows($consultaInfos);
	    $dadosInfos=mysql_fetch_array($consultaInfos);
	    if($dadosInfos['STATUS']==0){
	    // echo "Aten&ccedil;&atilde;o: Para dar continuidade ao seu pedido de guincho, voc&ecirc; precisa aguardar a confirma&ccedil;&atilde;o da empresa que representa o guincho!";
	      ?>
	      <br><br><a data-rel="back" data-icon="back" data-role="button" data-theme="d">Voltar</a>
	      <?
	    }elseif($dadosInfos['STATUS']==1){
	      echo "Por favor aguarde o pagamento do cliente!<br><br>
	      <a href=\"exibe_chamados_empresa.php\" data-icon=\"back\" data-role=\"button\" data-theme=\"d\">Voltar</a>
	      ";
	    }elseif($dadosInfos['STATUS']==2){
	      $consultaPessoa=ExecSQL("SELECT * FROM usuarios WHERE USUARIO_ID='".$dadosInfos['USUARIOS_ID']."'");
	      $dadosPessoa=mysql_fetch_array($consultaPessoa);
	      echo "<div style='text-align: left;'>Nome: ".$dadosPessoa['nome_usuario']."<br>";
	      echo "E-mail: ".$dadosPessoa['email']."<br>";
	      echo "Telefone: ".$dadosPessoa['telefone']."</div><br><br>
	      <a href=\"exibe_chamados_empresa.php\" data-icon=\"back\" data-role=\"button\" data-theme=\"d\">Voltar</a>";
	    }elseif($dadosInfos['STATUS']==3){
	      echo "O pagamento do cliente foi rejeitado, voc&ecirc; pode aguardar por um novo pagamento, ou cancelar esse chamado para ele voltar na listagem.<br><br>
	      <a data-icon='info' data-role='button' href='exibe_chamado_empresa.php?acao=cancelar&chamado_id=".$_GET['chamado_id']."' data-theme='d'>Clicando aqui</a>
	      ";
	    }elseif($dadosInfos['STATUS']==4){
	      echo "Esse chamado est&aacute; cancelado, para ativa-lo novamente.<br><br>
	      <a data-icon='info' data-role='button' data-theme='d' href='exibe_chamado_empresa.php?acao=ativar&chamado_id=".$_GET['chamado_id']."' onclick='ativarChamado();'>Clique aqui</a>
	      ";
	    }
	    //echo "AQUI".$dadosInfos[STATUS];
	    ?>
	    
	  </div></center> 
	</div>
	
	<!-- Fim conteudo da pagina -->  
	
      <!-- Fim da pagina-->
 
    </body>

</html>