<?php

    $link = include "../controle/insere/conexao.php";

    $query = pg_query("SELECT id, nome, sobrenome, cpf 
                       FROM autor
                      ");

    $autores = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $autores[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome'],
        'sobrenome' => $resultado['sobrenome'],
        'cpf'  => $resultado['cpf'] 
    ];
    }
      
?>
