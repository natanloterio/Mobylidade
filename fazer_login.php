<?php
/*
print('<pre>');
print_r($_POST);
print('</pre>');
*/
require_once('login.php');

function getPass(){

	if(isset($_GET['lsenha'])){
		echo $_GET['lsenha'];
	}else{
		echo "";			
	}

}

function getUsername(){

	if(isset($_GET['lusername'])){
		echo $_GET['lusername'];
	}else{
		echo "";			
	}

}
		
if(isset($_POST["usuario"]) && isset($_POST["senha"])){	

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	//echo "logar($usuario,$senha);";
	logar($usuario,$senha);
}else{
	fracasso(array("msg"=>"NENHUMA SENHA OU USUARIO FOI INFORMADO"));
}		

?>

<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Login</title> 

<?php require_once('includes-basicos.php');?> 
 
 <script src="js/fazer_login.js"></script>
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
	<div id="div_login" data-role="page" >
	
	<!-- Menu lateral esquerda-->
	<?php //include('menu-lateral.php'); ?>
	<!-- /panel -->			
	  
	  
	  
	  <!-- Inicio cabecalho da pagina -->
		<div data-role="header"> 
			<!--a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>-->
		
			<h1>Login</h1>
		
		</div>
		<!-- Fim cabecalho da pagina -->
	  
		   <!-- Inicio conteudo da pagina -->  
        <div data-role="content"  class="content">
		
		<form action="fazer_login.php" method="post" data-ajax="false">
				<label for="login">Usuario</label>
				<input type="text" id="usuario" name="usuario" value="<?php getUsername();?>">
				
				<label for="senha">Senha</label>
				<input type="password" id="senha"  name="senha" value="<?php getPass();?>">
				
				
						<input type="submit" data-role="button" data-icon="check" data-theme="a" value="Entrar"/>
						<a href="cadastrousuario.php" data-role="link" data-icon="alert" data-theme="a">Sou novo por aqui</a>
				
				<?php if(isset($_GET['login_error'])){ 
				echo "
				<label for=\"erro\">Erro login</label>	
				<input id=\"erro\"type=\"hidden\">";
				
				}?>
		</form>
	    </div>
	   <!-- Fim conteudo da pagina -->  
	   
	   
	</div>
  <!-- Fim da pagina-->
 
    </body>

</html>