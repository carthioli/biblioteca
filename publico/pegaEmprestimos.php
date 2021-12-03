<?php

  function ajudaConverteAvisoParaRotulo( $aviso ){ 
    if( $aviso == "atrasado" )
      return "danger";
    if( $aviso == "-" )
      return 'success';
    return "warning";
  }

  function avaliaDataDevolucao( $data ){

    if( $data > (date("d/m/Y" ) < date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) ) ) ) ) // atrasado
      return "atrasado";
    if( $data == ( date("d/m/Y" ) < date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) ) ) ) ) 
      return "dia da devolucao";
    return "em dia";

  }

  function pegaEmprestimos( $idaluno ){

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, el.data_emprestimo, el.dias_emprestimo
                     FROM emprestimo_livro as el 
                     JOIN livro as l ON l.id = el.id_livro
                     JOIN autor as a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo as em ON em.id = el.id_emprestimo 
                     WHERE em.id_aluno = $idaluno");
                     
    $sqlContador = ("SELECT COUNT(*) AS total_registros
                         FROM livro ");

    $stm = $link->prepare($sqlContador);
    $stm->execute();
    $valor = $stm->fetch(PDO::FETCH_OBJ); 
      
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
       'msg_devoluvacao' => avaliaDataDevolucao( $resultado['data_devolucao'] )
          ];
        }
      }      

      return [
        "emprestados"     => $emprestados,
        "total_registros" => $valor->total_registros
      ];

  }