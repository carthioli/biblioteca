<?php

    session_start();

    require "../../vendor/autoload.php";

    use Carlos\Biblioteca\Mensagem\Mensagem;
    use Carlos\Biblioteca\App\{
                               Conexao,
                               Validar  
                              };
    

    if ( !empty( $_POST['usuario'] ) && !empty( $_POST['senha'] )){

      $usuario = $_POST['usuario'];
      $senha   = $_POST['senha'];
      
      $link = new Conexao;
      $validar = (new Validar)->validarLogin($usuario, $senha);
      
      if ( $validar == false ){
        $msg = (new Mensagem)->mensagensErro(7);
        echo json_encode(array('message' => $msg, 'color' => 'red'));
      }

    }else{
      $msg = (new Mensagem)->mensagensErro(8);
      echo json_encode(array('message' => $msg, 'color' => 'red'));
    }
      
?>
