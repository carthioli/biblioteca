<?php

    include 'conexao.php';

    function pegaAutores()
    {

        $query = pg_query("SELECT id,nome, sobrenome, cpf 
                           FROM autor");
        
        $autores = [];
        while( $autor = pg_fetch_assoc($query) )
        {
            $autores[] = $autor;   
        }
        return $autores;

    }    