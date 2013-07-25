
$( document ).delegate("#page_meus_veiculos", "pageinit", function() {
	
  $('#lst-meus-carros li a').on('click',function(){
    var id_veiculo = $(this).attr('value');
    if (id_veiculo) {
	$('#id_veiculo_popup').val(id_veiculo);
	$('#titulo_popup_veiculo').html($(this).html());
	// inicializa popup
	$('#popup_veiculo').popup();
	$('#popup_veiculo').popup('open');
    }
  });
	

  $('#btn_exclui_veiculo').on('click',function(){
	var id_veiculo_excluir = $('#id_veiculo_popup').val();
	$.ajax({
		    url : 'veiculo.php',
		    type : 'post',
		    dataType: 'json',
		    data : {acao : 'exclusao',
					id:id_veiculo_excluir
			},
			success: function(x){
				if (x.sucesso > 0) {
					//("inicio.php");
					window.location = 'meus_veiculos.php';
				}
				
			},
			error : function(x) {
				alert('Não foi possível cadastrar este usuário.');
			}
	});
		
  });
	
	
});


