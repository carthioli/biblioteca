<?php

    require "../../vendor/autoload.php";
    
    use Carlos\Biblioteca\App\Conexao;
    use Carlos\Biblioteca\Mensagem\Mensagem;

    session_start();
    try
        {
          $link = new Conexao;
          
          if ( isset( $_POST['nivel'] ) && 
                isset($_POST['id_usuario']) && 
                 isset( $_POST['usuario'] ) && 
                  isset($_POST['senha']) && 
                   isset($_POST['confirma_senha']) && 
                    !empty( $_POST['nivel'] ) && 
                     !empty( $_POST['id_usuario'] ) && 
                      !empty( $_POST['usuario'] ) &&
                       !empty( $_POST['senha'] ) &&
                        !empty($_POST['confirma_senha']) ) {
          
                if ( $_POST['senha'] == $_POST['confirma_senha'] ) {

                  $inserir = "INSERT INTO login(nivel, id_usuario, nome, senha) VALUES ('{$_POST['nivel']}', '{$_POST['id_usuario']}', '{$_POST['usuario']}', '{$_POST['senha']}')";
                  $inseriu = pg_query( $link->conecta(), $inserir );   
                      
                  if( pg_affected_rows( $inseriu ) ){
                    $msg = (new Mensagem)->mensagensConfirma(6);
                    echo json_encode(array( 'message' => $msg, 'erro' => false ));
                  }
                  else{
                    $msg = (new Mensagem)->mensagensErro(6);
                    echo json_encode(array( 'message' => $msg, 'erro' => true ));
                  } 
                } else {
                  $msg = (new Mensagem)->mensagensErroCampo(2);
                  echo json_encode(array( 'message' => $msg, 'erro' => true ));
                }  
            }else{
              $msg = (new Mensagem)->mensagensErro(8);
              echo json_encode(array( 'message' => $msg, 'erro' => true ));
            }
          }
          catch( Exception $e )
          {
            echo $e->getMessage();
          }
          catch( Error $e )
          {
            echo $e->getMessage();
          }
?>
