<?php

    function insereReservaLivro($id_livro, $ultimoReserva){
      
      $link = include "conexao.php";

      $inserir = "INSERT INTO reserva_livro(id_livro, id_reserva) 
                  VALUES ('{$_POST['id_livro']}', '{$ultimoReserva}')";

      $inseriu = pg_query( $link, $inserir ); 
    }

?>