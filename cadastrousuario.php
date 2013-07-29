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
      <div id="pagina" data-role="page" >
<!--<div id="div_cadastrousuario" data-role="page">-->
	<?php //include('menu-lateral.php'); ?>
	<!-- Inicio cabecalho da pagina -->
	<div data-role="header">
		<!--<a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>-->
		<h1>Novo Usu&aacute;rio</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
	<!-- Inicio conteudo da pagina -->
	<div data-role="content" class="content">
	 
		<form action="usuario.php" method="post" data-ajax="false" id="formCadastro">
		 <input type="hidden" name="acao" value="inclusao">
			<div data-role="fieldcontain">
				<fieldset data-role="controlgroup" data-mini="true">
					<input type="radio" class="tipopessoa" name="tipopessoa" checked id="chk_pessoa" value="P"/>
					<label for="chk_pessoa">Pessoa</label>
					<input type="radio" class="tipopessoa" name="tipopessoa" id="chk_empresa"  value="E"/>
					<label for="chk_empresa">Empresa</label>
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
			<label for="telefone">Telefone</label>
			<input type="text" id="telefone" name="telefone">
			<div class="endereco" style="display:none;">
				<label for="endereco">Endere&ccedil;o</label>
				<input type="text" id="endereco" name="endereco">
				 <label for="bairro">Bairro</label>
				<input type="text" id="bairro" name="bairro">
				 <label for="cidade">Cidade</label>
				<input type="text" id="cidade" name="cidade">
				 <label for="estado">Estado</label>
				<input type="text" id="estado" size="2" maxlength="2" name="estado">
			</div>
			<label for="login">Login</label>
			<input type="text" id="login" name="login">
			<label for="senha">Senha</label>
			<input type="password" id="senha" name="senha">
			<input type="hidden" name="acao" value="inclusao"/>
			<input type="button" id="salvar_usuario_botao" data-role="button" data-icon="check" value="Pronto"/>
		</form>
	</div>
	<div id="mensagemExibe" style="display:none;">
	 
	</div>
	<!-- Fim conteudo da pagina -->
</div>
</body>

</html>