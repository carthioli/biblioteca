<?php
    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraEmprestimos(){

      $link = new Conexao;

      $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora, el.data_devolucao, em.data_livro, al.nome AS aluno
                          FROM livro AS l
                          JOIN autor AS a ON a.id = l.id_autor
                          JOIN editora AS e ON e.id = l.id_editora
                          JOIN emprestimo_livro AS el ON el.id_livro = l.id
                          JOIN emprestimo AS em ON em.id = el.id_emprestimo
                          JOIN aluno AS al ON al.id = em.id_aluno
                          WHERE l.id IN (SELECT id_livro FROM emprestimo_livro)
                          ORDER BY 1 ASC");
      $todoslivros = [];

      while ( $resultado = pg_fetch_assoc( $query ) ){
      $todoslivros[] = [
      'id'   => $resultado['id'],
      'titulo' => $resultado['nome'],
      'autor'  => $resultado['autor'],
      'editora'=> $resultado['editora'],
      'aluno'=> $resultado['aluno'],
      'data_devolucao'=> date("d/m/Y", strtotime($resultado['data_devolucao'])),
      'data_livro'=> date("d/m/Y", strtotime($resultado['data_livro'])),
      'msg_devolucao' => avaliaDataDevolucao( $resultado['data_devolucao'] )
      ];
      }
      echo json_encode($todoslivros);
  }return mostraEmprestimos();

  function avaliaDataDevolucao( $data_devolucao ){
    $dataAtual = date('d/m/Y');
    $data_devolucao = date("d/m/Y", strtotime($data_devolucao));
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
  }
?>