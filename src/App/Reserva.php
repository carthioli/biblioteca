<?php

    namespace Carlos\Biblioteca\App;

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    class Reserva
    {
      public function inserirReserva($id_aluno)
      {
        $link = new Conexao;

        $inserir = "INSERT INTO reserva(id_aluno) VALUES ($id_aluno)";
        $inseriu = pg_query( $link->conecta(), $inserir ); 

        if( pg_affected_rows( $inseriu ) ){
          return true;
        }
      }
      function inserirReservaLivro( $id_livro, $id_reserva ){
        $link = new Conexao;

          $inserir = "INSERT INTO reserva_livro(id_livro, id_reserva) 
                      VALUES ('{$id_livro}', '{$id_reserva}')";
          $inseriu = pg_query( $link->conecta(), $inserir ); 

          if( pg_affected_rows( $inseriu ) ){
            return '4444';
          }
      }
    }
    
?>