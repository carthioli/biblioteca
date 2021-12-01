<?php
    session_start();
        try{
            $link = include "..\\insere\\conexao.php";
    
            if( isset( $_POST['id_excluir'] ) ){

            
                $excluir = "DELETE FROM aluno WHERE id = ('{$_POST['id_excluir']}')";
                $exclui = pg_query( $link, $excluir );  

                if( pg_affected_rows( $exclui ) ){
                  header('location: ..\\..\\admin\\cadastraAluno.php');
                  $_SESSION['valida'] = 7;
                }
                else{
                  return false;
                }    
            }else{
              header('location: ..\\..\\admin\\cadastraAluno.php');
              $_SESSION['erro'] = 7;
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