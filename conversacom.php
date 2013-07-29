
<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Caixa de mensagens</title> 

<?php
require_once('includes-basicos.php');
include_once ("connection.php");
include_once ("login_util.php");

function getPessoaID(){
  if(isset($_GET['u'])){
	  return intval($_GET['u']);
  }else{
	  return -1;
  }
}


$profileID = getPessoaID(); 

?>

<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script src="js/Placeholders.js"></script>
<script src="js/conversacom.js"></script>
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
			<ul id="ULMenesagens" data-role="listview" data-theme="d">
                        <?
                            $_POST['acao'] = 'getmessages';
                            $_POST['u'] = $_GET['u'];
                            ob_start();
                            ;
                            
                            include'mensagens.php';
                            $xConteudo = ob_get_contents();
                            ob_end_clean();
                            //print_r($xConteudo);
                            $xArrayConteudo = json_decode($xConteudo, true);
                            foreach ($xArrayConteudo as $mensagem){
                            //echo $mensagem['mensagem'];
                            
                        ?>
                            <li class="LIMensagens">
                                <p class="PMensagens"><? echo $mensagem['nome']; ?> enviou <span class="date" title="<?  echo $mensagem['data']; ?>"></span> <p>
                                <h1 class="H1Mensagens"><? echo $mensagem['mensagem']; ?><h1>
                            </li>
                        <?
                            }
                        ?>
			</ul>
                            <div style="margin-top: 30px;">
                                <input type="text" style="height: 50px;" placeholder="Escreva sua mensagem..." name="mensagem" id="texto_a_enviar">	   
                                </input>
				<input type="hidden" id="receiver" value="<?php echo $profileID; ?>">
                                <input id="sendmessage" type="submit" value="Enviar"/>
                            </div>
                                

	</div>
	<!-- Fim conteudo da pagina -->  
	   
	   
      </div>
      <!-- Fim da pagina-->
    <script>
        $('input, textarea').placeholder();
    </script>
    </body>

</html>