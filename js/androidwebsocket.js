var EasyWebSocket = function(url,usrID)
{	
	var _self = this;
	var userID = usrID;
	var callbacks = {};
	var ws_url = url;
	var conn;
	var onOpen;
	
	/**
	 *  Constantes dos evnetos 
	 */
	var GOD = 1; // Eu sou Deuxxxxx uaaahahaaa
	// CHAVE DE CRIPTOGRAFIA DO ACTION ID
	var ENCODING_KEY = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	//Cliente está se conectando
	var USER_CONNECTING = 13;
	// Usuário está se autenticando
	var USER_AUTENTICATION = 14
	//Usuário está desconectando
	var USER_DISCONNECTING = 15;
	// Mensagem para usuario
	var MESSAGE_TO_USER = 16;
	// Um usuario mudou de status
	var USER_STATE_CHANGE = 17;
	// O usuario nao recebeu a mensagem
	var MESSAGE_NOT_SENT_TO_USER = 23;	
	// O Contato está se conectando
	var CONTACT_CONNECTING = 18;
	// O Contato está se desconectando
	var CONTACT_DISCONNECTING = 22;
	// Eventos gerados pelo usuario
	var USER_INTERN_ACTION = 24;
	// registrando sua localizacao
	var UPDATE_USER_LOCATION = 20;
	// registrando sua localizacao
	var WHO_IS_HERE = 25;
	
	function newActionId() {
		//var length = 16;
	    //var result = '';
	    //var chars = ENCODING_KEY;
	    //for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
	    return userID+Date.parse(new Date());
	}
	
	
	
	this.bind = function(event_name, callback){
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;// chainable
	};

	this.onOpen;
	this.onClose;


	
	this.onClose = function(func){

		//_self.userDisonnecting();
	}

	
	// vamos implementar os eventos de que precisamos algum retorno por parte do nosso cliente
	this.messageToUser =  function(receiverID, message){
		
		// montamos o cabecalho da acao
		var action_id = newActionId(receiverID);
		var straction = {
					"action_id":action_id,
					"type":MESSAGE_TO_USER,
					"sender":userID,
					"receiver":receiverID,
					"message":message
					};
		//var action = JSON.parse(straction);					
		Android.send( JSON.stringify(straction,null));		
	}
	
	
	
//	 funcao para atulaizar status do usuario
	this.userConnecting = function(){
		// evento
		dispatch('onUserConnecting','');		
		var action_id = newActionId(userID);
		var straction = {
					"action_id":action_id,
					"type":USER_CONNECTING,
					"sender":userID,
					"receiver":GOD
					};	
	
		//var action = JSON.parse(straction);
		Android.send( JSON.stringify(straction,null));
		
	}
	
	// pede do servidor um array com posições das pessoas dentro de dos limites sw e ne
	this.whoIsHere = function(ne,sw){
	
		var straction = {	"action_id":newActionId(userID),
					"type":WHO_IS_HERE, 
					"sender":userID,
					"receiver":GOD,
					"sw":sw,
					"ne":ne}
		//var action = JSON.parse(straction);
		Android.send( JSON.stringify(straction,null));
	}
	
	// funcao para atualizar posicao do usuario
	this.updateUserLocation = function(position){
		
		//log('updateUserLocation'+JSON.stringify(position,null));
		
		//log('position.coords.longitude:'+position.coords.longitude);
		
		var straction = {"action_id":newActionId(userID),
					"type":UPDATE_USER_LOCATION, 
					"sender":userID,
					"receiver":GOD,
					"latitude":position.coords.latitude,
					"longitude":position.coords.longitude};
		log('montou straction');
		//var action = JSON.parse(straction);
		
		//verifica se a conexão está estabelecida
			//log('antes enviar updateUserLocation '+ JSON.stringify(straction,null));
		Android.send( JSON.stringify(straction,null));
		//log('depois de enviar:'+JSON.stringify(straction,null));
	}	
	
	this.connect = function() {

		Android.connect();
		
	}

	// Esse carinha aqui é que recebe todos os actions do servidor... manéeee.. glé glé glé glé glé 
	this.onmessage = function(action){
		
		//var action = JSON.parse(evt.data);
		log(JSON.stringify(action,null));
		//var action = evt.data;
		//alert(action);
		// verifico o tipo da action
		switch(action.type)
		{
		case MESSAGE_TO_USER:
		  dispatch('onReceiveMessage',action);
		  break;
		case CONTACT_CONNECTING:
		  dispatch('onContactConnecting',action.user_connecting);
		  break;
		case CONTACT_DISCONNECTING :
		  dispatch('onContactDisconnecting',action.user_disconnecting);
		  break;
		case USER_INTERN_ACTION :
		  dispatch('onUserInternAction',action.user_inter_action);
		  break;			  
		case WHO_IS_HERE :
		  //log('antes de chamar onUpdateUseresHere');
		  dispatch('onUpdateUseresHere',action.people_arround);
		  break;
		
		case MESSAGE_NOT_SENT_TO_USER:
		  receiver = action.data.receiver;
		  message = action.data.message;
		  //this.messageNotSentToUser(receiver,message);
		  break;
		default:
		  //code to be executed if n is different from case 1 and 2
		}			
		
		}

	/**
	* Atenção, o estado da conexão ainda é WebSocket.CONNECTING, ou seja,
	* ainda não está apta a enviar mensagens para o servidor
	*/
	this.onopen = function(){
	// evento
	dispatch('afterSessionEstabilished','');		
	var action_id = newActionId(userID);
	var straction = {
				"action_id":action_id,
				"type":USER_CONNECTING,
				"sender":userID,
				"receiver":GOD
				};	

		//var action = JSON.parse(straction);
		Android.send( JSON.stringify(straction,null));
	}
	

	this.disconnect = function() {
		
		_self.close();
	}	
	
	
	
	/**
	* chamado quando um contato se conecta
	*/
	this.onContactConnect = function(contactID){}

	/**
	* chamado quando um contato se desconecta
	*/
	this.onContactDisconnect = function(contactID){}
	
	/**
	* chamado quando um contato se desconecta
	*/
	this.onReceiveMessage = function(senderID, message){}
	
	/**
	* chamado quando uma mensagem não tenha conseguido chegar no destino
	*/
	this.messageNotSentToUser = function(receiverID, message){}	
	
	
	

	
	var dispatch = function(event_name, message){
		var chain = callbacks[event_name];
		if(typeof chain == 'undefined') return; // no callbacks for this event
		for(var i = 0; i < chain.length; i++){
			chain[i]( message );
		}
	}
}