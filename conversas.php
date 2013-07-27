<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Caixa de mensagens</title> 
<?php
require_once('includes-basicos.php');
include_once ("connection.php");
include_once ("login_util.php");
?>

<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script src="js/conversa.js" type="text/javascript"></script>
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
		<h1>Caixa de Mensagens</h1>
	</div>
	<!-- Fim cabecalho da pagina -->
    
    
	<!-- Inicio conteudo da pagina -->  
        <div data-role="content" class="content"> 		   
			<ul data-role="listview" data-theme="d">
                        <?
                            $_POST['acao'] = 'getmessagesnotread';
                            $_POST['u'] = getUsuarioLogadoID();
                            ob_start();
                            
                            include'mensagens.php';
                            $xConteudo = ob_get_contents();
                            ob_end_clean();
                            
                            $xArrayConteudo = json_decode($xConteudo, true);
                            foreach ($xArrayConteudo['messages'] as $mensagem){
                                ?>
                                    <li>
                                        <a href="conversacom.php?u=<? echo $mensagem['sender']; ?>">
                                            <h3><? echo $mensagem['nome']; ?> </h3>
                                            <p style="color: #b6b7b7;">Enviou <span class="date" title="<?  echo $mensagem['data']; ?>"></span></p>
                                            <p ><? echo $mensagem['mensagem']; ?></p>
                                        
                                        </a>
                                    </li>
                                <? 
                            }
                            
                        ?>
	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
 
    </body>

</html>