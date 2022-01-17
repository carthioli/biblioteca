<?php

    require "../../vendor/autoload.php";  
    
    use Carlos\Biblioteca\App\Conexao;

    function mostraEditoras(){
            
        $link = new Conexao;

        $query = pg_query("SELECT id, nome, telefone 
                        FROM editora
                        ");

        $editoras = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $editoras[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'telefone' => $resultado['telefone']
        ];
        }
        echo json_encode($editoras);
    }return mostraEditoras();
      
?>
