<?php

require '../../vendor/autoload.php';

use Carlos\Biblioteca\App\{
                           Alterar,
                           Conexao
                          };
use Carlos\Biblioteca\Mensagem\Mensagem;                          

session_start();
          
    if ( !empty( $_POST['id'] ) && 
           !empty( $_POST['nome'] ) && 
             !empty($_POST['sobrenome']) && 
               !empty($_POST['telefone']) && 
                 !empty($_POST['usuario']) ) {

                    $id = $_POST['id'];
                    $nome = $_POST['nome'];
                    $sobrenome = $_POST['sobrenome'];
                    $telefone = $_POST['telefone'];
                    $usuario = $_POST['usuario'];
                    $senha_atual = $_POST['senha_atual'];
                    $senha_nova = $_POST['senha_nova'];
                    $senha_confirma = $_POST['senha_confirma'];    

                    

                    if ( $senha_nova == $senha_confirma ){
                      $valida = (new Conexao)->validar($id, $senha_atual);
                      if( $valida == true ){

                        $alteraAluno = (new Alterar)->alterarAluno( $id, $nome, $sobrenome, $telefone );

                        $alterarPerfil = (new Alterar)->alterarPerfil( $id, $usuario, $senha_confirma );                      
                      
                        $msg = (new Mensagem)->mensagensConfirma(8);
                        echo json_encode(array( 'message' => $msg, 'erro' => false, 'aluno' => $alteraAluno, 'perfil' => $alterarPerfil ));
                      }
                      else{
                        $msg = (new Mensagem)->mensagensErro(3);
                        echo json_encode(array('message' => $msg, 'erro' => true));
                      }
                    }else{
                      $msg = (new Mensagem)->mensagensErroCampo(2);
                      echo json_encode(array('message' => $msg, 'erro' => true));
                    }
       
              
    }else{
      $msg = (new Mensagem)->mensagensErroCampo(4);
      echo json_encode(array('message' => $msg, 'erro' => true));
    }
?>
