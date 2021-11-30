<?php

    session_start();

    $link = include "..\insere\conexao.php";

    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    $sql = ("SELECT id, id_usuario, usuario, nivel, senha
                       FROM login 
                       WHERE usuario = ('".$usuario."') AND (senha = '".$senha."')");

    $query = pg_query( $sql );

    if (pg_num_rows($query) != 1) {
      header('location: ..\\..\\publico\\login.php');
      $_SESSION['erro'] = 9;
  
    } else {
      $resultado = pg_fetch_assoc($query);

      if (!isset($_SESSION)) session_start();

      $_SESSION['usuarioId'] = $resultado['id'];
      $_SESSION['usuarioNome'] = $resultado['nome'];
      $_SESSION['usuarioNivel'] = $resultado['nivel'];

      header('location: ..\\..\\publico\\index.html');
      exit;
    }
    
?>
