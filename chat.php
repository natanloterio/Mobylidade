<!DOCTYPE HTML>
<html lang="en-US">
    
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
 <title>Titulo da pagina</title> 
<style type="text/css">
       .message {
           padding: 5px 5px 5px 5px;
       }
       .username {
           font-weight: strong;
           color: #0f0;
       }
       .msgContainerDiv {
           overflow-y: scroll;
           height: 250px;
       }
       
       #incomingMessages{
	overflow: scroll;
       }
       
div.MyChatholders_direita {
position: relative;
right: 5px;
color: white;
width: 70%;
height: 100px;
border: 1px solid #fff;
padding-right: 75px;
top: 05px;
left: 20%;
}
div.MyChatholders_esquerda {
position: relative;
left: 5px;
color: white;
width: 70%;
height: 100px;
border: 1px solid #fff;
padding-right: 75px;
}

div.pro_pic_esquerda {
    position:absolute;
    top: 4px;
    left: 5px;
    width: 100px;
    height: 89px;
    border: solid #fff 1px;
}

div.pro_pic_direita {
    position:absolute;
    top: 4px;
    right: 5px;
    width: 100px;
    height: 89px;
    border: solid #fff 1px;
}

div.ChatText_direita {
    position:relative;
    color: black;
    font-size: 14px;
    left: 40px;
    width: 88%;
    border: 1px solid #fff;
}
 div.ChatText_esquerda {
position: relative;
color: black;
font-size: 14px;
left: 19%;
width: 88%;
border: 1px solid #fff;
}
}
 
.quadrado{
height: 58px;
position: absolute;
width: 54px;
top: 16px;
right: 33px;
background: white; 
 }
 
 .quadrado img{width: 100%;}
 
div.ChatText {
position: relative;
color: rgb(255, 255, 255);
font-size: 14px;
left: 33px;
padding-left: 10px;
right: 7px;
margin-right: -26px;
width: 100%;
top: 5px;
border: 0px ;

}       
</style>
<?php require_once('includes-basicos.php');?>

<script>
 
  $(document).ready(function(){
	
	$('.ui-icon-menu').on('click',function(){
			
			$( "#menu_panel" ).panel( "open" );
	
	});
	
	$('.quadrado').on('click',function(){
	  
	   $('#popupChangeProfilePic').popup();
	   $('#popupChangeProfilePic').popup('open');
	 
	 });

  
  });
</script>
</head>    

  <body>

	  

 <div data-role="page" id="chatPage" data-role="page" data-theme="a">
  <!-- Menu lateral esquerda-->
  <!-- /panel -->
  <!-- Inicio cabecalho da pagina -->
  <div data-role="header">
	  <a class="ui-icon-menu" href="#" data-role="button" data-icon="menu" data-theme="a">Menu</a>
	  <h1>Chat</h1>
	  
	   
           <div class="ui-block-a"><div class="quadrado">
	    <img src="image/plus_in_a_circle.png">
	   </div></div>
       
	   
  </div>
  <!-- Fim cabecalho da pagina -->
  <!-- Inicio conteudo da pagina -->
 
  <div data-role="content">
	 
   <div id="incomingMessages" name="incomingMessages" class="msgContainerDiv" >
      
      <div class='MyChatholders_direita'>
	  <div class='pro_pic_direita'>Pic</div>
	  <div class="ChatText_direita">ola</div>
      </div>
      <br />
      <div class='MyChatholders_esquerda'>
	  <div class='pro_pic_esquerda'>Pic</div>
	  <div class="ChatText_esquerda">ola</div>
      </div>
      <br />
      <div class='MyChatholders_direita'>
	  <div class='pro_pic_direita'>Pic</div>
	  <div class="ChatText_direita">ola</div>
      </div>
      <br />
   
   </div>
   
   
   <div id="div_messageText" >
    <label for="messageText"><strong>Message:</strong></label>
    <textarea name="messageText" id="messageText"></textarea>

       <fieldset class="ui-grid-a">
           <div class="ui-block-a"><a href="#loginPage" id="goBackButton" data-role="button">Go Back</a></div>
           <div class="ui-block-b"><button data-theme="a" id="chatSendButton" name="chatSendButton">Send</input>
       </fieldset>
       </div>
   

    </div>
 
 
  </div>
	   
	   
 </div>
      <!-- Fim da pagina-->
      
      
      <div data-role="popup" id="popupChangeProfilePic">
        natan
      </div>
 
</body>

</html>