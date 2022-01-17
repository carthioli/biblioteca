<?php

    require "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    function mostraAutor(){

        $link = new Conexao;

        $query = pg_query("SELECT id, nome, sobrenome, cpf 
                          FROM autor
                          ORDER BY 1 ASC");

        $autores = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $autores[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'sobrenome' => $resultado['sobrenome'],
            'cpf'  => $resultado['cpf'] 
        ];
        }
        echo json_encode($autores);
    }return mostraAutor();
      
?>
