function getuUsuario(aUsuario){
	$.ajax({
	    url : 'http://www.turbinandoandroid.com.br/mobylidade/usuario.php',
	    type : 'post',
	    data : {acao : 'consulta', id: aUsuario},
	    dataType: 'Json',
		success: function(x){
			if (x)
				alert(x);
			else
				alert('Não foi encontrado nem um usuário com este código.');
		},
		error : function(x) {
			alert('Deu pau.');
		}
    });
}

$(document).ready(function(){
	getuUsuario(1);
	//alert('chamou');
});
