<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              include "../mostra/mostraEmprestimo.php";
              include "insereEmprestimoLivro.php";
              
        if ( !empty( $_POST['id_aluno'] ) &&
             !empty( $_POST['id_livro'] ) &&
             !empty( $_POST['dias_devolucao'] ) &&
             is_numeric( $_POST['id_aluno'] ) &&
             is_numeric( $_POST['id_livro'] ) &&
             is_numeric( $_POST['dias_devolucao'] ) ) {
 
            $inserir = "INSERT INTO emprestimo(id_aluno) VALUES ('{$_POST['id_aluno']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              $ultimoEmprestimo = mostraEmprestimo();
              insereEmprestimoLivro($_POST['id_livro'], $ultimoEmprestimo, $_POST['dias_devolucao'] );
                 
                
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