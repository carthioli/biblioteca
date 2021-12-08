<?php

    session_start();
    if ( !isset($_SESSION['logado'] ) && !$_SESSION['logado'] == 2 ){
        header('location: ../publico/login.php'); 
    }
    
    include "telas/topo.php";
    include "funPaginacao.php";
    include "pesquisa\\livroPesquisado.php";
    include "..\\controle\\mostra\\mostraTodosLivros.php";

    $link = include "..\\controle\\insere\\conexao.php";    

    definePaginacao();

    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                             FROM livro 
                             LIMIT ".QTD_RESGISTROS."");
    
    $paginacao = verificaPaginas( isset($_POST['page']), $sqlContador );

    $sql = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                    FROM livro AS l
                    JOIN autor AS a ON a.id = l.id_autor 
                    JOIN editora AS e ON e.id = l.id_editora
                    LIMIT ".QTD_RESGISTROS." OFFSET {$paginacao['linha_inicial']}");
    $livrosPagina = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
    $livrosPagina[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora']
    ];
    }

    
    $pesquisa = false;

    if( isset( $_POST['pesquisar'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
  
        $pesquisados = livroPesquisado( $titulo );
  
        
      }  

?>