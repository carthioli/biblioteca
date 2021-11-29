<?php

    $link = include "..\\controle\\insere\\conexao.php";

    $query = pg_query("SELECT id, nome 
                       FROM aluno
                      ");

    $alunos = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $alunos[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome']
    ];
    }
      
?>
