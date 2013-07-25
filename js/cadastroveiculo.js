function cadastrarVeiculo(aTipoVeiculoID, aMarca, aPlaca, aModelo, aCor){
	$.ajax({
	    url : 'veiculo.php',
	    type : 'post',
	    dataType: 'json',
	    data : {acao : 'inclusao',
				tipo_veiculo_id:aTipoVeiculoID,
				marca: aMarca,
				placa: aPlaca,
				modelo: aModelo,
				cor: aCor,
		},
		success: function(x){
			if (x.sucess > 0) {
				//("inicio.php");
				window.location = 'meus_veiculos.php';
			}
			
		},
		error : function(x) {
			//alert('Não foi possível cadastrar este usuário.');
			i = 0;
		}
    });
}

$( document ).delegate("#page1", "pageinit", function() {

		console.log("Ready to bring the awesome.");
		var sugList = $("#suggestions");
		
				
		$( "#marca" ).on( "listviewbeforefilter", function ( e, data ) {
			$("#marca li").show();
			var _elementMarca = $( "#marca" );
						var $ul = $( this ),
							$input = $( data.input ),
							value = $input.val(),
							html = "";
						$ul.html( "" );
						if ( value && value.length > 2 ) {
							$ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
							$ul.listview( "refresh" );
							$.ajax({
								url: "veiculo.php",
								type : "POST",
								dataType: "json",
								crossDomain: true,
								data: { acao : 'getmarca',
									consulta: $input.val()
								}
							})
							.then( function ( response ) {
								$.each( response, function ( i, val ) {
									html += "<li value=\""+ val.id+"\" style=\"cursor:pointer\" >" + val.nome + "</li>";
								});
								$ul.html( html );
								$ul.listview( "refresh" );
								$ul.trigger( "updatelayout");
								// adiciona listener
								$("#marca li").on('click',function(){
									valor = $(this).attr("value");
									
									_elementMarca.attr("value", valor);
									$('form input').val($("#marca li").html());
									$("#marca li").hide();
								
								});
							});
						}
					});		
		
		



	$('body').delegate('.add', 'click', function(){
		var xTipoVeiculoID = $("#select-tipo-veiculo option:selected").val();
		var xMarca = $("#select-marca option:selected").val();
		var xPlaca = '';
		var xModelo = '';
		var xCor = '';
		if ( xMarca )   {
			//xMarca = ;
		}
		else{
			alert('Informe a marca!');
			$('#marca').focus();
			return;
		}
	
		if ( $('#placa').val() )
			xPlaca = $('#placa').val();
		else{
			alert('Informe a placa!');
			$('#placa').focus();
			return;
		}
		
		if ( $('#modelo').val() )
			xModelo = $('#modelo').val();
		else{
			alert('Informe ao modelo!');
			$('#modelo').focus();
			return;
		}
		
		if ( $('#cor').val() )
			xCor = $('#cor').val();

		 cadastrarVeiculo(xTipoVeiculoID, xMarca, xPlaca, xModelo, xCor);
	});
	
	
	

	
});


