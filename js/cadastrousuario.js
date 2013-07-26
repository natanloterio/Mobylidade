
$(document).ready(function(){
	$('body').delegate('#salvar_usuario_botao', 'click', function(){
		//Verifica›es de formulario
		var erro = false;
		var mensagemErro="";
		if ($("#nome").val()=="") {
			mensagemErro+="Preencha o nome corretamente\n";
			erro=true;
		}
		if ($("#email").val()=="") {
			mensagemErro+="Preencha o e-mail corretamente\n";
			erro=true;
		}
		if ($("#telefone").val()=="") {
			mensagemErro+="Preencha o telefone corretamente\n";
			erro=true;
		}
		var selected = $("input[type='radio'][name='tipopessoa']:checked");
		if (selected.length > 0)
		    xTipoPessoa = selected.val();
		if (xTipoPessoa == 'E') {
			if ($("#endereco").val()=="") {
				mensagemErro+="Preencha o endereco corretamente\n";
				erro=true;
			}
			if ($("#bairro").val()=="") {
				mensagemErro+="Preencha o bairro corretamente\n";
				erro=true;
			}
			if ($("#cidade").val()=="") {
				mensagemErro+="Preencha a cidade corretamente\n";
				erro=true;
			}
			if ($("#estado").val()=="") {
				mensagemErro+="Preencha o estado corretamente\n";
				erro=true;
			}
		}else{
			if ($("input[type='radio'][name='sexo']:checked").length==0) {
				mensagemErro+="Selecione o seu sexo\n";
				erro=true;
			}
		}
		if ($("#login").val()=="") {
			mensagemErro+="Preencha o login corretamente\n";
			erro=true;
		}
		if ($("#senha").val()=="") {
			mensagemErro+="Preencha a senha corretamente\n";
			erro=true;
		}
		if (erro) {
			alert(mensagemErro);
			return false;
		}
		var dados = $("#formCadastro").serialize();
		$.ajax({
			url: 'usuario.php',
			type: 'POST',
			data: dados,
			success: function(dados){
				$("#mensagemExibe").html(dados);
				window.location='pesquisa.php';
			},
			error: function(){
				alert('Ocorreu um erro!');
			}
			});
		//$.post("usuario.php", dados);
	});
	
	$(".tipopessoa").bind( "change", function(event, ui) {
		var selected = "";
		var selected = $("input[type='radio'][name='tipopessoa']:checked");
		if (selected.length > 0)
		    xTipoPessoa = selected.val();
		if (xTipoPessoa == 'E'){
			$(".sexo").hide();
			$(".endereco").show();
		}else{
			$(".sexo").show();
			$(".endereco").hide();
		}
	});
	
	
});




