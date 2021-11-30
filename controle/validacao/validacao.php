<?php

    session_start();

    $link = include "..\insere\conexao.php";

    if ( !empty( $_POST['usuario'] ) || !empty( $_POST['senha'] )){

      $usuario = $_POST['usuario'];
      $senha   = $_POST['senha'];

      $sql = ("SELECT l.id, l.id_usuario, l.nivel, l.nome, l.senha, a.nome as nome_aluno, a.sobrenome
              FROM login AS l
              JOIN aluno AS a ON a.id = l.id_usuario
              WHERE l.nome = ('".$usuario."') AND (l.senha = '".$senha."')");

      $query = pg_query( $sql );

      

      if (pg_num_rows($query) != 1) {
        header('location: ..\\..\\login.php');
        $_SESSION['erro'] = 7;
    
      } else {
        $resultado  = pg_fetch_assoc($query);
        

        if (!isset($_SESSION)) session_start();

          if ( $resultado['nivel'] == 1 ) {
              $_SESSION['usuarioId'] = $resultado['id'];
              $_SESSION['usuarioNome'] = $resultado['nome'];
              $_SESSION['usuarioNivel'] = $resultado['nivel'];
              $_SESSION['logado'] = 1;

              header('location: ..\\index.php');
        exit;
          }else {
            $_SESSION['usuarioId'] = $resultado['id'];
            $_SESSION['usuarioNome'] = $resultado['nome_aluno'];
            $_SESSION['usuarioSobrenome'] = $resultado['sobrenome'];
            $_SESSION['usuarioNivel'] = $resultado['nivel'];

            header('location: ..\\..\\publico\\index.php');
            $_SESSION['logado'] = 2;  
          }
        
      }
  }else{
    header('location: ..\\login.html');
    $_SESSION['erro'] = 8;
  }
    
?>
