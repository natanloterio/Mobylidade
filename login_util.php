<?php

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
  $nome = '';
  if(isset($_COOKIE['USUARIO_NOME'])){
    $nome = $_COOKIE['USUARIO_NOME'] ;
  }else{
    $nome = 'desconhecido';
  }
  
  return $nome;

}

function getUserProfileImageUrl(){
  $url_profile = '';
  if(isset($_COOKIE['USUARIO_PROFILE_IMAGE_URL'])){
    $url_profile = $_COOKIE['USUARIO_PROFILE_IMAGE_URL'] ;
  }else{
    $url_profile = 'image/profile.png';
  }  
  return $url_profile;
  
}

?>