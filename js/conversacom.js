function getHtmlNewMessage(aNome, aData, aMensagem) {
    var cssLI = $('.LIMensagens').attr('class');
    var cssP = $('.PMensagens').attr('class');
    var cssH1 = $('.H1Mensagens').attr('class');
    
    return  '<li class="LIMensagens ui-li ui-li-static ui-btn-up-d ui-first-child ui-last-child"> '+
            '   <p class="PMensagens ui-li-desc"> '+aNome+' enviou <span class="date" title="'+aData+'"></span> '+
            '   <p class="ui-li-desc"></p>'+            
            
            '   <h1 class="H1Mensagens ui-li-heading pendente">'+aMensagem+'<h1> '+
            '   <h1 class="ui-li-heading"></h1>'+
            '</li> ';
}

function sendmessage() {
    var xReceiver = $('#receiver').val();
    var xMessage = $('#texto_a_enviar').val();
    var now = new Date();
    var dateMessage =  now.getFullYear() +'-'+ (now.getMonth() + 1 )+'-'+now.getDate()+' '+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();

    var xHtmlNewMessage = getHtmlNewMessage('Cassio', dateMessage, xMessage);
    $('#texto_a_enviar').val('');
    $('#ULMenesagens').append(xHtmlNewMessage);
    $("span.date").timeago();

    
    $.ajax({
            url : 'mensagens.php',
            type : 'post',
            data : {
                    acao : 'enviarmensagem',
                    receiver : xReceiver,
                    mensagem: xMessage 
            },
            dataType : 'html',
            error: function(e){
                $('.pendente').css('color', '#F00');
            }
    });
}

$(document).ready(function(){
    texto_a_enviar
    	$(document).delegate('#sendmessage', 'click', function (e) {
		sendmessage();
	});
    $("span.date").timeago();
    $('input, textarea').placeholder();
});