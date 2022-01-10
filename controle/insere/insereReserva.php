<?php

    session_start();
    require "../../vendor/autoload.php";
    use Carlos\Biblioteca\App\{
                                Reserva,
                                Conexao
                              };
    use Carlos\Biblioteca\Mensagem\Mensagem;      

    if( isset( $_POST['id_livros'] ) ){
      $id_livro[] = $_POST['id_livros'];
    }
    if( isset( $_POST['id_livro'] ) ){
      $id_livro[] = $_POST['id_livro'];
    }

    if ( !empty( $_POST['id_aluno'] ) &&
            !empty( $id_livro ) &&
                is_numeric( $_POST['id_aluno'] ) ) {
        
       $id_aluno = $_POST['id_aluno'];           
       
        $reserva = (new Reserva)->inserirReserva($id_aluno);
        
        if( $reserva == true ){
          
          $ultimoId = (new Conexao)->ultimoId( 'reserva' );
          
          foreach($_POST['id_livros'] AS $livro){
            $reservaLivro = (new Reserva)->inserirReservaLivro( $livro, $ultimoId['id'] );
            echo json_encode(array('livro' => $reservaLivro, 'erro' => false));
          }
          
          
          
        }
    }else{
      echo json_encode(array('livro' => $id_livro, 'erro' => true));
    }    
    
?>