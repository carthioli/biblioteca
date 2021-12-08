<?php 
    include "..\\..\\config.php"; 
    include "..\\header\\header.php";
    include "..\\pesquisa\\livroPesquisado.php";
    include "..\\..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";
  
    $link = include "..\\..\\controle\\insere\\conexao.php";
    
    definePaginacao();

    if ( empty( $_POST['pesquisar'] ) ){
      $pesquisa = true;
      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                                FROM livro
                                WHERE id not in (SELECT id_livro FROM emprestimo_livro) 
                                LIMIT ".QTD_RESGISTROS."");

        $paginacao = verificaPaginas( isset( $_POST['page'] ), $sqlContador );

      $sql = pg_query("SELECT livro.id, livro.nome as titulo, autor.nome as nome_autor, editora.nome as nome_editora
                          FROM livro 
                          JOIN autor on autor.id = livro.id_autor
                          JOIN editora on editora.id = livro.id_editora
                          WHERE livro.id not in (SELECT id_livro FROM emprestimo_livro)
                          LIMIT ".QTD_RESGISTROS." OFFSET {$paginacao['linha_inicial']}");
      $livros = [];

      while ( $resultado = pg_fetch_assoc( $sql ) ){
        if ( isset($resultado['id']) ){
          $livros[] = [
            'id'   => $resultado['id'],
            'titulo'     => $resultado['titulo'],
            'autor'      => $resultado['nome_autor'],
            'editora'    => $resultado['nome_editora'] 
          ];
        }
      } 
    }else{     
    $pesquisa = false;

    if( isset( $_POST['pesquisar'] ) ){
      $titulo = $_POST['pesquisar'];
      $pesquisa = true;

      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                                FROM livro
                                WHERE id not in (SELECT id_livro FROM emprestimo_livro) 
                                LIMIT ".QTD_RESGISTROS."");

      $paginacao = verificaPaginas( isset( $_POST['page'] ), $sqlContador );
      
      $pesquisa = livroPesquisado( $titulo );
      $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                      FROM livro AS l
                      JOIN autor AS a ON a.id = l.id_autor
                      JOIN editora AS e ON e.id = l.id_editora
                      WHERE l.nome LIKE '%$titulo%'");

      $livros = [];

      while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
      $livros[] = [
           'id' => $resultadoPesquisado['id'],
       'titulo' => $resultadoPesquisado['nome'],
        'autor' => $resultadoPesquisado['autor'],
      'editora' => $resultadoPesquisado['editora']
      ];
      }
    }
  }   
