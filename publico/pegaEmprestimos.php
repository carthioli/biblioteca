<?php

  function ajudaConverteAvisoParaRotulo( $aviso ){ 
    if( $aviso == "atrasado" )
      return "danger";
    if( $aviso == "-" )
      return 'success';
    return "warning";
  }

  function avaliaDataDevolucao( $data ){

    if( $data > 1 ) // atrasado
      return "atrasado";
    if( $data == 1 ) 
      return "dia da devolucao";
    return "em dia";

  }

  function pegaEmprestimos( $idaluno ){

    $link = include "..\\controle\\insere\\conexao.php";

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, em.data_emprestimo, el.dias_emprestimo, el.data_devolucao
                     FROM emprestimo_livro as el 
                     JOIN livro as l ON l.id = el.id_livro
                     JOIN autor as a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo as em ON em.id = el.id_emprestimo 
                     WHERE em.id_aluno = $idaluno");
                     
    $sqlContador = pg_query("SELECT COUNT(*) AS total_registros
                         FROM livro ");

    
    $valor = pg_fetch_assoc( $sqlContador ); 
      
      $emprestados = [];
       
      while ( $resultado = pg_fetch_assoc( $sql ) ){
        if ( isset($resultado['id']) ){
          $emprestados[] = [
            'id'   => $resultado['id'],
            'titulo'     => $resultado['titulo'],
            'autor'      => $resultado['nome_autor'],
            'editora'    => $resultado['nome_editora'],
    'data_emprestimo'    => $resultado['data_emprestimo'],
    'dias_emprestimo'    => $resultado['dias_emprestimo'],
       'msg_devoluvacao' => avaliaDataDevolucao( $resultado['data_emprestimo'] )
          ];
        }
      }      

      return [
        "emprestados"     => $emprestados,
        "total_registros" => $valor['total_registros']
      ];

  }