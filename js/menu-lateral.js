function setNotReadMessages() {
      var xU = $('#usLogged').val();
      $.ajax({
         url : 'mensagens.php',
         type : 'post',
         data : {
            acao : 'getmessagesnotread',
            u : xU,
         },
         dataType : 'json',
         success : function(r) {
            if (r.countnotread > 0 ) {
               $('.NumberNewMessages').html(r.countnotread);
            }else
               $('.NumberNewMessages').remove();
         },
      });
}


$('#pagina').on('pageinit', function(){

   $('.ui-icon-menu').on('click',function(){
      $( "#menu_panel" ).panel( "open" );
   });

   setNotReadMessages();
});