<?php

    $link = include "..\\controle\\insere\\conexao.php";

    $query = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, el.data_emprestimo
                      FROM livro as l
                      JOIN autor AS a ON a.id = l.id_autor
                      JOIN editora as e ON e.id = l.id_editora
                      JOIN emprestimo_livro as el ON el.id_livro = l.id
                      ORDER BY 1 ASC");

    

    $livros = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $livros[] = [
      'id'       => $resultado['id'],
      'titulo'   => $resultado['titulo'],
      'autor'    => $resultado['nome_autor'],
      'editora'  => $resultado['nome_editora'],
      'data_emprestimo' => $resultado['data_emprestimo']
    ];
    }
 

?>
