<?php


function sucesso($arrayRetorno = array()){
 
	$retorno = array_merge(array("sucesso"=>1), $arrayRetorno);
	echo json_encode($retorno);
	
}

function fracasso($arrayRetorno = array()){

	$retorno = array_merge(array("sucesso"=>0), $arrayRetorno);
	echo json_encode($retorno);


}
?>