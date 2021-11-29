<?php

$link = include "..\\controle\\insere\\conexao.php";
      
      $query = pg_query("SELECT l.id, el.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora
                         FROM emprestimo_livro as el
                         JOIN livro as l on l.id = el.id_livro
                         JOIN autor as a on a.id = l.id_autor 
                         JOIN editora as e on e.id = l.id_editora 
                         WHERE l.id <> el.id_livro
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
    
      
    

?>