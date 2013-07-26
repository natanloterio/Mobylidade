<?php
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
		$xTipoPessoa = $_POST['tipopessoa'];
		$xTelefone = $_POST['telefone'];
		$xEndereco = $_POST['endereco'];
		$xBairro = $_POST['bairro'];
		$xCidade = $_POST['cidade'];
		$xEstado = $_POST['estado'];
		incluirUsuario($xTipoPessoa, $xNomeCompleto, $xEmail, $xSexo, $xLogin, $xSenha, $xTelefone, $xEndereco, $xBairro, $xCidade, $xEstado);
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

function incluirUsuario($aTipoPessoa, $aNomeCompleto, $aEmail, $aSexo, $aLogin, $aSenha, $aTelefone, $aEndereco, $aBairro, $aCidade, $aEstado){
	//echo "teste";
	//$consulta=ExecSQL("SELECT * FROM usuarios WHERE =''");
	
	if( ExecSQL("INSERT INTO usuarios (tipo_pessoa, nome_usuario, email, sexo, login, senha, data_cadastro, telefone, endereco, bairro, cidade, estado) VALUES ('$aTipoPessoa', '$aNomeCompleto', '$aEmail', '$aSexo', '$aLogin', '$aSenha', now(), '$aTelefone', '$aEndereco', '$aBairro', '$aCidade', '$aEstado')")){
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
	return ExecSQL("UPDATE usuarios SET nome_usuario = $aNomeCompleto, email = $aEmail, sexo = $aSexo, senha = $aSenha WHERE id = $aID");
}

function alterarParaExcluido($aID){
	return ExecSQL("UPDATE usuarios SET excluido = 1 WHERE id = $aID");
}

function consultarUsuario($aID){
	$xReturn = array();
	$xConsulta = ExecSQL("SELECT * FROM usuarios WHERE id = $aID");
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