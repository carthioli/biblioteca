<?php
    namespace Carlos\Biblioteca\App;

    use Carlos\Biblioteca\App\Conexao;

    class Pesquisar{
        
    public function alunoPesquisadoNome($alunos)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT al.id, al.nome, al.sobrenome, al.telefone
                           FROM aluno AS al
                           WHERE al.nome LIKE ('%$alunos%')
                           ORDER BY 1 ASC");
    
        $alunosPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $alunosPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'sobrenome' => $resultadoPesquisado['sobrenome'],
      'telefone' => $resultadoPesquisado['telefone']
        ];
        }
            
        return $alunosPesquisados;    
    }
    public function alunoPesquisadoId($alunos)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT al.id, al.nome, al.sobrenome, al.telefone
                           FROM aluno AS al
                           WHERE al.id IN ('$alunos')");
    
        $alunosPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $alunosPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'sobrenome' => $resultadoPesquisado['sobrenome'],
      'telefone' => $resultadoPesquisado['telefone']
        ];
        }
            
        return $alunosPesquisados;    
    }
    public function autorPesquisadoNome($autores)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT au.id, au.nome, au.sobrenome
                           FROM autor AS au
                           WHERE au.nome LIKE ('%$autores%')
                           ORDER BY 1 ASC");
    
        $autoresPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $autoresPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'sobrenome' => $resultadoPesquisado['sobrenome']
        ];
        }
            
        return $autoresPesquisados;    
    }
    public function autorPesquisadoId($autores)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT au.id, au.nome, au.sobrenome
                           FROM autor AS au
                           WHERE au.id IN ('$autores')");
    
        $autoresPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $autoresPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'sobrenome' => $resultadoPesquisado['sobrenome']
        ];
        }
            
        return $autoresPesquisados;    
    }
    public function editoraPesquisadoNome($editoras)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT e.id, e.nome, e.telefone
                           FROM editora AS e
                           WHERE e.nome LIKE ('%$editoras%')
                           ORDER BY 1 ASC");
    
        $editorasPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $editorasPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'telefone' => $resultadoPesquisado['telefone']
        ];
        }
            
        return $editorasPesquisados;    
    }
    public function editoraPesquisadoId($editoras)
    {
        $link = new Conexao;
    
        $query = pg_query("SELECT e.id, e.nome, e.telefone
                           FROM editora AS e
                           WHERE e.id IN ('$editoras')");
    
        $editorasPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $query ) ){
        $editorasPesquisados[] = [
            'id' => $resultadoPesquisado['id'],
          'nome' => $resultadoPesquisado['nome'],
     'telefone' => $resultadoPesquisado['telefone']
        ];
        }
            
        return $editorasPesquisados;    
    }
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
    public function loginPesquisadoId($login)
    {
        $link = new Conexao;
    
        $queryPesquisado = pg_query("SELECT l.id, l.nome AS user, l.id_usuario, l.nivel, al.nome AS nome
                                     JOIN aluno AS al ON al.id = l.id_aluno
                                     WHERE l.id IN ('$login')
                                     ORDER BY 1 ASC");
    
        $loginsPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
        $loginsPesquisados[] = [
             'id' => $resultadoPesquisado['id_usuario'],
           'nome' => $resultadoPesquisado['user'],
     'nome_aluno' => $resultadoPesquisado['nome'],
          'nivel' => $resultadoPesquisado['nivel']
        ];
        }
            
        return $loginsPesquisados;    
    }
    public function loginPesquisadoNome($login)
    {
        $link = new Conexao;
    
        $queryPesquisado = pg_query("SELECT l.id, l.nome AS user, l.id_usuario, l.nivel, al.nome AS nome
                                     FROM login AS l
                                     JOIN aluno AS al ON al.id = l.id_usuario
                                     WHERE l.nome LIKE ('%$login%')
                                     ORDER BY 1 ASC");
    
        $loginsPesquisados = [];

        while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
        $loginsPesquisados[] = [
            'id' => $resultadoPesquisado['id_usuario'],
          'nome' => $resultadoPesquisado['user'],
    'nome_aluno' => $resultadoPesquisado['nome'],
         'nivel' => $resultadoPesquisado['nivel']
        ];
        }
            
        return $loginsPesquisados;    
    }
    }
?>