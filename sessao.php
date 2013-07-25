<?php

error_reporting(E_ALL);
 if(isset($_COOKIE['USUARIO_LOGIN'])){
    
 
 }else{
  
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'fazer_login.php';
  header("Location: http://$host$uri/$extra");
  exit;

 }
 
require_once('login_util.php');

?>