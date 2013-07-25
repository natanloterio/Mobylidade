<?php require_once('sessao.php'); ?>
<?php
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en-US"> <head>
  <meta charset="utf-8"> <meta name="viewport" content="initial-scale=1.0,
  user-scalable=no"> <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <title>Novo Ve&iacute;culo</title>

<?php require_once('includes-basicos.php');?>
  
  <link rel="stylesheet" href="css/cadastroveiculo.css"/>
  
  <script src="js/cadastroveiculo.js"></script>
  
  <script>
  
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
      });  
  </script>
  
</head> <body>


<!-- Home --> <div data-role="page" id="page1">
      
<!-- Menu lateral esquerda-->
<?php include('menu-lateral.php'); ?>
<!-- /panel-->

<!-- Inicio cabecalho da pagina --> <div data-role="header">
      <a class="ui-icon-menu" href="#" data-role="button" data-icon="menu"
      data-theme="a">Menu</a> <h1>Novo Ve&iacute;culo</h1>
</div> <!-- Fim cabecalho da pagina -->
      
    <div data-role="content">
	<h4 id="fulano" class="fulano">
	    
	</h4>
		
	    <div data-role="fieldcontain">
	      
	      <select name="select-tipo-veiculo" id="select-tipo-veiculo">
	        
		<?php
		  $sql = "select DESCRICAO,ID from TIPO_VEICULO";
		  $result = ExecSQL($sql);
		  if($result){
			
			while($linha = mysql_fetch_array($result)){
			      $value = $linha['ID'];
			      $descricao = $linha['DESCRICAO'];
			      echo "<option value=\"$value\">$descricao</option>";
			}
			
		  }else{
			echo mysql_error();
		  }
		?>
		
	      </select>
	    </div>
		
		
	    <div data-role="fieldcontain">
	      
	      <select name="select-marca" id="select-marca">
	        
		<?php
		  $sql = "select NOME,ID from MARCA";
		  $result = ExecSQL($sql);
		  if($result){
			
			while($linha = mysql_fetch_array($result)){
			      $value = $linha['ID'];
			      $descricao = $linha['NOME'];
			      echo "<option value=\"$value\">$descricao</option>";
			}
			
		  }else{
			echo mysql_error();
		  }
		?>
		
	      </select>
	    </div>
			
	    
	    <label for="placa">
		Placa
	    </label> <input name="" id="placa" placeholder="Informe a placa do
	    ve&iacute;culo" value="" type="text">
			

	    <label for="modelo">
		Modelo
	    </label> <input name="" id="modelo" placeholder="Informe o modelo do
	    ve&iacute;culo" value="" type="text" data-mini="true">

	    <label for="cor">
		Cor
	    </label> <input name="" id="cor" placeholder="Informe o modelo do
	    ve&iacute;culo" value="" type="color" data-mini="true">

	<input id="add" type="submit" data-inline="true" data-icon="check"
	data-iconpos="left" value="Cadastrar" data-mini="true" class="add">
		
		
		
		
    </div>
	
			<div data-role="popup" id="popupBasic"
			data-transition="flip">
			
				<div id="destinatario">
			    </div>
				
				<div id="mensagem">
					<input id="textoaenviar" type="text"
					placeholder="type and press enter"/>
				</div>
				
	    </div>
</div>

<div data-role="popup" id="dados_obrigatorios">
	<p>I am positioned to the window.</p>
</div>

</body> </html>
