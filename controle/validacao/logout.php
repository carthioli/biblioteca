<?php
  session_start();

  if ( $_SESSION['logado'] == 1 || $_SESSION['logado'] == 2 ){
    session_destroy();
    header('location: ..\..\publico\login.php');
  }

?>