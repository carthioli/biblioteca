<?php

  function mostraEmprestimo(){  
   
    $link = include "../insere/conexao.php";

    $query = pg_query("SELECT id, data_emprestimo
                       FROM emprestimo
                       ORDER BY id DESC 
                       LIMIT 1");

    $resultado = pg_fetch_assoc( $query );
    return $resultado;

  } 
?>
