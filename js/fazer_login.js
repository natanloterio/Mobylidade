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
			//console.log('não logou');
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
				//alert('Não foi possível cadastrar este usuário.');
		},
		error : function(x) {
			alert('Não foi possível cadastrar este usuário.');
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




