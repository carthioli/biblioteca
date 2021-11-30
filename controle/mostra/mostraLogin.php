<?php

    $link = include "..\\controle\\insere\\conexao.php";

    $query = pg_query("SELECT id, nivel, id_usuario, nome
                       FROM login   
                       ORDER BY 1 ASC");

    

    $logins = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
    $logins[] = [
      'id'       => $resultado['id'],
      'nivel'     => $resultado['nivel'],  
      'id_usuario'    => $resultado['id_usuario'],
      'usuario'  => $resultado['nome']
    ];
    }
 

?>
