<?php

    namespace Carlos\Biblioteca\App;

    use Carlos\Biblioteca\App\Conexao;

    $link = new Conexao;

    class InsereEleitor
    {
      public function inserirEleitor()
      {
        $inserir = "INSERT INTO emprestimo(id_aluno) VALUES ('{$_POST['id_aluno']}')";
        $inseriu = pg_query( $link, $inserir ); 
      }
    }