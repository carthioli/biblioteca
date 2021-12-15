<?php
    session_start();
        try
            {
              $link = include "../insere/conexao.php";
                      include "../validacao/validar.php";
              
        if ( !empty( $_POST['id'] ) && 
               !empty( $_POST['nome'] ) && 
                 !empty($_POST['sobrenome']) && 
                   !empty($_POST['telefone']) && 
                     !empty($_POST['usuario']) && 
                       !empty($_POST['telefone']) && 
                         !empty($_POST['senha_atual']) ) {


                          $valida = validarLogin( $_POST['usuario'], $_POST['senha_atual']);

                          if ( $valida == true) {
                            $alterarAluno = "UPDATE aluno
                                             SET nome = ('{$_POST['nome']}'), sobrenome = ('{$_POST['sobrenome']}'), telefone = ('{$_POST['telefone']}')
                                             WHERE id = {$_POST['id']}";
                            $alterou = pg_query( $link, $alterarAluno );  

                            $alterarLogin = "UPDATE login
                                             SET nome = ('{$_POST['usuario']}'), senha = ('{$_POST['senha_confirma']}')
                                             WHERE id_usuario = {$_POST['id']}";
                            $alterouLogin = pg_query( $link, $alterarLogin );   

                            if( pg_affected_rows( $alterou ) && pg_affected_rows( $alterouLogin ) ){
                              $_SESSION['usuarioNome'] = $_POST['nome'];
                              $_SESSION['usuarioSobrenome'] = $_POST['sobrenome'];
                              $_SESSION['usuarioTelefone'] = $_POST['telefone'];
                              $_SESSION['usuarioUsuario'] = $_POST['usuario'];
  
                              header('location: ..\\..\\publico\\altera\\alteraPerfil.php');
                              $_SESSION['valida'] = 8;
                            } else {
                              echo $nome;
                            } 
                          }else{
                            header('location: ..\\..\\publico\\altera\\alteraPerfil.php');
                            $_SESSION['erroCampo'] = 3;
                          }
  
          if( $_POST['senha_nova'] != $_POST['senha_confirma'] ){
            header('location: ..\\..\\publico\\altera\\alteraPerfil.php');
            $_SESSION['erroCampo'] = 1;
          } 
        }else{
          header('location: ..\\..\\publico\\altera\\alteraPerfil.php');
          $_SESSION['erro'] = 9;
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