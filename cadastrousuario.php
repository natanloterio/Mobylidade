<!DOCTYPE HTML>
<html lang="en-US">
   
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Cadastro Usu&aacute;rio</title> 

<?php require_once('includes-basicos.php');?>

<script src="js/cadastrousuario.js"></script>
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
<div id="div_cadastrousuario" data-role="page">
	<?php //include('menu-lateral.php'); ?>
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		<!--<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>-->
		<h1>Novo Usu&aacute;rio</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">
	 
		<form action="usuario.php" method="post" data-ajax="false">
			<div data-role="fieldcontain">
				<fieldset data-role="controlgroup" data-mini="true">
					<input type="radio" class="tipopessoa" name="tipopessoa" id="chk_empresa"  value="E"/>
					<label for="chk_empresa">Empresa</label>
					<input type="radio" class="tipopessoa" name="tipopessoa" id="chk_pessoa" value="P"/>
					<label for="chk_pessoa">Pessoa</label>
				</fieldset>
			</div>

			<label for="name">Nome</label>
			<input type="text" id="name" name="name">
			<label for="email">Email</label>
			<input type="email" id="email" name="email">
			<div data-role="fieldcontain" class="sexo">
				<fieldset data-role="controlgroup" data-mini="true">
					<input type="radio" name="sexo" id="chk_homem" value="H"/>
					<label for="chk_homem">Homem</label>
					<input type="radio" name="sexo" id="chk_mulher" value="M"/>
					<label for="chk_mulher">Mulher</label>
				</fieldset>
			</div>
			<label for="login">Login</label>
			<input type="text" id="login" name="login">
			<label for="senha">Senha</label>
			<input type="password" id="senha" name="senha">
			<input type="hidden" name="acao" value="inclusao"/>
			<input type="submit" id="salvar_usuario_botao" data-role="button" data-icon="check" value="Pronto"/>
		</form>
	</div>
	<!-- Fim conteudo da pagina -->
</div>

<!-- Fim da pagina-->
<div class="invisivel">
	<form id="frmlogin" action="fazer_login.php" method="post">
		<input type="hidden" name="lsenha" id="lsenha" value=""/>
		<input type="hidden" name="lusername" id="lusername" value=""/>
	</form>
</div>
</body>

</html>