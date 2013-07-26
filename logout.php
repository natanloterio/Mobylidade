<?php
setcookie("USUARIO_ID","");
setcookie("USUARIO_NOME","");
setcookie("USUARIO_LOGIN","");
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'inicio.php';
  header("Location: http://$host$uri/$extra");
?>