<?php

    namespace Carlos\Biblioteca\Mensagem;

    class Mensagem{
        function mensagensConfirma( $confirma ){

            switch ( $confirma ){
              case 1:
                return "AUTOR CADASTRADO COM SUCESSO!";
                break;
              case 2:
                return "EDITORA CADASTRADA COM SUCESSO!";
                break;
              case 3:
                return "LIVRO CADASTRADO COM SUCESSO!";
                break; 
              case 4:
                return "ALUNO CADASTRADO COM SUCESSO!";
                break;   
              case 5:
                return "EMPRESTIMO DO LIVRO REALIZADO COM SUCESSO!";
                break;  
              case 6:
                return "LOGIN CADASTRADO COM SUCESSO!";
                break; 
              case 7:
                return "ALUNO EXCLUÍDO COM SUCESSO!";
                break;      
              case 8:
                return "PERFIL ATUALIZADO COM SUCESSO!";
                break; 
              case 9:
                return "LIVRO DEVOLVIDO COM SUCESSO!";  
                break;
              case 10:
                return "RESERVA DO LIVRO REALIZADA COM SUCESSO!";
                break;  
              case 11;
                return "LOGIN REMOVIDO COM SUCESSO!";  
                break;           
            }
      
          }
          function mensagensErro( $erro ){
      
            switch ( $erro ){
              case 1:
                return "Insira um AUTOR VALIDO*";
                break;
              case 2:
                return "Insira uma EDITORA VALIDA*";
                break; 
              case 3:
                return "Insira um LIVRO VALIDO*";
                break;  
              case 4:
                return "Insira um ALUNO VALIDO*";
                break;   
              case 5:
                return "Emprestimo não realizado*";
                break; 
              case 6:
                return "Login não cadastado*";
                break;
              case 7:
                return "Usuário ou senha inválida*";
                break; 
              case 8:
                return "Campos obrigatórios não preenchidos*";
                break;
              case 10:
                return "Reserva não realizada*";
                break;
              case 11:
                return "Livro não devolvido*";
                break;
              case 12:
                return "LOGIN NECESSÁRIO*";
                break;
              case 13:
                return "O ALUNO NÃO PODE SER REMOVIDO*";
                break; 
              case 14:
                return "O LOGIN NÃO PODE SER REMOVIDO*";
                break;                          
              default:
                return "ERRO NÃO CATALOGADO*";   
            }
          }
          function mensagensErroCampo( $erro ){
            switch( $erro ){
              case 1:
                return "As senhas não conferem*";  
                break;
              case 2:
                return "Senha não conferem*";
                break;   
              case 3:
                return "Senha inválida*";
                break;    
              case 4:
                return "Campo obrigatório*";
                break;    
            }
          }
    }
    
?>