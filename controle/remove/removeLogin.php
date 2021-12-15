<?php
    session_start();
        try{
            $link = include "../insere/conexao.php";
    
            if( isset( $_POST['id_excluir'] ) ){

            
                $excluir = "DELETE FROM login WHERE id = ('{$_POST['id_excluir']}')";
                $exclui = pg_query( $link, $excluir );  

                if( pg_affected_rows( $exclui ) ){
                  header('location: ../../admin/cadastraLogin.php');
                  $_SESSION['valida'] = 11;
                }
                else{
                  return false;
                }    
            }else{
              header('location: ../../admin/cadastraLogin.php');
              $_SESSION['erro'] = 14;
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