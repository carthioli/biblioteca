<?php
    namespace Carlos\Biblioteca\App;

    use Carlos\Biblioteca\App\Conexao;

    class Pesquisar{
        
    public function livroPesquisadoId($livro)
    {
        $link = new Conexao;
    
        $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            WHERE l.id IN ('$livro')
                            ORDER BY 1 ASC");
    
        $livrosPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
        $livrosPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
        'titulo' => $resultadoPesquisado['nome'],
        'autor' => $resultadoPesquisado['autor'],
        'editora' => $resultadoPesquisado['editora']
        ];
        }
            
        return $livrosPesquisados;    
    }
    public function livroPesquisadoNome($livro)
    {
        $link = new Conexao;
    
        $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            WHERE l.nome LIKE ('%$livro%')
                            ORDER BY 1 ASC");
    
        $livrosPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
        $livrosPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
        'titulo' => $resultadoPesquisado['nome'],
        'autor' => $resultadoPesquisado['autor'],
        'editora' => $resultadoPesquisado['editora']
        ];
        }
            
        return $livrosPesquisados;    
    }

    public function livroAlunoNome($livro)
    {
        $link = new Conexao;
    
        $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                            FROM livro AS l
                            JOIN autor AS a ON a.id = l.id_autor
                            JOIN editora AS e ON e.id = l.id_editora
                            WHERE l.nome LIKE ('%$livro%')
                            ORDER BY 1 ASC");
    
        $livrosPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
        $livrosPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
        'titulo' => $resultadoPesquisado['nome'],
        'autor' => $resultadoPesquisado['autor'],
        'editora' => $resultadoPesquisado['editora']
        ];
        }
            
        return $livrosPesquisados;    
    }

    }

?>