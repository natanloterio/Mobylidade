<?php
include_once (dirname(__FILE__) . "/connection.php");
require_once  ('json_util.php');
require_once('login.php');

//header('Content-type: application/json');

if (isset($_POST['acao']))
	$acao = $_POST['acao'];
else
	$acao = '';

switch($acao){
	case 'inclusao':
		$xNomeCompleto = $_POST['login'];
		$xEmail = $_POST['email'];
		$xSexo = $_POST['sexo'];
		$xLogin = $_POST['login'];
		$xSenha = $_POST['senha'];
		
		$xDataCadastro = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		incluirUsuario($xNomeCompleto, $xEmail, $xSexo, $xLogin, $xSenha, $xDataCadastro);
		break;

	case 'alteracao':
		$xNomeCompleto = $_POST['nomecompleto'];
		$xEmail = $_POST['email'];
		$xSexo = $_POST['sexo'];
		$xSenha = $_POST['senha'];
		$xID = $_POST['id'];
		echo alterarUsuario($xNomeCompleto, $xEmail, $xSexo, $xSenha, $xID);
		break;
	
	case 'exclusao':
		$xID = $_POST['id'];
		echo alterarParaExcluido($xID);
		break;
		
	case 'consulta':
		$xID = $_POST['id'];
		echo consultarUsuario($xID);
		break;
		
	default:
	break;
}

function incluirUsuario($aNomeCompleto, $aEmail, $aSexo, $aLogin, $aSenha, $aDataCadastro){
	//echo "teste";
	if( ExecSQL("INSERT INTO USUARIOS (nome_usuario, email, sexo, login, senha, data_cadastro) VALUES ('$aNomeCompleto', '$aEmail', '$aSexo', '$aLogin', '$aSenha', now())")){
		//sucesso();
		//DIRECIONA PARA A PAGAGINA DE LOGIN USANDO POST
		//echo "logar($aLogin,$aSenha)";
		logar($aLogin,$aSenha);
	}else{
		//die('fracassou');
		fracasso();
	}
}

function alterarUsuario($aNomeCompleto, $aEmail, $aSexo, $aSenha, $aID){
	return ExecSQL("UPDATE USUARIOS SET nome_usuario = $aNomeCompleto, email = $aEmail, sexo = $aSexo, senha = $aSenha WHERE id = $aID");
}

function alterarParaExcluido($aID){
	return ExecSQL("UPDATE USUARIOS SET excluido = 1 WHERE id = $aID");
}

function consultarUsuario($aID){
	$xReturn = array();
	$xConsulta = ExecSQL("SELECT * FROM USUARIOS WHERE id = $aID");
	$xCursor = mysql_fetch_array($xConsulta);
	$xCount =  mysql_numrows($xConsulta);
	
	if($xCount > 0){
		$xReturn['x']['n'] = $xCursor['nome_usuario'];
		$xReturn['x']['e'] = $xCursor['email'];
		$xReturn['x']['s'] = $xCursor['sexo'];
		$xReturn['x']['l'] = $xCursor['login'];
		$xReturn['x']['c'] = $xCursor['data_cadastro'];
		$xReturn['x']['ok'] = true;
	}else
	{
		$xReturn['x']['ok'] = false;
	}
	
	return json_encode($xReturn);
}

?>