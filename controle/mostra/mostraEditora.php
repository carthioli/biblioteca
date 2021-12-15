<?php

    $link = include "../controle/insere/conexao.php";

    $query = pg_query("SELECT id, nome, telefone 
                       FROM editora
                      ");

    $editoras = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $editoras[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome'],
        'telefone' => $resultado['telefone']
    ];
    }
      
?>
