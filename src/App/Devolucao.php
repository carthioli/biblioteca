<?php

    namespace Carlos\Biblioteca\App;

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    class Devolucao
    {
      public function realizarDevolucao($id_livro)
      {
        $link = new Conexao;

        $devolver = "DELETE FROM emprestimo_livro WHERE id_livro = $id_livro ";
        $devolveu = pg_query( $link->conecta(), $devolver ); 

        if( pg_affected_rows( $devolveu ) ){
          return true;
        }
      }
     
    }
    
?>