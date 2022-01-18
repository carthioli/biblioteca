<?php
    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraReservas(){

      $link = new Conexao;

      $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora, r.data_livro, al.nome AS aluno
                          FROM livro AS l
                          JOIN autor AS a ON a.id = l.id_autor
                          JOIN editora AS e ON e.id = l.id_editora
                          JOIN reserva_livro AS rl ON rl.id_livro = l.id
                          JOIN reserva AS r ON r.id = rl.id_reserva
                          JOIN aluno AS al ON al.id = r.id_aluno
                          ORDER BY 1 ASC");
      $todoslivros = [];

      while ( $resultado = pg_fetch_assoc( $query ) ){
      $todoslivros[] = [
                'id' => $resultado['id'],
            'titulo' => $resultado['nome'],
             'autor' => $resultado['autor'],
           'editora' => $resultado['editora'],
      'data_reserva' => date("d/m/Y", strtotime($resultado['data_livro'])),
             'aluno' => $resultado['aluno']
      ];
      }
      echo json_encode($todoslivros);
  }return mostraReservas();

?>