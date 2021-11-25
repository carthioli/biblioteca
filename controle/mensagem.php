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
      }

    }
    function mensagensErro( $erro ){

      switch ( $erro ){
        case 1:
          return "ERRO: Insira um AUTOR VALIDO!";
          break;
        case 2:
          return "ERRO: Insira uma EDITORA VALIDO!";
          break;  
        default:
          return "ERRO NÃO CATALOGADO!";   
      }

    }