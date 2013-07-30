<?php

include_once  ('login_util.php');
include_once('json_util.php');

header('Content-type: application/json');

$acao = '';

if (isset($_POST['acao'])){
	$acao = strval($_POST['acao']);
}
//echo "antes switch:$acao";
	

switch($acao){
	case 'inclusao':
		
		$origemLat = $_POST["ORIGEM_LAT"];
		$origemLng = $_POST["ORIGEM_LNG"];
		$destinoLat= $_POST["DESTINO_LAT"];
		$destinoLng = $_POST["DESTINO_LNG"];
		$origem_cidade = $_POST["ORIGEM_CIDADE"];
		$origem_uf = $_POST["ORIGEM_UF"];
		$destino_cidade = $_POST["DESTINO_CIDADE"];
		$destino_uf = $_POST["DESTINO_UF"];
		$meu_veiculo = $_POST["VEICULO_ID"];
		$xValor = $_POST["VALOR_ROTA"];
		
		$xUsuarioID = getUsuarioLogadoID();
		//TODO COR
		$incluiu = incluirRota($origemLat, $origemLng, $destinoLat, $destinoLng,$origem_cidade,$origem_uf,$destino_cidade, $destino_uf,$meu_veiculo, $xUsuarioID,$xValor);
		if($incluiu){
			sucesso();
		}else{
			fracasso();
		}
		break;

	case 'alteracao':
		$xID = $_POST['id'];
		$xIDMarca = $_POST['idmarca'];
		$xPlaca = $_POST['placa'];
		$xModelo = $_POST['modelo'];
		return alterarVeiculo($xID, $xIDMarca, $xPlaca, $xModelo);
		break;
	
	case 'exclusao':
		$xID = $_POST['id'];
		return alterarParaExcluido($xID);
		break;
	
	case 'definir_rota_ativa':
		$xID = $_POST['id'];
		return definirRotaAtiva($xID);
		break;
		
	case 'consulta':

		$origem_cidade = $_POST['origem_cidade'];
		$origem_uf = $_POST['origem_uf'];
		$destino_cidade = $_POST['destino_cidade'];
		$destino_uf = $_POST['destino_uf'];
		echo consultarRotas($origem_cidade,$origem_uf,$destino_cidade,$destino_uf);
	break;
	default:
	break;


}

function incluirRota($origemLat, $origemLng, $destinoLat, $destinoLng,$origem_cidade,$origem_uf,$destino_cidade, $destino_uf,$meu_veiculo, $xUsuarioID,$xValor){
	$sucess = false;
	
	$sql = "INSERT INTO `rota` (`USUARIO_ID`, `ORIGEM_LAT`, `ORIGEM_LNG`, `DESTINO_LAT`, `DESTINO_LNG`, `ORIGEM_CIDADE`, `ORIGEM_UF`, `DESTINO_CIDADE`, `DESTINO_UF`, `VEICULO_ID`,`VALOR`) "
			        ."VALUES ($xUsuarioID, $origemLat, $origemLng,   $destinoLat,   $destinoLng,  '$origem_cidade', '$origem_uf',  '$destino_cidade',  '$destino_uf',  $meu_veiculo,$xValor);";	
	//echo $sql;
	$sucess = ExecSQL($sql);
	
	if($sucess){
		return true;
	}else{
		return false;
	}
}

function alterarVeiculo($aID, $aIDMarca, $aPlaca, $aModelo){
	return ExecSQL("UPDATE  VEICULO SET fk_marca_id = $aIDMarca, placa = $aPlaca, modelo = $aModelo WHERE id = $aID");
}

function alterarParaExcluido($aID){
	if(ExecSQL("UPDATE rota SET excluido = 1 WHERE id = $aID")){
		sucesso();
	}else{
		fracasso();
	}
}

function consultarRotas($origem_cidade,$origem_uf,$destino_cidade,$destino_uf){
try {	
	$xReturn = array();
	
	$sql = "SELECT "
				."R.ID as ROTA_ID, "	
				."R.USUARIO_ID, "
				."(CASE WHEN U.NOME_USUARIO IS NULL THEN 'sem nome' ELSE U.NOME_USUARIO END) AS NOME_USUARIO, "
				."R.ORIGEM_CIDADE, "
				."R.DESTINO_CIDADE, "
				."R.VALOR "
				."FROM rota R "
			        ."INNER JOIN usuarios U "
			        ."ON(R.USUARIO_ID = U.USUARIO_ID) "

				."WHERE (UPPER(R.ORIGEM_CIDADE) LIKE UPPER('$origem_cidade')) "
				."AND (UPPER(R.DESTINO_CIDADE) LIKE UPPER('$destino_cidade')) "
				."AND R.EXCLUIDO <> 1 "
				."AND R.ID NOT IN(SELECT distinct ch.ROTA_ID FROM chamados ch WHERE 
ch.STATUS=1 OR ch.STATUS=2 OR CH.status=3);";
			
	$result = ExecSQL($sql);
	$linhas = array();
	if($result){
		while($row = mysql_fetch_array($result)){
			
			$linha['ROTA_ID'] = $row['ROTA_ID'];
			$linha['USUARIO_ID'] = $row['USUARIO_ID'];
			$linha['NOME_USUARIO'] = $row['NOME_USUARIO'];
			$linha['ORIGEM_CIDADE'] = $row['ORIGEM_CIDADE'];
			$linha['DESTINO_CIDADE'] = $row['DESTINO_CIDADE'];
			$linha['VALOR'] = $row['VALOR'];
			
			
			array_push($linhas,$linha);	
		}
		$xReturn = array("linhas"=>$linhas,"sucesso" => 1);
		
	}else{
		$xReturn['sucesso'] = 1;
		$xReturn['msg'] = mysql_error();
		//$xReturn['sql'] = $sql;
	}
	
	return json_encode($xReturn);
	// 
} catch (Exception $e) {
    return  $e->getMessage()."\n";
}

	
	
}

function getMinhasRotas($uid){
try {	
	$xReturn = array();
	
	$sql = "SELECT "	."R.ID, "
				."R.STATUS, "
				."R.USUARIO_ID, "
				."(CASE WHEN U.NOME_USUARIO IS NULL THEN 'sem nome' ELSE U.NOME_USUARIO END) AS NOME_USUARIO, "
				."R.ORIGEM_CIDADE, "
				."R.VALOR, "
				."R.DESTINO_CIDADE FROM rota R "
			        ."LEFT JOIN usuarios U "
			        ."ON(R.USUARIO_ID = U.USUARIO_ID) "
				."WHERE R.USUARIO_ID = $uid "
				."AND R.EXCLUIDO <> 1";
		
	$result = ExecSQL($sql);
	$linhas = array();
	if($result){
		
		$xReturn = $result;
		
	}else{
		$xReturn['sucesso'] = 1;
		$xReturn['msg'] = mysql_error();
		$xReturn['sql'] = $sql;
	}
	
	return $result;
	// 
} catch (Exception $e) {
    return  $e->getMessage()."\n";
}

	
	
}

function definirRotaAtiva($rota_id){
 // redefine estatus das rotas deste usuario
 ExecSQL("UPDATE rota SET STATUS = 0 WHERE id <> $rota_id and USUARIO_ID = ".getUsuarioLogadoID());
 // ativa a rota passada no parametro
 ExecSQL("UPDATE rota SET STATUS = 1 WHERE id = $rota_id and USUARIO_ID = ".getUsuarioLogadoID());

 sucesso();

	
}

?>