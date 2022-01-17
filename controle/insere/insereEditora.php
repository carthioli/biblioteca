<?php
    /*session_start();
        try
            {
              $link = include "conexao.php";
              
        if ( !empty( $_POST['nome'] ) && 
            !empty($_POST['telefone']) && 
            ! is_numeric( $_POST['nome'] ) && 
            is_numeric( $_POST['telefone'] ) ) {

            
            
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
        }*/
?>
<?php
    
    require "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;
    use Carlos\Biblioteca\Mensagem\Mensagem;

    session_start();
        try
        {

          $link = new Conexao;
              
          if ( !empty( $_POST['nome'] ) && 
              !empty($_POST['telefone']) && 
              ! is_numeric( $_POST['nome'] ) &&
              is_numeric( $_POST['telefone'] ) ) {

           
                $inserir = "INSERT INTO editora(nome, telefone) VALUES ('{$_POST['nome']}', '{$_POST['telefone']}')";
                $inseriu = pg_query( $link->conecta(), $inserir );   
            
            if( pg_affected_rows( $inseriu ) ){
              $msg = (new Mensagem)->mensagensConfirma(2);
              echo json_encode(array( 'message' => $msg, 'erro' => false ));
            }
          else{
            $msg = (new Mensagem)->mensagensErro(2);
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