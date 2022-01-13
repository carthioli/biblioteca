<?php

require '../../vendor/autoload.php';

use Carlos\Biblioteca\App\{
                           Alterar,
                           Conexao
                          };

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

                    $valida = (new Conexao)->validar($id, $senha_atual);
                   
                    if( $valida == true ){

                      $alteraAluno = (new Alterar)->alterarAluno( $id, $nome, $sobrenome, $telefone );

                    /*  if( $alteraAluno == true ){
                        $alterarPerfil = (new Alterar)->alterarPerfil( $id, $usuario, $senha_confirma );
                      }*/
                      
                    
                      echo json_encode(array( 'nome' => $nome, 'sobrenome' => $sobrenome, 'telefone' => $telefone, 'usuario' => $usuario));
                    }
                    else{
                      echo json_encode('não');
                    }
                      
                 
    }else{
     // header('location: ..\\..\\publico\\altera\\alteraPerfil.php');
      $_SESSION['erro'] = 9;
    }
?>
