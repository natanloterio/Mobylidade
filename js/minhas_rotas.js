
$( document ).delegate("#page_minhas_rotas", "pageinit", function() {

	
  $('#lst_minhas_rotas li a').on('click',function(){
    var id_veiculo = $(this).attr('value');
    if (id_veiculo) {
	$('#id_rota_popup').val(id_veiculo);
	$('#titulo_titulo_popup_rotapopup_veiculo').html($(this).html());
	// inicializa popup
	$('#popup_rota').popup();
	$('#popup_rota').popup('open');
    }
  });
	

  $('#btn_exclui_rota').on('click',function(){
	var id_rota_excluir = $('#id_rota_popup').val();
	$.ajax({
		    url : 'rota.php',
		    type : 'post',
		    dataType: 'json',
		    data : {acao : 'exclusao',
					id:id_rota_excluir
			},
			success: function(x){
				if (x.sucesso > 0) {
					//("inicio.php");
					window.location = 'minhas_rotas.php';
				}
				
			},
			error : function(x) {
				alert('Não foi possível cadastrar este usuário.');
			}
	});
		
  });

  $('#btn_ativar_rota').on('click',function(){
	var id_rota_ativar = $('#id_rota_popup').val();
	$.ajax({
		    url : 'rota.php',
		    type : 'post',
		    dataType: 'json',
		    data : {acao : 'definir_rota_ativa',
					id:id_rota_ativar
			},
			success: function(x){
				if (x.sucesso > 0) {
					//("inicio.php");
					window.location = 'minhas_rotas.php';
				}
				
			},
			error : function(x) {
				alert('Não foi possível cadastrar este usuário.');
			}
	});
		
  });
  

  $('#btn_desativar_rota').on('click',function(){
	var id_rota_ativar = $('#id_rota_popup').val();
	$.ajax({
		    url : 'rota.php',
		    type : 'post',
		    dataType: 'json',
		    data : {acao : 'definir_rota_ativa',
					id:id_rota_ativar
			},
			success: function(x){
				if (x.sucesso > 0) {
					//("inicio.php");
					window.location = 'minhas_rotas.php';
				}
				
			},
			error : function(x) {
				alert('Não foi possível cadastrar este usuário.');
			}
	});
		
  });  
	
});


