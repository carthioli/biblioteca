<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              include "../mostra/mostraReserva.php";
              include "insereReserva_livro.php";
              
        if ( !empty( $_POST['id_aluno'] ) &&
             !empty( $_POST['id_livro'] ) &&
             is_numeric( $_POST['id_aluno'] ) &&
             is_numeric( $_POST['id_livro'] ) ) {
 
            $inserir = "INSERT INTO reserva(id_aluno) VALUES ('{$_POST['id_aluno']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              $ultimoReserva = mostraReserva();
                               insereReservaLivro($_POST['id_livro'], $ultimoReserva );
                 
                
              header('location: ..\\..\\publico\\cadastraReserva.php');
              $_SESSION['valida'] = 10;
            }
            else{
              return false;
            }    
        }else{
          header('location: ..\\..\\publico\\cadastraReserva.php');
          $_SESSION['erro'] = 10;
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