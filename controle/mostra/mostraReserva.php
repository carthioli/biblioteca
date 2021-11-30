<?php

$link = include "..\\controle\\insere\\conexao.php";
      
      $query = pg_query("SELECT livro.id, livro.nome as titulo, autor.nome as nome_autor, editora.nome as nome_editora
                         FROM livro 
                         JOIN autor on autor.id = livro.id_autor
                         JOIN editora on editora.id = livro.id_editora
                         WHERE livro.id not in (SELECT id_livro FROM emprestimo_livro)
                         ORDER BY 1 ASC");
      
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
    
      function mostraReserva(){  
   
        $link = include "..\\insere\\conexao.php";
    
        $query = pg_query("SELECT id, id_aluno 
                           FROM reserva
                           ORDER BY id DESC 
                           LIMIT 1");
      
        $reservas = [];
      
        while ( $resultado = pg_fetch_assoc( $query ) ){
        $reservas[] = [
            'id'   => $resultado['id']
        ];
        }
        foreach ( $reservas as $reserva){
          
        }return $reserva['id'];
      }
    

?>