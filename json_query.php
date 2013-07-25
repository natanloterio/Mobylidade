<?php

require_once('connection.php');
require_once('json_util.php');
header('Content-type: application/json');

/*
*
post:query:{  
	tipo:insert, 
	tabela:pessoa, 
	conjunto:[
		{nome:natan},
		{sobrenome:loterio} 
	]
}

*/



 
	try {
		
		
		
		$query = $_POST['query'];
		
		if($query){
		
			//echo json_encode($query);
			//$query = json_decode($query);
			$tipo = $query['tipo'];
		
		
			switch($tipo){
			
				case "insert":
					
					$tabela = $query['tabela'];
					$conjunto= $query['conjunto'];
					
					$colunas = array_keys($conjunto);
					$valores = array_values($conjunto);
					
					// adiciona o campo usuario_id na hora de inserir um dado
					//array_push($colunas,"USUARIO_ID");
					//array_push($valores,getUsuarioLogadoID());
					
					
					
				   // constroi a query...
				   $sql  = "INSERT INTO ".strtoupper($tabela);

				   // implode keys of $array...
				   $sql .= strtoupper(" (`".implode("`, `", $colunas )."`)");

				   // implode values of $array...
				   $sql .= " VALUES ('".implode("', '", $valores)."') ";
				    //echo $sql;
				   // execute query...
				   $result = ExecSQL($sql) ;//or die(mysql_error());					
						
					if($result){
					
						sucesso(array("msg"=>"Registros inseridos"));
					
					}else{
						$t['sql'] = $sql;
						fracasso($t);
					
					}					
				break;
			
				case "consulta":
					
					$tabela = $query['tabela'];
					$conjunto= $query['conjunto'];
					
					$colunas = array_keys($conjunto);
					
					//UPDATE  `mobylidade`.`marca` SET  `nome` =  'Volkswagen_' WHERE  `marca`.`id` =2;
				   // constroi a query...
				   $sql  = "select $colunas FROM $tabela WHERE $where";
				 
				   // execute query...
				   $result = ExecSQL($sql);// or die(mysql_error());					
					//echo "antes if result";
					if($result){
						
						$arRetorno = mysql_fetch_array($result);
						
						$retorno = json_encode($arRetorno);
						
						echo sucesso($retorno);
					
					}else{
					
						echo fracasso();
					
					}					
				break;				
				default:
				break;
			
			}
			
		}
		
		
	} catch (Exception $e) {
	  echo  fracasso("Exceção pega: ",  $e->getMessage(), "\n");
	}	
	






	
	


?>