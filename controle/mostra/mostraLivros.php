<?php

$link = include "..\\insere\\conexao.php";

$query = pg_query("SELECT l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora
                   FROM livro as l
                   JOIN autor AS a ON a.id = l.id_autor
                   JOIN editora as e ON e.id = l.id_editora");

$livros = [];

while ( $resultado = pg_fetch_assoc( $query ) ){
$livros[] = [
  'titulo' => $resultado['titulo'],
  'autor'  => $resultado['nome_autor'],
  'editora'  => $resultado['nome_editora']
];
}
 foreach ( $livros as $livro){    
 
    echo $livro['titulo'];
  }

?>
