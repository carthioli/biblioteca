<?php
    session_start();

    

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraEmprestimo(){
      
        $aluno = $_SESSION['Id'];

        $link = new Conexao;

        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora, el.data_devolucao, em.data_livro
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            JOIN emprestimo_livro AS el ON el.id_livro = l.id
                            JOIN emprestimo AS em ON em.id = el.id_emprestimo
                            WHERE l.id IN (SELECT el.id_livro 
                                           FROM emprestimo_livro AS el
                                           JOIN emprestimo AS e ON e.id = el.id_emprestimo
                                           WHERE e.id_aluno = $aluno)
                            ORDER BY 1 ASC");
        $todoslivros = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $todoslivros[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora'],
        'data_devolucao'=> date("d/m/Y", strtotime($resultado['data_devolucao'])),
        'data_livro'=> date("d/m/Y", strtotime($resultado['data_livro'])),
        'msg_devolucao' => avaliaDataDevolucao( $resultado['data_devolucao'] )
        ];
        }
        echo json_encode($todoslivros);
    }return mostraEmprestimo();
    
    function avaliaDataDevolucao( $data_devolucao ){
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
    }
?>