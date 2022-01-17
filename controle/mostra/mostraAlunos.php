<?php

    require "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraAlunos(){
        
    $link = new Conexao;
    
    $query = pg_query("SELECT id, nome, sobrenome, cpf, telefone 
                       FROM aluno
                       ORDER BY 1 ASC");

    $alunos = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $alunos[] = [
          'id' => $resultado['id'],
        'nome' => $resultado['nome'],
   'sobrenome' => $resultado['sobrenome'],
         'cpf' => $resultado['cpf'],
    'telefone' => $resultado['telefone']
                ];
    }
        echo json_encode($alunos);
    }return mostraAlunos();
    
      
?>
