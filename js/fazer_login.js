function logar(usuario, senha){
 
	var dados = {"usuario":usuario,"senha":senha};

$.ajax({
	    url : 'login.php',
	    type : 'post',
	    dataType: 'json',
	    data : dados,
		success: function(x){
			window.location =  "inicio.php" ;
			//console.log('logou');
			
		},
		error : function(x) {
			window.location =  "fazer_login.php?login_error" ;
			//console.log('n�o logou');
		}
    });

/*	$.ajax({
	    url : 'usuario.php',
	    type : 'post',
	    dataType: 'html',
	    data : {acao : 'inclusao',
				nomecompleto: aNomeCompleto,
				email: aEmail,
				sexo: aSexo,
				login: aLogin,
				senha: aSenha
		},
		success: function(x){
			// if (x)
				alert(x);
			// else
				//alert('N�o foi poss�vel cadastrar este usu�rio.');
		},
		error : function(x) {
			alert('N�o foi poss�vel cadastrar este usu�rio.');
		}
    });*/
}

$(document).ready(function(){
	$('body').delegate('#login_botao', 'click', function(){
	  var usuario = $('#usuario').val();
	  var senha = $('#senha').val();
	  //logar(usuario,senha);
	
	});
	
});




