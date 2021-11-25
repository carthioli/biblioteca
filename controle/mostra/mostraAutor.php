<?php

    $link = include "..\\controle\\insere\\conexao.php";

    $query = pg_query("SELECT id, nome 
                       FROM autor
                      ");

    $autores = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $autores[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome']
    ];
    }
      
?>
