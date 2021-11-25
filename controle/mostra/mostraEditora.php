<?php

    $link = include "..\\controle\\insere\\conexao.php";

    $query = pg_query("SELECT id, nome 
                       FROM editora
                      ");

    $editoras = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $editoras[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome']
    ];
    }
      
?>
