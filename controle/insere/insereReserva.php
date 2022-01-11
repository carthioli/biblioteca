<?php

    session_start();
    require "../../vendor/autoload.php";
    use Carlos\Biblioteca\App\{
                                Reserva,
                                Conexao
                              };
    use Carlos\Biblioteca\Mensagem\Mensagem;      

    if ( !empty( $_POST['id_aluno'] ) &&
           is_numeric( $_POST['id_aluno'] ) ) {
        
       $id_aluno = $_POST['id_aluno'];           
       
        $reserva = (new Reserva)->inserirReserva($id_aluno);
        
        if( $reserva == true ){
          
          $ultimoId = (new Conexao)->ultimoId( 'reserva' );
          
          if( isset( $_POST['id_livros'] ) ){
            $id_livro = $_POST['id_livros'];
            foreach($id_livro AS $livro){
              $reservaLivro = (new Reserva)->inserirReservaLivro( $livro, $ultimoId['id'] );
            }
          }

          if( isset( $_POST['id_livro'] ) ){
            $id_livro[] = $_POST['id_livro'];
            foreach($id_livro AS $livro){
              $reservaLivro = (new Reserva)->inserirReservaLivro( $livro, $ultimoId['id'] );
            }
          }
          
          $msg = (new Mensagem)->mensagensConfirma(10);
          echo json_encode(array('message' => $msg, 'erro' => false));
          
          
        }
    }else{
      $msg = (new Mensagem)->mensagensErro(10);
      echo json_encode(array('message' => $msg, 'erro' => true));
    }   
    function inserirDados($id_livro){
      
    } 
    
?>