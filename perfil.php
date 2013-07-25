<?php require_once('sessao.php'); ?>
<?php
include_once ("connection.php");

$nomePessoa = getPessoaNome();


function getPessoaID(){
  if(isset($_GET['pid'])){
	  return intval($_GET['pid']);
  }else{
	  return -1;
  }
 
}

function getPessoaNome(){
 $pessoaID = getPessoaID();
 if(getPessoaID() > 0){
  
  $sql = "select nome_usuario from USUARIOS where usuario_id = $pessoaID";
  $result = ExecSQL($sql);
  if($result){
   
   $linha = mysql_fetch_array($result);
   return $linha['nome_usuario'];
   
  }else{
   return '';
  }
  
 }
 
 
}

?>

<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 

<?php require_once('includes-basicos.php');?>
<style>
 .imagem_perfil{
  width: 100px;
  height: 100px;
  margin-bottom: 45px;
  border: 1px solid;
  background-size: 100%;
  background-image: url('image/profile.png');
 }
 
 .profile_name{
	 font-size: 38px;
	 left: 0px;
	 top: 0px;
	 padding-top: 0px;
 }
</style>
<script src="js/perfil.js"></script>

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
		<h1><?php echo $nomePessoa; ?></h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content"> 		   
	 <div class="imagem_perfil">
	  
	 </div>
	 <form action="enviar_msg.php" method="post">
	  <label for="texto_a_enviar">Mensagem	</label>
	  <textarea id="texto_a_enviar" rows="3" cols="30">
	   
	  </textarea>
	  <input type="submit" value="Enviar"/>
	  
	 </form> 
			
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>