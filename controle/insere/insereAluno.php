<?php
    session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['nome'] ) && 
             !empty($_POST['sobrenome']) && 
             !empty( $_POST['cpf'] ) && 
             !empty($_POST['telefone']) && 
             ! is_numeric( $_POST['nome'] ) && 
             ! is_numeric( $_POST['sobrenome'] ) && 
             is_numeric( $_POST['cpf'] ) &&
             is_numeric( $_POST['telefone'] ) ) {

             
           
            $inserir = "INSERT INTO aluno(nome, sobrenome, cpf, telefone) VALUES ('{$_POST['nome']}', '{$_POST['sobrenome']}', '{$_POST['cpf']}', '{$_POST['telefone']}')";
            $inseriu = pg_query( $link, $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              header('location: ..\\..\\admin\\cadastraAluno.php');
              $_SESSION['valida'] = 4;
            }
            else{
              return false;
            }    
        }else{
          header('location: ..\\..\\admin\\cadastraAluno.php');
          $_SESSION['erro'] = 4;
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