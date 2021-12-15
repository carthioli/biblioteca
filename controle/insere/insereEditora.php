<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['nome'] ) && 
            !empty($_POST['telefone']) && 
            ! is_numeric( $_POST['nome'] ) && 
            is_numeric( $_POST['telefone'] ) ) {

            $inserir = "INSERT INTO editora(nome, telefone) VALUES ('{$_POST['nome']}', '{$_POST['telefone']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              header('location: ../../admin/cadastraEditora.php');
              $_SESSION['valida'] = 2;
            }
            else{
              return false;
            }    
        }else{
          header('location: ../../admin/cadastraEditora.php');
          $_SESSION['erro'] = 2;
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