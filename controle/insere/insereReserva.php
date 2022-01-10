<?php

    session_start();
    require "../../vendor/autoload.php";
    use Carlos\Biblioteca\App\{
                                Reserva,
                                Conexao
                              };
    use Carlos\Biblioteca\Mensagem\Mensagem;      

    if( isset( $_POST['id_livros'] ) ){
      $id_livro = $_POST['id_livros'];
    }
    if( isset( $_POST['id_livro'] ) ){
      $id_livro = $_POST['id_livro'];
    }

    if ( !empty( $_POST['id_aluno'] ) &&
            !empty( $id_livro ) &&
                is_numeric( $_POST['id_aluno'] ) ) {
        
       $id_aluno = $_POST['id_aluno'];           

        $reserva = (new Reserva)->inserirReserva($id_aluno);
          
        if( $reserva == true ){

          $ultimaReserva = (new Conexao)->ultimoIdReserva();
          
         /* foreach($_POST['id_livro'] as $livro){
            
            $emprestimoLivro = (new Emprestimo)->inserirEmprestimoLivro($livro, $ultimoEmprestimo['id'], $_POST['dias_devolucao'], $ultimoEmprestimo['data_emprestimo']);
             
          } */
          
         $msg = (new Mensagem)->mensagensConfirma(5);
         echo json_encode(array('ultimoId' => $ultimaReserva, 'id_livro' => $id_livro, 'message' => $msg, 'erro' => false));

        }
    }else{
      $msg = (new Mensagem)->mensagensErro(5);
      echo json_encode(array('livro' => $id_livro, 'message' => $msg, 'erro' => true));
    }    
    
?>