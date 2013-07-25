<?php

require_once("query_builder.php");

if(isset($_POST['usuario']) && isset($_POST['longitude']) && isset($_POST['latitude'])){
    
    $usuario = $_POST['usuario'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    
    if(insere("posicao_usuarios",array("cd_usuario","lat","lng"),array($usuario,$latitude,$longitude))){
        echo "inseriu";
    }else{
        echo "não inseriu";
    }
    
    
    
    
}

?>