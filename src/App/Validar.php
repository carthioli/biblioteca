<?php

    namespace Carlos\Biblioteca\App;

    use Carlos\Biblioteca\App\InsereSessao;

    class Validar
    { 
        function validarLogin( $usuario, $senha){

            $sql = ("SELECT l.id, l.id_usuario, l.nivel, l.nome, l.senha, a.nome as nome_usuario, a.sobrenome, a.cpf, a.telefone
                    FROM login AS l
                    JOIN aluno AS a ON a.id = l.id_usuario
                    WHERE l.nome = ('".$usuario."') AND (l.senha = '".$senha."')");

            $query = pg_query( $sql );


            if (pg_num_rows($query) == 1) {
                $resultado  = pg_fetch_assoc($query);
                
                if (!isset($_SESSION)) session_start();

                if ( $resultado['nivel'] == 1 ) {
                    $session = (new InsereSessao)->insereSessao($resultado, 1);
                    echo json_encode(array('status' => 1));
                    exit;
                }
                if ( $resultado['nivel'] == 2 ) {
                    $session = (new InsereSessao)->insereSessao($resultado, 2);
                    echo json_encode(array('status' => 2));
                    exit;
                }            
            } else {
                return false;
            }
        }
    }

?>