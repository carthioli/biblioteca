<?php
    
    session_start();
    require "../../vendor/autoload.php";
              
    use Carlos\Biblioteca\App\{
                               Emprestimo,
                               Conexao
                              };
    use Carlos\Biblioteca\Mensagem\Mensagem;                          
    
    if ( !empty( $_POST['id_aluno'] ) &&
            !empty( $_POST['id_livro'] ) &&
              !empty( $_POST['dias_devolucao'] ) &&
                is_numeric( $_POST['id_aluno'] ) &&
                    is_numeric( $_POST['dias_devolucao'] ) ) {

        $emprestimo = (new Emprestimo)->inserirEmprestimo($_POST['id_aluno']); 
          
        if( $emprestimo == true ){
          
          $ultimoId = (new Conexao)->ultimoId( 'emprestimo' );
          
          foreach($_POST['id_livro'] as $livro){
            
            $emprestimoLivro = (new Emprestimo)->inserirEmprestimoLivro($livro, $ultimoId['id'], $_POST['dias_devolucao'], $ultimoId['data_livro']);
             
          } 
          $msg = (new Mensagem)->mensagensConfirma(5);
          echo json_encode(array('message' => $msg, 'erro' => false));
        }
    }else{
      $msg = (new Mensagem)->mensagensErro(5);
      echo json_encode(array('message' => $msg, 'erro' => true));
    }    
?>