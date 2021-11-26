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
          return "EMPRESTIMO DO LIVRO COM SUCESSO!";
          break;      
      }

    }
    function mensagensErro( $erro ){

      switch ( $erro ){
        case 1:
          return "ERRO: Insira um AUTOR VALIDO!";
          break;
        case 2:
          return "ERRO: Insira uma EDITORA VALIDA!";
          break; 
        case 3:
          return "ERRO: Insira um LIVRO VALIDO!";
          break;  
        case 4:
          return "ERRO: Insira um ALUNO VALIDO!";
          break;   
        case 5:
          return "ERRO: Emprestimo não realizado!";
          break;     
        default:
          return "ERRO NÃO CATALOGADO!";   
      }
    }
    function mensagensErroCampo( $erro ){
      switch( $erro ){
        case 4:
          return "Campo obrigatório*";
          break;
      }
    }