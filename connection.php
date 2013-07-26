<?php


        $link = mysql_connect('192.168.1.4', 'root', 'root123'); //##dbconn
        if (!$link) {
            die('Não foi possível conectar: ' . mysql_error()."<br><br>");
        }
        mysql_set_charset('utf8',$link);
        $db_selected = mysql_select_db('mobylidade', $link);//##base
        if (!$db_selected) {
            die ('Não foi possível selecionar : ' . mysql_error());
        }
    
    
    
    
    
     function ExecSQL($sql)
    {
        $result = mysql_query($sql);
        if (!$result) {
            die('Consulta Inválida: ' . mysql_error());
        }
		return $result;
    }


	
?>
