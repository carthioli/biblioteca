<?php
    
        require "../../vendor/autoload.php";

        use Carlos\Biblioteca\App\Conexao;
        use Carlos\Biblioteca\Mensagem\Mensagem;

        session_start();

        try
            {
              $link = new Conexao;
              
        if ( !empty( $_POST['titulo'] ) && 
              !empty($_POST['id_autor']) && 
               !empty( $_POST['id_editora'] ) ) {

            $inserir = "INSERT INTO livro(nome, id_autor, id_editora) VALUES ('{$_POST['titulo']}', '{$_POST['id_autor']}', '{$_POST['id_editora']}')";
            $inseriu = pg_query( $link->conecta(), $inserir );  
            
            if( pg_affected_rows( $inseriu ) ){
              $msg = (new Mensagem)->mensagensConfirma(3);
              echo json_encode(array( 'message' => $msg, 'erro' => false ));
            }
            else{
              $msg = (new Mensagem)->mensagensErro(3);
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