  pacContainerInitialized = false;
   
   var origem = null;
   var destino = null;
      
   function pesquisaRota() {
         
            
          var positionOrigem = origem.geometry.location;
          var positionDestino= destino.geometry.location;
          
          var origem_cidade = origem.address_components[0].short_name;
          var origem_uf    = origem.address_components[1].short_name;
          
          var destino_cidade = destino.address_components[0].short_name;
          var destino_uf    = destino.address_components[1].short_name;
            
         
         
   
   
   	var dados = {
                  "acao": "consulta",
                  "origem_cidade": origem_cidade,
                  "origem_uf": origem_uf,
                  "destino_cidade": destino_cidade,
                  "destino_uf": destino_uf
            };
            
   $.ajax({
	    url : 'rota.php',
	    type : 'post',
	    dataType: 'json',
	    data : dados,
		success: function(x){
			
			if (x.sucesso === 1) {
                           
                           if(x.linhas.length > 0){   
                              var html_linhas = '';
                              // insere os resultados na lista detro de resultado_buca
                              var total_linhas = x.linhas.length;
                              for (i = 0; i < total_linhas; i++) {
                                 
                                 html_linhas += " <li><a href=\"info_rota.php?rota_id="+x.linhas[i].ROTA_ID+"\" rel=\"external\">"+x.linhas[i].NOME_USUARIO+"</a></li>\n";
                                 
                              }
                              
                              // move os campos de busca para o topo da lista de resultados
                              $('.info_busca').hide(1000);
                              
                              $('#lista_resultado_busca').html(html_linhas);
                              $('#lista_resultado_busca').listview('refresh');
                           }else{
                              $('#lista_resultado_busca').html('<div class="no_record_found">Nenhuma rota encontrada</div>');
                           }
                           
                        } else {
                           //alert('não cadastrou');
                        }
			
		},
		error : function(x) {
			//alert('Não foi possível cadastrar este usuário.');
		}
    });
   
   
   }
   
    $(document).ready(function(){

     // ORIGEM
       $('#origem_criteria').keypress(function() {
               if (!pacContainerInitialized) {
                       $('.pac-container').css('z-index', '9999');
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
                     // se origem e destino foram definidos
          if (origem && destino) {
                         
             pesquisaRota();
          }

          })
          .bind("geocode:error", function(event, status){
            alert("ERROR: " + status);
          })
          .bind("geocode:multiple", function(event, results){
            alert("Multiple: " + results.length + " results found");
          });

       
       $('#pesquisa_pesquisar_btn').on('click',function(){
         
         // se origem e destino foram definidos
         if (origem && destino) {
                        
            pesquisaRota();
         }
         
       });
      
      



    });