<?php

//error_reporting(E_ALL);
require_once('connection.php');
require_once('json_util.php');

//header('Content-type: application/json');

function logar($usuario,$senha){
		$sql = "select USUARIO_ID,NOME_USUARIO AS USUARIO_NOME, login from USUARIOS where login like '$usuario' and senha like '$senha';";
		
		$result = ExecSQL($sql);
		//echo "tem result:".$result;
		if($result){
							
			$arRetorno = mysql_fetch_array($result);
			
			if($arRetorno['login'] === $usuario){
			
				//session_start();
				setcookie('USUARIO_LOGIN',$usuario);
				setcookie('USUARIO_ID',$arRetorno['USUARIO_ID']);
				setcookie('USUARIO_NOME',$arRetorno['USUARIO_NOME']);
				
				//echo "USUARIO_ID: ". $_SESSION['USUARIO_ID'];
				//exit;
				// salva sessao no banco
				//TODO
				// retorna sucesso
				
				
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'inicio.php';
				$header = "Location: http://$host$uri/$extra";
				//echo "redirecionando para $header";
				header($header);
				exit;
				
			}else{
				fracasso(array("msg"=>"Nome ou senha invalidos"));
			}
			
		}else{
			//echo "nada de resultado";
			fracasso(array("msg"=>"Nome ou senha invalidos"));
		}
	}
/*	
if(isset($_POST["usuario"]) && isset($_POST["senha"])){	

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	logar($usuario,$senha);
}else{
	fracasso(array("msg"=>"NENHUMA SENHA OU USUARIO FOI INFORMADO"));
}
*/
?>