<?php
    include "..\\config.php";
    $link =  include CONTROLE . "insere\\conexao.php";

    $pesquisa = false;

    if( isset( $_POST['pesquisar'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                        FROM livro AS l
                        JOIN autor AS a ON a.id = l.id_autor
                        JOIN editora AS e ON e.id = l.id_editora
                        WHERE l.nome LIKE  '%$titulo%'");

        $livros = [];

        while( $resultado = pg_fetch_assoc( $query ) ){
        $livros[] = [
            'id' => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor' => $resultado['autor'],
        'editora' => $resultado['editora']
        ];
        }
    }  


?>