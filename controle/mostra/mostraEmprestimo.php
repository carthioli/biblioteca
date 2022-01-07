<?php
    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraEmprestimo(){
        $link = new Conexao;

        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            WHERE l.id NOT IN (SELECT id_livro FROM emprestimo_livro)");
        $todoslivros = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $todoslivros[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora']
        ];
        }
        echo json_encode($todoslivros);
    }return mostraEmprestimo();
?>