<?php
include_once (dirname(__FILE__) . "/connection.php");
include_once  ('login_util.php');
include_once  ('sessao.php');

header('Content-type: application/json');

$acao = '';

if (isset($_POST['acao'])){
	$acao = strval($_POST['acao']);
}
//echo "antes switch:$acao";
	

switch($acao){
	case 'inclusao':
		$tipoVeiculoID = $_POST['tipo_veiculo_id'];
		$xIDMarca = $_POST['marca'];
		$xPlaca = $_POST['placa'];
		$xModelo = $_POST['modelo'];
		$xCor = $_POST['cor'];
		$xUsuarioID = getUsuarioLogadoID();
		//TODO COR
		echo incluirVeiculo($tipoVeiculoID, $xIDMarca, $xPlaca, $xModelo, $xUsuarioID,$xCor );
		break;

	case 'alteracao':
		$xID = $_POST['id'];
		$xIDMarca = $_POST['idmarca'];
		$xPlaca = $_POST['placa'];
		$xModelo = $_POST['modelo'];
		echo alterarVeiculo($xID, $xIDMarca, $xPlaca, $xModelo);
		break;
	
	case 'exclusao':
		$xID = $_POST['id'];
		alterarParaExcluido($xID);
		break;
		
	case 'consulta':
		$xID = $_POST['id'];
		return consultarVeiculo($xID);
		break;
	case 'getmarca':
		$xConculta = $_POST['consulta'];;
		echo getMarcaCaminhao($xConculta);
		break;
}

function getMarcaCaminhao($aConsulta){
	//echo "buscando marca: $aConsulta";
	$xReturn = array();
	$xConsulta = ExecSQL("select * from MARCA where nome like '$aConsulta%' ");
	$xCount =  mysql_numrows($xConsulta);
	if($xCount > 0){
		for ($index = 0; $index < $xCount; $index++) {
			$xCursor = mysql_fetch_array($xConsulta);
			$xReturn[$index]['nome'] = $xCursor['nome'];
			$xReturn[$index]['id'] = $xCursor['id'];
			$xReturn[$index]['encontrou'] = true;
		}
	}else{
		$xReturn[0]['encontrou'] = false;
	}
	return json_encode($xReturn);
}

function incluirVeiculo($tipoVeiculoID, $aIDMarca, $aPlaca, $aModelo, $xUsuarioID,$xCor ){
	$sucess = false;
	$return = array("sucess"=>0);
	
	$sucess = ExecSQL("INSERT INTO VEICULO (tipo_veiculo_id, fk_marca_id, placa, modelo, USUARIO_ID,cor) VALUES ($tipoVeiculoID, $aIDMarca, '$aPlaca', '$aModelo',$xUsuarioID,'$xCor')");
	if($sucess){
		$return = array("sucess"=>1);
	}
	return json_encode($return);
}

function alterarVeiculo($aID, $aIDMarca, $aPlaca, $aModelo){
	return ExecSQL("UPDATE VEICULO SET fk_marca_id = $aIDMarca, placa = $aPlaca, modelo = $aModelo WHERE id = $aID");
}

function alterarParaExcluido($aID){
	if(ExecSQL("UPDATE VEICULO SET excluido = 1 WHERE id = $aID")){
		sucesso();
	}else{
		fracasso();
	}
	
}

function consultarVeiculo($aID){
	$xReturn = array();
	$xConsulta = ExecSQL("SELECT * FROM VEICULO WHERE excluido <> 1 and id = $aID");
	$xCursor = mysql_fetch_array($xConsulta);
	$xCount =  mysql_numrows($xConsulta);
	
	if($xCount > 0){
		$xReturn['x']['i'] = $xCursor['id'];
		$xReturn['x']['m'] = $xCursor['fk_marca_id'];
		$xReturn['x']['p'] = $xCursor['placa'];
		$xReturn['x']['o'] = $xCursor['modelo'];
		$xReturn['x']['x'] = $xCursor['excluido'];
		$xReturn['x']['ok'] = true;
	}else
	{
		$xReturn['x']['ok'] = false;
	}
	return json_encode($xReturn);
}

function getTodosVeiculos($usuarioID){
	
$sql = "SELECT V.ID, M.NOME AS MARCA, V.MODELO, V.PLACA, V.USUARIO_ID, T.DESCRICAO AS TIPO_VEICULO ".
	"FROM VEICULO V ".
	"INNER JOIN MARCA M ON ( M.ID = V.FK_MARCA_ID )  ".
	"INNER JOIN TIPO_VEICULO T ON ( T.ID = V.tipo_veiculo_id )  ".
	"WHERE V.excluido <> 1 and V.USUARIO_ID = $usuarioID";
	//echo "$sql";


return ExecSQL($sql);

}


?>