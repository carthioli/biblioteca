<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['nome'] ) && 
            !empty($_POST['sobrenome']) && 
            !empty( $_POST['cpf'] ) && 
            ! is_numeric( $_POST['nome'] ) && 
            ! is_numeric( $_POST['sobrenome'] ) && 
            is_numeric( $_POST['cpf'] ) ) {

            $inserir = "INSERT INTO autor(nome, sobrenome, cpf) VALUES ('{$_POST['nome']}', '{$_POST['sobrenome']}', '{$_POST['cpf']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              header('location: ../../admin/cadastraAutor.php');
              $_SESSION['valida'] = 1;
            }
            else{
              return false;
            }    
        }else{
          header('location: ../../admin/cadastraAutor.php');
          $_SESSION['erro'] = 1;
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