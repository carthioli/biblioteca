<?php

    $link = include "../controle/insere/conexao.php";

    $usuario = $_SESSION['usuarioId'];

    $query = pg_query("SELECT id, id_usuario, nome, senha
                      FROM login
                      WHERE id_usuario = $usuario");
    
    $alunos = [];

    while ( $resultado = pg_fetch_assoc( $query ) ){
        $alunos = [
            'usuario'      => $resultado['id_usuario'],
            'nome'      => $resultado['nome'],
            'senha'      => $resultado['senha'],
        ];
    }
    foreach ( $alunos AS $aluno ) {

    }

?>