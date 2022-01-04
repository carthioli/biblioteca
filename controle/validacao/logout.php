<?php
    if(isset($_POST['sair'])){
        session_start();

        if ( $_SESSION['logado'] == 1 || $_SESSION['logado'] == 2 ){
            session_destroy();
            echo json_encode(array('sair' => 'sair'));
        }
    }

?>