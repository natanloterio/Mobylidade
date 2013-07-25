var FancyWebSocket = function(url,usrID)
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
	var MESSAGE_NOT_SENT_TO_USER = 18;	
	// O Contato está se conectando
	var CONTACT_CONNECTING = 19;
	// registrando sua localizacao
	var REGISTER_POSITION = 20;
	// adiciona um contato
	var ADD_CONTACT = 21;	
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
	this.onOpenListener = function(f){}
		
	this.setListenerOnClose = function(func){

		_self.onOpenListener = func;
	}

	this.onOpen = function(){
		_self.userConnecting();
		_self.onOpenListener();
	}


	
	this.onClose = function(func){
		_self.userDisonnecting();
	}

	
	// vamos implementar os eventos de que precisamos algum retorno por parte do nosso cliente
	this.messageToUser =  function(receiverID, message){
		
		// montamos o cabecalho da acao
		var action_id = newActionId();
		var action = {
					"action_id":action_id,
					"type":MESSAGE_TO_USER,
					"sender":userID,
					"receiver":receiverID,
					"message":message
					};
		this.conn.send( JSON.stringify(action,null));
	}
	
//	 funcao para atulaizar status do usuario
	this.userConnecting = function(){
		bundle = {	"action_id":newActionId(),
					"type":USER_CONNECTING, 
					"sender":userID, 
					"receiver":GOD};
		this.conn.send(JSON.stringify(bundle,null));
	};
	
	// funcao para atulaizar status do usuario
	this.userDisonnecting = function(){
		bundle = {	"action_id":newActionId(),
					"type":USER_DISCONNECTING, 
					"sender":userID,
					"receiver":GOD};
		this.conn.send(JSON.stringify(bundle,null));
	}
	
	
	// funcao para atualizar posicao do usuario
	this.updateUserLocation = function(longitutde, latitude){
		bundle = {	"action_id":newActionId(),
					"type":REGISTER_POSITION, 
					"sender":userID,
					"receiver":GOD,
					"latitude":latitude,
					"longitude":longitude};
		this.conn.send(JSON.stringify(bundle,null));
	}
	
	// funcao para adicionar um contato
	this.addContact = function(contatc,message){
		bundle = {	"action_id":newActionId(),
					"type":ADD_CONTACT, 
					"sender":userID,
					"receiver":contact,
					"message":message};
		this.conn.send(JSON.stringify(bundle,null));
	}		
	
	this.connect = function() {
		if ( typeof(MozWebSocket) == 'function' )
			this.conn = new MozWebSocket(url);
		else
			this.conn = new WebSocket(url);

		
		
		// Esse carinha aqui é que recebe todos os actions do servidor... manéeee.. glé glé glé glé glé 
		this.conn.onmessage = function(evt){
			var action = JSON.parse(evt.data);
			// verifico o tipo da action
			switch(action.type)
			{
			case MESSAGE_TO_USER:
			  dispatch('onReceiveMessage',action);
			  break;
			case USER_CONNECTING:
			  dispatch('onUserConnecting',action);
			  break;
			default:
			  //code to be executed if n is different from case 1 and 2
			}			
			
		}

		this.conn.onopen = function(){
			_self.onOpen();
		}
		

		this.disconnect = function() {
			
			_self.conn.close();
		}	
		
	}

	
	window.onbeforeunload = function(){alert('onBerofreUnload');}
	
	

	
	var dispatch = function(event_name, message){
		var chain = callbacks[event_name];
		if(typeof chain == 'undefined') return; // no callbacks for this event
		for(var i = 0; i < chain.length; i++){
			chain[i]( message );
		}
	}
}