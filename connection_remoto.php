<?php
class BancoDados
{
    static private $instance;
   
    private function __construct() 
    {
        $link = mysql_connect('mysql.2freehosting.com', 'u586342328_moby', 'root123'); //##dbconn
        if (!$link) {
            die('N�o foi poss�vel conectar: ' . mysql_error()."<br><br>");
        }
        mysql_set_charset('utf8',$link);
        $db_selected = mysql_select_db('u586342328_moby', $link);//##base
        if (!$db_selected) {
            die ('N�o foi poss�vel selecionar : ' . mysql_error());
        }
    }
    
    static public function getInstance() 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
    
        return self::$instance;
    }
   
    public function ExecSQL($sql)
    {
        $result = mysql_query($sql);
        if (!$result) {
            die('Consulta Inv�lida: ' . mysql_error());
        }
		return $result;
    }
}
    function ExecSQL($sql)
	   {
		     return BancoDados::getInstance()->ExecSQL($sql);
    }
	
?>
