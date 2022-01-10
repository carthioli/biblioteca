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
        echo json_encode(array( 'id_livro' => $id_livro, 'erro' => false));
        if( $reserva == true ){

          $ultimoId = (new Conexao)->ultimoId();
          
         /* foreach($_POST['id_livro'] as $livro){
            
            $emprestimoLivro = (new Emprestimo)->inserirEmprestimoLivro($livro, $ultimoEmprestimo['id'], $_POST['dias_devolucao'], $ultimoEmprestimo['data_emprestimo']);
             
          } */
          
         

        }
    }else{
      echo json_encode(array('livro' => $id_livro, 'erro' => true));
    }    
    
?>