<?php
session_start();
 function getUsuarioLogadoLogin(){
  $login = '';
  if(isset($_SESSION['USUARIO_LOGIN'])){
    $login = $_SESSION['USUARIO_LOGIN'] ;
  }
  
  return $login;

}

function getUsuarioLogadoID(){
  $id = -1;
  if(isset($_SESSION['USUARIO_ID'])){
    $id = $_SESSION['USUARIO_ID'] ;
  }
  
  return intval($id);

}


function getUsuarioLogadoNomeCompleto(){
  $nome = '';
  if(isset($_SESSION['USUARIO_NOME'])){
    $nome = $_SESSION['USUARIO_NOME'] ;
  }else{
    $nome = 'desconhecido';
  }
  
  return $nome;

}

function getUserProfileImageUrl(){
  $url_profile = '';
  if(isset($_SESSION['USUARIO_PROFILE_IMAGE_URL'])){
    $url_profile = $_SESSION['USUARIO_PROFILE_IMAGE_URL'] ;
  }else{
    $url_profile = 'image/profile.png';
  }  
  return $url_profile;
  
}

?>