<?php

session_start();
require "../../vendor/autoload.php";
use Carlos\Biblioteca\App\{
                            Devolucao,
                            Conexao
                          };
use Carlos\Biblioteca\Mensagem\Mensagem;      

if ( !empty( $_POST['id_aluno'] ) &&
      is_numeric( $_POST['id_aluno'] ) ) {
    
        $aluno = $_POST['id_aluno'];

        if(isset($_POST['id_livros'])){
          $id_livros = $_POST['id_livros']; 
          foreach($id_livros AS $livros){
            $devolucao = (new Devolucao)->realizarDevolucao($livros);
          } 
        }
        if(isset($_POST['id_livro'])){
          $id_livros = $_POST['id_livro']; 
          $devolucao = (new Devolucao)->realizarDevolucao($id_livros);
          
        }
           
        
        $msg = (new Mensagem)->mensagensConfirma(9);
        echo json_encode(array('message' => $msg, 'erro' => false));
        
    
}else{
  $msg = (new Mensagem)->mensagensErro(9);
  echo json_encode(array('message' => $msg, 'erro' => true));
} 
/*function devolveLivros($livros){
  foreach( $livros AS $livro ){

  }
  return true;
}*/

?>