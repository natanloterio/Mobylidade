<?
include_once (dirname(__FILE__) . "/connection.php");

if (isset($_POST['acao']))
	$acao = $_POST['acao'];
else
	$acao = '';

switch($acao){
	case 'inclusao':
		$xFK_usuario_id = $_POST['id_usuario'];
		$xFK_veiculo_id = $_POST['id_veiculo'];
		$xDataCadastro = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);		
		return incluirVeiculoUsuario($xFK_usuario_id, $xFK_veiculo_id, $xDataCadastro);
		break;

	case 'alteracao':
		$xID = $_POST['id'];
		$xFK_usuario_id = $_POST['id_usuario'];
		$xFK_veiculo_id = $_POST['id_veiculo'];
		$xModelo = $_POST['modelo'];
		return alterarVeiculoUsuario($xID, $xFK_usuario_id, $xFK_veiculo_id);
		break;
	
	case 'exclusao':
		$xID = $_POST['id'];
		return alterarParaExcluido($xID);
		break;
		
	case 'consulta':
		$xID = $_POST['id'];
		return consultarVeiculo($xID);
		break;
}

function incluirVeiculoUsuario($aFK_usuario_id, $aFK_veiculo_id, $aDataCadastro){
	return ExecSQL("INSERT INTO veiculos_usuario (fk_usuario_id, fk_veiculo_id, data_cadastro) VALUES ($aFK_usuario_id, $aFK_veiculo_id, $aDataCadastro");
}

function alterarVeiculoUsuario($aID, $aFK_usuario_id, $aFK_veiculo_id){
	return ExecSQL("UPDATE veiculos_usuario SET fk_usuario_id = $aFK_usuario_id, fk_veiculo_id = $aFK_veiculo_id WHERE id = $aID");
}

function alterarParaExcluido($aID){
	return ExecSQL("UPDATE veiculos_usuario SET excluido = 1 WHERE id = $aID");
}

function consultarVeiculo($aID){
	$xReturn = array();
	$xConsulta = ExecSQL("SELECT * FROM veiculos_usuario WHERE id = $aID");
	$xCursor = mysql_fetch_array($xConsulta);
	$xCount =  mysql_numrows($xConsulta);
	
	if($xCount > 0){
		$xReturn['x']['i'] = $xCursor['id'];
		$xReturn['x']['u'] = $xCursor['fk_usuario_id'];
		$xReturn['x']['v'] = $xCursor['fk_veiculo_id'];
		$xReturn['x']['d'] = $xCursor['data_cadastro'];
		$xReturn['x']['x'] = $xCursor['excluido'];
		$xReturn['x']['ok'] = true;
	}else
	{
		$xReturn['x']['ok'] = false;
	}
	return json_encode($xReturn);
}

?>