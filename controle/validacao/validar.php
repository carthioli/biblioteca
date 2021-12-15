<?php

    function validarLogin( $usuario, $senha){

      $sql = ("SELECT l.id, l.id_usuario, l.nivel, l.nome, l.senha, a.nome as nome_usuario, a.sobrenome, a.cpf, a.telefone
      FROM login AS l
      JOIN aluno AS a ON a.id = l.id_usuario
      WHERE l.nome = ('".$usuario."') AND (l.senha = '".$senha."')");

      $query = pg_query( $sql );

      if (pg_num_rows($query) == 1) {
        return true;

      } else {
        return false;
        
      }  
    }