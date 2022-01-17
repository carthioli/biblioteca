<?php

    require '../../vendor/autoload.php';

    use Carlos\Biblioteca\App\Conexao;

    function mostraLivros(){
      $link = new Conexao;

      $query = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, em.data_livro
                        FROM livro as l
                        JOIN autor AS a ON a.id = l.id_autor
                        JOIN editora as e ON e.id = l.id_editora
                        JOIN emprestimo_livro as el ON el.id_livro = l.id
                        JOIN emprestimo as em ON em.id = el.id_emprestimo
                        ORDER BY 1 ASC");

      $livros = [];

      while ( $resultado = pg_fetch_assoc( $query ) ){
      $livros[] = [
        'id'       => $resultado['id'],
        'titulo'   => $resultado['titulo'],
        'autor'    => $resultado['nome_autor'],
        'editora'  => $resultado['nome_editora'],
        'data_livro' => $resultado['data_livro']
      ];
      }
      echo json_encode($livros);
    } return mostraLivros();

?>
