<?php
    include "..\\config.php";
    $link =  include CONTROLE . "insere\\conexao.php";
    
    $querytodos = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora");
    $todoslivros = [];

    while ( $resultado = pg_fetch_assoc( $querytodos ) ){
    $todoslivros[] = [
    'id'   => $resultado['id'],
    'titulo' => $resultado['nome'],
    'autor'  => $resultado['autor'],
    'editora'=> $resultado['editora']
    ];
    }
    
?>