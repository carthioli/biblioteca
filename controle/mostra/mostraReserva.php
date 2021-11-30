<?php

      $link = include "..\insere\conexao.php";
      
      
    
      function mostraReserva(){  
   
        $link = include "..\\insere\\conexao.php";
    
        $query = pg_query("SELECT id, id_aluno 
                           FROM reserva
                           ORDER BY id DESC 
                           LIMIT 1");
      
        $reservas = [];
      
        while ( $resultado = pg_fetch_assoc( $query ) ){
        $reservas[] = [
            'id'   => $resultado['id']
        ];
        }
        foreach ( $reservas as $reserva){
          
        }return $reserva['id'];
      }
    

?>