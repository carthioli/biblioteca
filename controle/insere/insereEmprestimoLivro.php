<?php

    function insereEmprestimoLivro($id_livro, $ultimoEmprestimo, $dias_devolucao, $data_emprestimo){
      
      $link = include "conexao.php";

      $data = date("Y/m/d", strtotime( '+'.$dias_devolucao. 'days', strtotime($data_emprestimo) ));

      $inserir = "INSERT INTO emprestimo_livro(id_livro, id_emprestimo, dias_emprestimo, data_devolucao) 
                  VALUES ('{$id_livro}', '{$ultimoEmprestimo}', '{$_POST['dias_devolucao']}', '{$data}')";

      $inseriu = pg_query( $link, $inserir ); 
    }

?>