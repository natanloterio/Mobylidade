<?php

require_once('connection.php');

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





 
	try {
		
		
		
		$query = $_POST['query'];
		
		if($query){
		
		
			//$query = json_decode($query);
			$tipo = $_POST['tipo'];
		
		
			switch($tipo){
			
				case "insert":
					
								
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
	

 /*
  *Insere um registro numa tabela.
  *@tabela - nome da tabela
  *@colunas - array com os nomes das colunas que irão ser inseridas
  *@valores - array com os valores das colunas que irão ser inseridas
  */
function insere($tabela,$colunas,$valores){
	
	// constroi a query...
	$sql  = "INSERT INTO $tabela";
	
	// implode keys of $array...
	$sql .= " (`".implode("`, `", $colunas )."`)";
	
	// implode values of $array...
	$sql .= " VALUES ('".implode("', '", $valores)."') ";
	
	// execute query...
	$result = ExecSQL($sql) ;//or die(mysql_error());					
		
	if($result){
	
		return true;
	
	}else{
	
		return false;
	
	}		

}


	
	


?>