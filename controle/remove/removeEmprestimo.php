<?php
    session_start();
        try{
            $link = include "..\\insere\\conexao.php";
    
            if( isset( $_POST['id_livro'] ) ){

            
                $excluir = "DELETE FROM emprestimo_livro WHERE id_livro = ('{$_POST['id_livro']}')";
                $exclui = pg_query( $link, $excluir );  

                if( pg_affected_rows( $exclui ) ){
                  header('location: ..\\..\\publico\\devolucao.php');
                  $_SESSION['valida'] = 9;
                }
                else{
                  return false;
                }    
            }else{
              header('location: ..\\..\\publico\\devolucao.php');
              $_SESSION['erro'] = 11;
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