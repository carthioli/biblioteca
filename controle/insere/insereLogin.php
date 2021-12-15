<?php
session_start();
    try
        {
          $link = include "conexao.php";
          
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
              $inseriu = pg_query( $link, $inserir );   
                  
              if( pg_affected_rows( $inseriu ) ){
                header('location: ../../admin/cadastraLogin.php');
                $_SESSION['valida'] = 6;
              }
              else{
                return false;
              } 
            } else {
                header('location: ../../admin/cadastraLogin.php');
                $_SESSION['erroCampo'] = 8;
            }  
          }else{
            header('location: ../../admin/cadastraLogin.php');
            $_SESSION['erro'] = 6;
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
