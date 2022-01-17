<?php
    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraReservas(){

      $link = new Conexao;

      $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                          FROM livro AS l
                          JOIN autor AS a ON a.id = l.id_autor
                          JOIN editora AS e ON e.id = l.id_editora
                          ORDER BY 1 ASC");
      $todoslivros = [];

      while ( $resultado = pg_fetch_assoc( $query ) ){
      $todoslivros[] = [
      'id'   => $resultado['id'],
      'titulo' => $resultado['nome'],
      'autor'  => $resultado['autor'],
      'editora'=> $resultado['editora'],
      //'data_livro'=> date("d/m/Y", strtotime($resultado['data_livro']))
      ];
      }
      echo json_encode($todoslivros);
  }return mostraReservas();

  /*function avaliaDataDevolucao( $data_devolucao ){
    $dataAtual = date('d/m/Y');
    if( $dataAtual > $data_devolucao )
      return [
              'status' => 'atrasado',
                 'cor' => 'text-danger'
      ];
    if( $dataAtual == $data_devolucao ) 
      return [
        'status' => 'dia da devolucao',
           'cor' => 'text-warning'
      ];
      if( $dataAtual < $data_devolucao ) 
      return [
        'status' => 'em dia',
           'cor' => 'text-success'
      ];
  }*/
?>