<?php

    include "..\\..\\config.php"; 
    include "..\\..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";

    $link = include "..\\..\\controle\\insere\\conexao.php";
    definePaginacao();

    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $sql = pg_query("SELECT livro.id, livro.nome as titulo, autor.nome as nome_autor, editora.nome as nome_editora
                        FROM livro 
                        JOIN autor on autor.id = livro.id_autor
                        JOIN editora on editora.id = livro.id_editora
                        WHERE livro.id not in (SELECT id_livro FROM emprestimo_livro)
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
    $emprestados = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
      if ( isset($resultado['id']) ){
        $emprestados[] = [
          'id'   => $resultado['id'],
          'titulo'     => $resultado['titulo'],
          'autor'      => $resultado['nome_autor'],
          'editora'    => $resultado['nome_editora'] 
        ];
      }
    } 
        
      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                              FROM livro
                              WHERE id not in (SELECT id_livro FROM emprestimo_livro) 
                              LIMIT ".QTD_RESGISTROS."");

      $paginacao = verificaPaginas( $pagina_atual, $sqlContador );

    if( isset( $_POST['pesquisar'] ) ){
      $titulo = $_POST['pesquisar'];
      $pesquisa = true;

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
    }   
