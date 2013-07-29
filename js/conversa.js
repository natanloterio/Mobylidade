$(document).ready(function() {
    $("span.date").timeago();
    //$('input, textarea').placeholder();
    
    $.ajax({
        url: 'mensagens.php',
        type: 'post',
        data:{ acao: 'setread'}
    });    
});