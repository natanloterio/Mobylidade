function getuUsuario(aUsuario){
	$.ajax({
	    url : 'http://www.turbinandoandroid.com.br/mobylidade/usuario.php',
	    type : 'post',
	    data : {acao : 'consulta', id: aUsuario},
	    dataType: 'Json',
		success: function(x){
			if (x.x.ok)
				alert(x.x.n);
			else
				alert('N�o foi encontrado nem um usu�rio com este c�digo.');
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
