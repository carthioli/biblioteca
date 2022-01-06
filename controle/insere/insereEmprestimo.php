<?php
    
    
    
    session_start();
    require "../../vendor/autoload.php";
              
    use Carlos\Biblioteca\App\InsereEleitor;
    
   
  
    
        if ( !empty( $_POST['id_aluno'] ) &&
               !empty( $_POST['id_livro'] ) &&
                 !empty( $_POST['dias_devolucao'] ) &&
                   is_numeric( $_POST['id_aluno'] ) &&
                       is_numeric( $_POST['dias_devolucao'] ) ) {

                        
            
 
            $eleitor = new InsereEleitor; 

            echo json_encode( $_POST['id_livro'] );

            /*if( pg_affected_rows( $inseriu ) ){

              $ultimoEmprestimo = mostraEmprestimo();

              foreach($_POST['id_livro'] as $livro){

                insereEmprestimoLivro($livro, $ultimoEmprestimo['id'], $_POST['dias_devolucao'], $ultimoEmprestimo['data_emprestimo']  ); 

              }
                
              //header('location: ../../publico/cadastra/cadastraEmprestimo.php');
              echo json_encode('1');
            }   
            else{
              return false;
            } */
        }else{
          //header('location: ../../publico/cadastra/cadastraEmprestimo.php');
          echo json_encode('2');
        }    
?>