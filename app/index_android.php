<?php
 include_once("../lib/Utils.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
    
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>nCircle</title> 
	<link rel="stylesheet" href="../css/style.css"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="../js/Android.js"></script>		
    <script src="../js/androidwebsocket.js"></script>
	
	<script src="../js/User.js"></script>
	<script src="../js/Util.js"></script>		
    <script>
          var Server;
    var map = 0;
    var longitude = 0;
    var latitude = 0;
    var iconBase = '<?php echo curPageURL();?>images/marker/marcador.png';
    var users = [];
    var userID = Math.floor(Math.random() * 100); //$("#userID").val();	    


    function show_position(position) {
        //log('show_position');
        // atualiza no servidor a posição to sujeito
        //log('Server:'+Server.updateUserLocation);

        Server.updateUserLocation(position);
        //og('depois do updateUserLocation'+position);

    }


    function initialize_map(position) {
		  
		// atualiza no servidor a posição to sujeito
        Server.updateUserLocation(position);
		
        var ltd = (new Number(position.coords.latitude)).toPrecision(10);
        var lng = (new Number(position.coords.longitude)).toPrecision(10);

        //logg("initialize_map(lat:"+ltd+",long:"+lng+")");

        var latlng = new google.maps.LatLng(ltd, lng);
        //var latlng = new google.maps.LatLng(-27.068298, -48.882650);

        var myOptions = {
            zoom: 18,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            //scrollwheel: false,
            //navigationControl: false,		    
            mapTypeControl: false
            //scaleControl: false,
            //draggable: false,		    
        }
        //log('antes criar novo mapa');
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        //log('depois criar mapa'+map);


        // define listener para sabermos quando os limites do mapa mudam
        google.maps.event.addListener(map, 'tilesloaded', function () {
            // logg('tilesloaded');

            // pegar do  servidor uma lista dos usuarios dentro desses limites
            setInterval(function () {
                var bounds = map.getBounds();
                var ne = new Array();
                var sw = new Array();

                ne[0] = bounds.getNorthEast().jb;
                ne[1] = bounds.getNorthEast().kb;
                sw[0] = bounds.getSouthWest().jb;
                sw[1] = bounds.getSouthWest().kb;
                Server.whoIsHere(ne, sw); // who is here server?
            }, 3000);

        });

        //divMapa = document.getElementById("map_canvas");
        //logg("tamanho div mapa:w:"+divMapa.style.width+", h:"+divMapa.style.width);
        /*divMapa = document.getElementById("map_canvas");
				
				if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
					divMapa.style.width = '100 % ';
					divMapa.style.height = '100 % ';
				} else {
					divMapa.style.width = '600px';
					divMapa.style.height = '800px';
				}
				*/

        // depois de renderizar o mapa, chama um evento. Adequado à este momento
        //addUser(userID, map, latlng); TODO : AGORA A POSICAO DESTE CARA VIRÁ DO SERVIDOR

	

    function addUser(userID, map, position) {
		log('addUser');
        var usuario = new User(userID, map, position);
        users.push(usuario);
		// adiciona evento onclick
		var mrk = usuario.getMarker(userID);
		
 	    google.maps.event.addListener(mrk, 'click', function() {
				
				abrirChat(usuario);
				
		  });			
        
    }


    function removeUserFromMap(userID) {
        // procura o usuario dentro do array de usuarios
        var len = users.length;
        for (var i = 0; i < len; i++) {
            var uid = users[i].getUserID();
            if (uid == userID) {
                users[i].removeMarker();
                users.remove(i);
            }
        }

    }


    function send(receiver_userid, text) {
        Server.messageToUser(receiver_userid, text);
    }


    function onConnectHibrido() {
        Server.onopen();
    }

    function conectar() {

        var url = "ws://192.168.1.3:300";
        //var serverUrl = '192.168.0.113'; //$("#serverUrl").val();
        $('#userID').val(userID);
        //alert('conectando com usuario : '+userID+'\n em:'+url);

        Server = new EasyWebSocket(url, userID);

        //Binda uma funcao ao evento onUserConnecting
        Server.bind('onUserConnecting', function (action) {
            // TODO
        });

        //Binda uma funcao ao evento onReceiveMessage
        Server.bind('onReceiveMessage', function (action) {
            log(action.sender + " disse " + action.message);
        });

        //Binda uma funcao ao evento onReceiveMessage
        Server.bind('onUpdateUseresHere', function (listaUsuarios) {
            //log('onUpdateUseresHere');
            var len = listaUsuarios.length;



            // Insere 
            for (var i = 0; i < len; i++) {
				var bolEstaNoMapa = false;			
                var uid = listaUsuarios[i].userID;
                var lat = listaUsuarios[i].position.latitude;
                var lng = listaUsuarios[i].position.longitude;
                var position = new google.maps.LatLng(lat, lng, false);

                // se o usuario existe e sua posiçao permanece a mesma, atualiza
                for (var j = 0; j < users.length; j++) {
                    // se o usuario está n array
                    if (users[j].getUserID() == uid) {
                        bolEstaNoMapa = true;
                        // verifica se su posição mudou
                        uLatChange = users[j].position.latitude == listaUsuarios[i].position.latitude;
                        uLonChange = users[j].position.longitude == listaUsuarios[i].position.longitude;
                        // se houve diferenca, remove marcador da posicao
                        if (uLatChange && uLonChange) {
                            removeUserFromMap(uid);
                            addUser(uid, map, listaUsuarios[i].position);
                        }


                    }
                }

                if (!bolEstaNoMapa) {
                    // se ele não estiver na lista, insere
                    addUser(uid, map, position);
                }
            }

            // agora faz o inverso. Procura dentro da lista de enviados por cada usuario que já desenhamos.
            // e check each of them aren't present in this new viewport.

            for (i = 0; i < users.length; i++) {
                userPresent = false;
                uid = users[i].getUserID();
                //search by this user in new Users in the list given by server
                for (j = 0; j < listaUsuarios.length; j++) {
                    if (uid == listaUsuarios[j].userID) {
                        userPresent = true;
                    }
                }

                if (!userPresent) {
                    removeUserFromMap(uid);
                }

            }




        });

        //Binda uma funcao ao evento onReceiveMessage
        Server.bind('afterSessionEstabilished', function (action) {
            //log("afterSessionEstabilished");

            // se esta sendo rodado em um aplicativo android
            if (Android !== null) {
                log('Interface Android disponivel');

                // Simula chamada do Android do navegador
                Android.getCurrentPositionHibrido();
                // este metodo retornará em getCurrentPositionHibrido principal

            } else {

                log('Interface Android não presente');
                if (navigator.geolocation) {
                    log("Tem suporte geolocation no navegador");
                    // pega a posição inicial do usuario
                    navigator.geolocation.getCurrentPosition(initialize_map);
                    // chamdo quando a posição do usuario mudqa
                    navigator.geolocation.watchPosition(show_position)

                } else {
                    log("Não tem suporte geolocation");
                }
            }




        });

        Server.connect();

    }

    function getCurrentPositionHibrido(position) {

        //log('getCurrentPositionHibrido do cliente');
        initialize_map(position);
    }

    function watchPositionHibrido(position) {
        //log('watchPositionHibrido do cliente');
        // se o mama ainda não foi inicializado, tenta reinicia-lo
        if (mapa <= 0) {
            initialize_map(position);
        } else {
            show_position(position);
        }
    }

    function start_app() {
        // conecta ao servidor
        conectar();
		// 
			
    }

	function abrirChat(user){
			$("#abreChat").click();					
		}	


	

    $('#reconecta').click(function () {

        log('reconectando...');

        // inicia a aplicacao
        start_app();

    });

    $(document).delegate("#mapa", "pageinit", function () {
        // inicia a aplicacao
        //log("mapa.pageinit");
        start_app();
        //alert('teste');
    });


    function log(txt) {
        //document.getElementById('log').innerHTML = document.getElementById('log').innerHTML + "<p>" + txt + "</p>";
    }




    function Newinitialize(lat, lng) {
        center = new google.maps.LatLng(lat, lng);
        var myOptions = {
            zoom: 14,
            center: center,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    }
        </script>	
		
</head>    

    <body>
		<!-- Inicio da pagina do mapa-->
		<div id="mapa" data-role="page" >
		
		  <div data-role="header">	
			<a id="abreChat" href="#popupchat" data-rel="popup" data-position-to="window">pop</a>
			 <h1>Mobilydade</h1>
		  </div>
		  
			<div data-role="content"  class="content"> 
			
			   <div id="map_canvas" style="height:300px; width:100%;"></div>
				<div id="log"></div>
			</div>

			   
			</div>
			
		</div>
		
		<!-- Fim da pagina do mapa-->
		<!-- Inicio da pagina do chat-->
		<div data-role="popup" id="popupchat" data-overlay-theme="a" data-theme="a" data-corners="false" data-tolerance="15,15">

			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			 
			<h1>akakaka</h1>
			 
		</div>
		<!-- Fim da pagina do chat-->	
    </body>

</html>