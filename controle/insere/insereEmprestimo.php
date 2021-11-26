<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['id_aluno'] ) && 
             is_numeric( $_POST['id_aluno'] ) ) {

            $inserir = "INSERT INTO emprestimo(id_aluno) VALUES ('{$_POST['id_aluno']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              header('location: ..\\..\\publico\\cadastraEmprestimo.php');
              $_SESSION['valida'] = 5;
            }
            else{
              return false;
            }    
        }else{
         header('location: ..\\..\\publico\\cadastraEmprestimo.php');
          $_SESSION['erro'] = 5;
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