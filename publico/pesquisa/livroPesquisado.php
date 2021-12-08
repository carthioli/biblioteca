<?php
  function livroPesquisado( $titulo ){

    $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                      FROM livro AS l
                      JOIN autor AS a ON a.id = l.id_autor
                      JOIN editora AS e ON e.id = l.id_editora
                      WHERE l.nome LIKE  '%$titulo%'");

      $livrosPesquisados = [];

      while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
      $livrosPesquisados[] = [
           'id' => $resultadoPesquisado['id'],
       'titulo' => $resultadoPesquisado['nome'],
        'autor' => $resultadoPesquisado['autor'],
      'editora' => $resultadoPesquisado['editora']
      ];
      }
      return $livrosPesquisados;
  }
?>