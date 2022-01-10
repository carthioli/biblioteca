<?php
    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraEmprestimo(){
        $link = new Conexao;

        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora, el.data_devolucao
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            JOIN emprestimo_livro AS el ON el.id_livro = l.id
                            WHERE l.id IN (SELECT el.id_livro 
                                           FROM emprestimo_livro AS el
                                           JOIN livro AS l ON l.id = el.id_livro
                                           WHERE l.id NOT IN (SELECT id_livro FROM reserva_livro))
                            ORDER BY 1 ASC");
        $todoslivros = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $todoslivros[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora'],
        'data_devolucao'=> date("d/m/Y", strtotime($resultado['data_devolucao']))
        ];
        }
        echo json_encode($todoslivros);
    }return mostraEmprestimo();
?>