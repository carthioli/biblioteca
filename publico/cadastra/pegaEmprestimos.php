<?php

  function avaliaDataDevolucao( $data_emprestimo, $data_devolucao ){
    if( $data_emprestimo > $data_devolucao )
      return [
              'status' => 'atrasado',
                 'cor' => 'danger'
      ];
    if( $data_emprestimo == $data_devolucao ) 
      return [
        'status' => 'dia da devolucao',
           'cor' => 'warning'
      ];
    return [
        'status' => 'em dia',
          'cor' => 'success'
    ];
  }
  function verificaCorDevolucao(){



  }

  function pegaEmprestimos( $idaluno, $pagina_atual, $linha_inicial ){

    $link = include "..\\..\\controle\\insere\\conexao.php";

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, em.data_emprestimo, el.dias_emprestimo, el.data_devolucao
                     FROM emprestimo_livro as el 
                     JOIN livro as l ON l.id = el.id_livro
                     JOIN autor as a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo as em ON em.id = el.id_emprestimo 
                     WHERE em.id_aluno = $idaluno
                     LIMIT ".QTD_RESGISTROS." OFFSET'{$linha_inicial}'");
                     
    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                             FROM livro
                             WHERE id not in (SELECT id_livro FROM emprestimo_livro) ");

    
    $valor = pg_fetch_assoc( $sqlContador ); 
      
      $emprestados = [];
       
      while ( $resultado = pg_fetch_assoc( $sql ) ){
        if ( isset($resultado['id']) ){
          $emprestados[] = [
                 'id' => $resultado['id'],
             'titulo' => $resultado['titulo'],
              'autor' => $resultado['nome_autor'],
            'editora' => $resultado['nome_editora'],
     'data_devolucao' => $resultado['data_devolucao'],
    'data_emprestimo' => $resultado['data_emprestimo'],      
    'dias_emprestimo' => $resultado['dias_emprestimo'],
      'msg_devolucao' => avaliaDataDevolucao( $resultado['data_emprestimo'], $resultado['data_devolucao'] ),
      
          ];
        }
      }      

      return [
        "emprestados"     => $emprestados,
        "total_registros" => $valor['total_registros']
      ];

  }