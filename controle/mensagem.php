<?php

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
        case 5:
          return "RESERVA DO LIVRO REALIZADA COM SUCESSO!";
          break; 
        case 6:
          return "USUÁRIO CADASTRADO COM SUCESSO!";
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
        case 5:
          return "Reserva não realizada*";
          break;  
        case 6:
          return "Usuário não cadastado*";
          break;
        case 7:
          return "Usuário ou senha inválida*";
          break; 
        case 8:
          return "Campos não preenchidos*";
          break;              
        default:
          return "ERRO NÃO CATALOGADO*";   
      }
    }
    function mensagensErroCampo( $erro ){
      switch( $erro ){
        case 4:
          return "Campo obrigatório*";
          break;
        case 1:
          return "As senhas não conferem*";  
          break;
      }
    }