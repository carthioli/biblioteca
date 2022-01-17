<?php
    
    require "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;
    use Carlos\Biblioteca\Mensagem\Mensagem;

    session_start();
        try
        {

          $link = new Conexao;
              
          if ( !empty( $_POST['nome'] ) && 
              !empty($_POST['sobrenome']) && 
              !empty( $_POST['cpf'] ) && 
              !empty($_POST['telefone']) && 
              ! is_numeric( $_POST['nome'] ) && 
              ! is_numeric( $_POST['sobrenome'] ) && 
              is_numeric( $_POST['cpf'] ) &&
              is_numeric( $_POST['telefone'] ) ) {

           
              $inserir = "INSERT INTO aluno(nome, sobrenome, cpf, telefone) VALUES ('{$_POST['nome']}', '{$_POST['sobrenome']}', '{$_POST['cpf']}', '{$_POST['telefone']}')";
              $inseriu = pg_query( $link->conecta(), $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              $msg = (new Mensagem)->mensagensConfirma(4);
              echo json_encode(array( 'message' => $msg, 'erro' => false ));
            }
          else{
            $msg = (new Mensagem)->mensagensErro(4);
            echo json_encode(array( 'message' => $msg, 'erro' => true ));
          }    
        }else{
          $msg = (new Mensagem)->mensagensErro(8);
          echo json_encode(array( 'message' => $msg, 'erro' => true ));
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