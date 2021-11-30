<?php

$link = include "..\controle\insere\conexao.php";

      $qnt = 5;
      $inicio = (1*$qnt) - $qnt;

      $query = pg_query("SELECT livro.id, livro.nome as titulo, autor.nome as nome_autor, editora.nome as nome_editora
                         FROM livro 
                         JOIN autor on autor.id = livro.id_autor
                         JOIN editora on editora.id = livro.id_editora
                         WHERE livro.id not in (SELECT id_livro FROM emprestimo_livro)
                         limit 5
                         ");
      
      $emprestados = [];
       
      while ( $resultado = pg_fetch_assoc( $query ) ){
        if ( isset($resultado['id']) ){
          $emprestados[] = [
            'id'   => $resultado['id'],
            'titulo'     => $resultado['titulo'],
            'autor'      => $resultado['nome_autor'],
            'editora'    => $resultado['nome_editora'] 
          ];
        }
      }  

  function mostraEmprestimo(){  
   
    $link = include "..\\insere\\conexao.php";

    $query = pg_query("SELECT id, id_aluno 
                       FROM emprestimo
                       ORDER BY id DESC 
                       LIMIT 1");
  
    $emprestimos = [];
  
    while ( $resultado = pg_fetch_assoc( $query ) ){
    $emprestimos[] = [
        'id'   => $resultado['id']
    ];
    }
    foreach ( $emprestimos as $emprestimo){
      
    }return $emprestimo['id'];
  } 
?>
