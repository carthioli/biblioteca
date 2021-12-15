<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['titulo'] ) && 
            !empty($_POST['id_autor']) && 
            !empty( $_POST['id_editora'] ) ) {

            $inserir = "INSERT INTO livro(nome, id_autor, id_editora) VALUES ('{$_POST['titulo']}', '{$_POST['id_autor']}', '{$_POST['id_editora']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              header('location: ../../admin/cadastraLivro.php');
              $_SESSION['valida'] = 3;
            }
            else{
              return false;
            }    
        }else{
          header('location: ../../admin/cadastraLivro.php');
          $_SESSION['erro'] = 3;
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