<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              include "../mostra/mostraEmprestimo.php";
              include "insereEmprestimoLivro.php";
              
        if ( !empty( $_POST['id_aluno'] ) &&
               !empty( $_POST['dias_devolucao'] ) &&
                is_numeric( $_POST['id_aluno'] ) &&
                  is_numeric( $_POST['dias_devolucao'] ) ) {
 
            /*
            $livros = $_POST['id_livro'];
            
            foreach( $livros as $livro) {
              $valor1 = $livro;
            }
            */

            $inserir = "INSERT INTO emprestimo(id_aluno) VALUES ('{$_POST['id_aluno']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){

              $ultimoEmprestimo = mostraEmprestimo();

              foreach($_POST['id_livro'] as $livro){

                insereEmprestimoLivro($livro, $ultimoEmprestimo['id'], $_POST['dias_devolucao'], $ultimoEmprestimo['data_devolucao'] ); 

              }
                 
                
               header('location: ..\\..\\publico\\cadastraEmprestimo.php');
              $_SESSION['valida'] = 5;

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