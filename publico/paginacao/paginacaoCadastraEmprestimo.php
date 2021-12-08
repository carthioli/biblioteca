<?php
    include "..\\header\\header.php"; 
    include "..\\..\\config.php"; 
    include "..\\..\\controle\\mensagem.php";
    include "..\\pesquisa\\livroPesquisado.php";
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

      $pesquisados = livroPesquisado( $titulo );

      
    }   
