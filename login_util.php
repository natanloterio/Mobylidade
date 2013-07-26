<?php
require_once('connection.php');

 function getUsuarioLogadoLogin(){
  $login = '';
  if(isset($_COOKIE['USUARIO_LOGIN'])){
    $login = $_COOKIE['USUARIO_LOGIN'] ;
  }
  
  return $login;

}

function getUsuarioLogadoID(){
  $id = -1;
  if(isset($_COOKIE['USUARIO_ID'])){
    $id = $_COOKIE['USUARIO_ID'] ;
  }
  
  return intval($id);

}


function getUsuarioLogadoNomeCompleto(){
  
  $id = getUsuarioLogadoID();
  $nome_completo = 'Desonhecido';
  //echo "natan";
  if($id > 0){
    $sql = "select nome_usuario from usuarios where USUARIO_ID = $id";
    //echo $sql;
    $result = ExecSQL($sql);
    if($result){
      
      $linha = mysql_fetch_array($result);
      $nome_completo = $linha['nome_usuario'];
    }
    
  }
  
  return $nome_completo;

}

function getUserProfileImageUrl(){
  $id = getUsuarioLogadoID();
  $url_profile = 'image/profile.png';
  if($id > 0){
    $sql = "select url_profile_image_url from usuarios where USUARIO_ID = $id";
    //echo $sql;
    $result = ExecSQL($sql);
    if($result){
      
      $linha = mysql_fetch_array($result);
      $url_profile = $linha['url_profile_image_url'] ;
    }
    
  }
  
  return $url_profile;
 
}


function getUsuarioTipo(){
  $id = getUsuarioLogadoID();
  $tipo_pessoa = 'U';
  if($id > 0){
    $sql = "select tipo_pessoa from usuarios where USUARIO_ID = $id";
    //echo $sql;
    $result = ExecSQL($sql);
    if($result){
      
      $linha = mysql_fetch_array($result);
      $tipo_pessoa = $linha['tipo_pessoa'];
    }
    
  }
  
  return $tipo_pessoa;

}

?>