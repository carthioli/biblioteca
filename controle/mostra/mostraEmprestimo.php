<?php

  function mostraEmprestimo(){  
   
    $link = include "..\\insere\\conexao.php";

    $query = pg_query("SELECT id
                       FROM emprestimo
                       ORDER BY id DESC 
                       LIMIT 1");

    $resultado = pg_fetch_assoc( $query );
    return $resultado['id'];

    /*
    $emprestimos = [];
  
    while ( $resultado = pg_fetch_assoc( $query ) ){
      $emprestimos[] = [
          'id'   => $resultado['id']
      ];
    }

    foreach ( $emprestimos as $emprestimo){
      
    }
    
    return $emprestimo['id'];
    */
  } 
?>
