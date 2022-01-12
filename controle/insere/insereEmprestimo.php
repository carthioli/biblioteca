<?php
    
    session_start();
    require "../../vendor/autoload.php";
              
    use Carlos\Biblioteca\App\{
                               Emprestimo,
                               Conexao
                              };
    use Carlos\Biblioteca\Mensagem\Mensagem;                          
    
    
    if ( !empty( $_POST['id_aluno'] ) &&
              is_numeric( $_POST['id_aluno'] ) ) {

        $emprestimo = (new Emprestimo)->inserirEmprestimo($_POST['id_aluno']); 
          
        if( $emprestimo == true ){
          
          $ultimoId = (new Conexao)->ultimoId( 'emprestimo' );
          
          if( !empty( $_POST['id_livro'] ) ){
            $id_livro[] = $_POST['id_livro'];
            foreach($id_livro AS $livro){
              $emprestimoLivro = (new Emprestimo)->inserirEmprestimoLivro($livro, $ultimoId['id'], $_POST['dias_devolucao'], $ultimoId['data_livro']);
            }
          }
          if( isset( $_POST['id_livros'] ) ){
            $id_livro = $_POST['id_livros'];
            foreach($id_livro AS $livro){
              $emprestimoLivro = (new Emprestimo)->inserirEmprestimoLivro($livro, $ultimoId['id'], $_POST['dias_devolucao'], $ultimoId['data_livro']);
            }
          }
              
            
          
          
          $msg = (new Mensagem)->mensagensConfirma(5);
            echo json_encode(array('message' => $msg, 'erro' => false));
        }
    }else{
      $msg = (new Mensagem)->mensagensErro(5);
      echo json_encode(array('message' => $msg, 'erro' => true));
    }   
?>