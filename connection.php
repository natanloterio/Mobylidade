<?php


        $link = mysql_connect('192.168.1.4', 'root', 'root123'); //##dbconn
        if (!$link) {
            die('N�o foi poss�vel conectar: ' . mysql_error()."<br><br>");
        }
        mysql_set_charset('utf8',$link);
        $db_selected = mysql_select_db('mobylidade', $link);//##base
        if (!$db_selected) {
            die ('N�o foi poss�vel selecionar : ' . mysql_error());
        }
    
    
    
    
    
     function ExecSQL($sql)
    {
        $result = mysql_query($sql);
        if (!$result) {
            die('Consulta Inv�lida: ' . mysql_error());
        }
		return $result;
    }


	
?>
