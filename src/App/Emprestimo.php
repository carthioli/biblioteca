<?php

    namespace Carlos\Biblioteca\App;

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    class Emprestimo
    {
      public function inserirEmprestimo($id_aluno)
      {
        $link = new Conexao;

        $inserir = "INSERT INTO emprestimo(id_aluno) VALUES ($id_aluno)";
        $inseriu = pg_query( $link->conecta(), $inserir ); 

        if( pg_affected_rows( $inseriu ) ){
          return true;
        }
      }
      function inserirEmprestimoLivro($id_livro, $ultimoEmprestimo, $dias_devolucao, $data_emprestimo){
      
        $link = new Conexao;
  
        $data = date("Y/m/d", strtotime( '+'.$dias_devolucao. 'days', strtotime($data_emprestimo) ));
  
        $inserir = "INSERT INTO emprestimo_livro(id_livro, id_emprestimo, dias_emprestimo, data_devolucao) 
                    VALUES ('{$id_livro}', '{$ultimoEmprestimo}', '{$dias_devolucao}', '{$data}')";
        $inseriu = pg_query( $link->conecta(), $inserir ); 

        
          return true;
        
      }
    }