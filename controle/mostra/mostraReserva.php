<?php

      $link = include "../insere/conexao.php";
      
      
    
      function mostraReserva(){  
   
        $link = include "../insere/conexao.php";
    
        $query = pg_query("SELECT id, id_aluno 
                           FROM reserva
                           ORDER BY id DESC 
                           LIMIT 1");
        
        $resultado = pg_fetch_assoc( $query );
        return $resultado;
      
      }

?>