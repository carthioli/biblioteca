<?php

    function insereEmprestimoLivro($id_livro, $ultimoEmprestimo, $dias_devolucao){
      
      $link = include "conexao.php";

      $inserir = "INSERT INTO emprestimo_livro(id_livro, id_emprestimo, dias_emprestimo) 
                  VALUES ('{$_POST['id_livro']}', '{$ultimoEmprestimo}', '{$_POST['dias_devolucao']}')";
      $inseriu = pg_query( $link, $inserir ); 
    }

?>