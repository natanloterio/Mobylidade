   pacContainerInitialized = false;
   
   var origem = null;
   var destino = null;
      
   function cadastraRota(origemLat,origemLng, destinoLat, destinoLng,origem_cidade,origem_uf,destino_cidade,destino_uf,meu_veiculo,valor_rota) {
      var auxValor = valor_rota.substr(3).replace('.','').replace(',','.');
   	var dados = {
   	    "acao": "inclusao",
   	    "ORIGEM_LAT": origemLat,
   	    "ORIGEM_LNG": origemLng,
   	    "DESTINO_LAT": destinoLat,
   	    "DESTINO_LNG": destinoLng,
   	    "ORIGEM_CIDADE": origem_cidade,
   	    "ORIGEM_UF": origem_uf,
   	    "DESTINO_CIDADE": destino_cidade,
   	    "DESTINO_UF": destino_uf,
   	    "VEICULO_ID": meu_veiculo,
            "VALOR_ROTA": auxValor
   	}
                     
                 

   $.ajax({
	    url : 'rota.php',
	    type : 'post',
	    dataType: 'json',
	    data : dados,
		success: function(x){
			
			window.location = 'minhas_rotas.php';
			
		},
		error : function(x) {
			alert('Não foi possível cadastrar esta rota.');
		}
    });
   
   
   }
   
    $(document).ready(function(){

     // ORIGEM
       $('#origem_criteria').keypress(function() {
               if (!pacContainerInitialized) {
                       $('.pac-container').css('z-index', '9999');
                       $('.pac-container').css('padding', '4px');
                       pacContainerInitialized = true;
               }
       });

       $("#origem_criteria").geocomplete()
          .bind("geocode:result", function(event, result){
            $("#label_btn_origem").html(result.formatted_address);
            
            origem = result;
            
            $("#popupOrigem").popup("close");
          })
          .bind("geocode:error", function(event, status){
            alert("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            alert("Multiple: " + results.length + " results found");
          });


       $('#origem_buton').on('click',function(){

         $("#popupOrigem").popup({ history: false,
                 afteropen: function( event, ui ) {
                         $('#origem_criteria').focus();
                 }
         });

         $("#popupOrigem").popup("open");


       });


        // DESTINO
       $('#destino_criteria').keypress(function() {
               if (!pacContainerInitialized) {
                       $('.pac-container').css('z-index', '9999');
                       pacContainerInitialized = true;
               }
       });

       $("#destino_criteria").geocomplete()
          .bind("geocode:result", function(event, result){
            $("#label_btn_destino").html(result.formatted_address);
            
            destino = result;
            
            $("#popupDestino").popup("close");
          })
          .bind("geocode:error", function(event, status){
            alert("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            alert("Multiple: " + results.length + " results found");
          });


       $('#destino_buton').on('click',function(){

         $("#popupDestino").popup({ history: false,
                 afteropen: function( event, ui ) {
                         $('#destino_criteria').focus();
                 }
         });

         $("#popupDestino").popup("open");


       });
       
       $('#salva_rota').on('click',function(){
         
         if (!origem){
            $(".origem_erro").css("visibility","visible");

         }

         
         if (!destino){
            $(".destino_erro").css("visibility","visible");
         }
         
         // se origem e destino foram definidos
         if (origem && destino) {
            
            var positionOrigem  = origem.geometry.location;
            var positionDestino = destino.geometry.location;
            
            var origem_cidade = origem.address_components[0].short_name;
            var origem_uf     = origem.address_components[1].short_name;
            
            var destino_cidade = destino.address_components[0].short_name;
            var destino_uf     = destino.address_components[1].short_name;
            
            var meu_veiculo = $("#select-tipo-veiculo option:selected").val();
            
            var valor_rota = $('#valor_rota').val();
            
            cadastraRota(positionOrigem.lat(),positionOrigem.lng(),positionDestino.lat(),positionDestino.lng(),origem_cidade,origem_uf,destino_cidade,destino_uf, meu_veiculo,valor_rota);
         }else{
            return;            
         }
         
       });
      
      



    });