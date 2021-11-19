<?php
  include 'conexao.php';

  function pegaEditoras(){
    $query=pg_query("SELECT id, nome, telefone
                     FROM editora");
    $editoras = [];
    while ( $editora = pg_fetch_assoc($query) ){
      $editoras[] = $editora;
    }                 
    return $editoras;
  }