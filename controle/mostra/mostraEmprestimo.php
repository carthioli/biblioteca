<?php

  function mostraEmprestimo(){  
   
    $link = include "..\\insere\\conexao.php";

    $query = pg_query("SELECT id, id_aluno 
                       FROM emprestimo
                       ORDER BY id DESC 
                       LIMIT 1");
  
    $emprestimos = [];
  
    while ( $resultado = pg_fetch_assoc( $query ) ){
    $emprestimos[] = [
        'id'   => $resultado['id_aluno']
    ];
    }
    foreach ( $emprestimos as $emprestimo){
      
    }return $emprestimo['id'];
  } 
?>
