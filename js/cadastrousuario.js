function cadastrarUsuario(aTipoPessoa, aNomeCompleto, aEmail, aSexo, aLogin, aSenha){
	// coloca valores de login no form que irá chamar o login
	$('#lusername').val(aLogin);
	$('#lsenha').val(aSenha);
	
	
	
	var dados = {    
		'acao' : 'inclusao',
		"nome_usuario": aNomeCompleto  ,
		"email": aEmail ,
		"sexo": aSexo ,    
		"login": aLogin ,    
		"senha": aSenha,
		"tipopessoa": aTipoPessoa
        };
    

$.post("usuario.php", dados);


}
$(document).ready(function(){
	$('body').delegate('#_salvar_usuario_botao', 'click', function(){
		var xNome = '';
		var xEmail = '';
		var xSexo = '';
		var xLogin = '';
		var xSenha = '';
		var xTipoPessoa
		
		var selected = "";
		var selected = $("input[type='radio'][name='sexo']:checked");
		if (selected.length > 0)
		    xSexo = selected.val()
		else
		    xSexo = 'N';
		
		selected = "";
		selected = $("input[type='radio'][name='tipopessoa']:checked");
		if (selected.length > 0)
		   xTipoPessoa = selected.val()
		else
		   xTipoPessoa = 'P';

		
		if ( $('#name').val() )   
			xNome = $('#name').val();
		if ( $('#email').val() )
			xEmail = $('#email').val();
		//if ( $('#sexo').val() )
		//	 = $('#chk_homem').val();
		if ( $('#login').val() )
			xLogin = $('#login').val();
		if ( $('#senha').val() )
			xSenha = $('#senha').val();

		cadastrarUsuario(xTipoPessoa, xNome, xEmail, xSexo, xLogin, xSenha);
	});
	
	$(".tipopessoa").bind( "change", function(event, ui) {
		var selected = "";
		var selected = $("input[type='radio'][name='tipopessoa']:checked");
		if (selected.length > 0)
		    xTipoPessoa = selected.val();
		if (xTipoPessoa == 'E')
			$(".sexo").hide()
		else
			$(".sexo").show();
	});
	
	
});




