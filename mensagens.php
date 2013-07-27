<?php
require_once('sessao.php');
require_once('login_util.php');
?>

<?php
$acao = strip_tags($_POST['acao']);

switch($acao){
    case 'enviarmensagem':
        $xMensagem = strip_tags($_POST['mensagem']);
        $xUsuarioSender = $_POST['sender'];
        $xUsuarioReceiver = $_POST['receiver'];
        echo enviarMensagem($xUsuarioSender, $xUsuarioReceiver, $xMensagem);
        break;
    
    case 'getmessagesnotread':
        $xUserID = $_POST['u'];
        echo getCountMessagesNotRead($xUserID);
        break;
    
    case 'setread':
        setReadMessage($xUserRead, $xUserSend);
        break;
    
    case 'getmessages':
        $xUserB = getUsuarioLogadoID();
        $xUserA = $_POST['u'];        
        echo getMessagesUsToUs($xUserA, $xUserB);
        break;
}

function enviarMensagem($aUsSend, $aUsReceiver, $aMessage){
    date_default_timezone_set("Brazil/East");
    $xDateTime = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    return ExecSQL("INSERT INTO mensagens (us_sender, us_receiver, message, hora, lida) VALUES ($aUsSend, $aUsReceiver, '$aMessage', '$xDateTime', 'N')");
}

function getMessagesUsToUs($aUserA, $aUserB){
    $xMessages = array();
    $xResultMessage = '';
    $xSql = "SELECT U.NOME_USUARIO, M.* ".
            "  FROM MENSAGENS M ".
            "  LEFT JOIN USUARIOS U ON U.USUARIO_ID = M.US_SENDER ".
            " WHERE (M.US_SENDER = $aUserA AND M.US_RECEIVER = $aUserB) ".
            "    OR (M.US_SENDER = $aUserB AND M.US_RECEIVER = $aUserA ) ".
            " ORDER BY HORA ASC ";
    
    $xqueryMessages = ExecSQL($xSql);
    $xCount = mysql_numrows($xqueryMessages);
    
    for ($index = 0; $index < $xCount; $index++) {
        $xCursor = mysql_fetch_array($xqueryMessages);

        $xDataMessage = $xCursor['hora'];
        $xUserSend = $xCursor['us_sender'];
        $xUserReceiver = $xCursor['us_receiver'];
        $xMessage = $xCursor['message'];
        $xMensagenLida = $xCursor['lida'];
        $xName = $xCursor['NOME_USUARIO'];

        $xMensagem = array(  'sender' => $xCursor['us_sender'],
                           'receiver' => $xCursor['us_receiver'],
                           'mensagem' => $xCursor['message'],
                               'nome' => $xCursor['NOME_USUARIO'],
                               'data' => $xCursor['hora'],
                               'lida' => $xCursor['lida']);                           

        $xMessages[$index] = $xMensagem;    
    }
    
    return json_encode($xMessages);
}

function getCountMessagesNotRead($aUserID){
    $xMessages = array();

    $xSql = "SELECT USER.NOME_USUARIO, M1 . * ".
            "  FROM MENSAGENS M1 ".
            " INNER JOIN USUARIOS USER ON M1.US_SENDER = USER.USUARIO_ID ".
            "  LEFT JOIN MENSAGENS M2 ON M1.US_SENDER = M2.US_SENDER ".
            "   AND M1.US_RECEIVER = M2.US_RECEIVER ".
            "   AND M1.HORA < M2.HORA ".
            " WHERE M2.ID IS NULL  ".
            "   AND M1.US_RECEIVER = $aUserID ".
            "   AND M1.LIDA <>  'S' ".
            "   AND M1.US_SENDER <> $aUserID ".
            " ORDER BY M1.HORA DESC ";

        $xqueryMessages = ExecSQL($xSql);
        $xCount = mysql_numrows($xqueryMessages);
        $xMessages['countnotread'] = $xCount;
        
        for ($index = 0; $index < $xCount; $index++) {
            $xCursor = mysql_fetch_array($xqueryMessages);
            $xMensagem = array(  'sender' => $xCursor['us_sender'],
                               'mensagem' => $xCursor['message'],
                                   'nome' => $xCursor['NOME_USUARIO'],
                                   'data' => $xCursor['hora'],
                                   'lida' => $xCursor['lida']);
            
            
            $xMessages['messages'][$index] = $xMensagem;
        }
        return json_encode($xMessages);
}

function setReadMessage($aUserRead, $aUserSend){
    ExecSQL("UPDATE mensagens SET lida = 'S' WHERE us_receiver = $aUserRead AND us_sender = $aUserSend");
}