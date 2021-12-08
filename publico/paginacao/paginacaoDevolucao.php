<?php

    session_start(); 
    
    include "..\\..\\config.php";
    include "..\\header\\header.php";
    include "..\\..\\controle\\mensagem.php";
    include "..\\cadastra\\pegaEmprestimos.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";

    definePaginacao();

    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                              FROM livro
                              WHERE id in (SELECT id_livro FROM emprestimo_livro)");

    $paginacao = verificaPaginas( isset($_POST['page']), $sqlContador );

    [
      "emprestados"     => $emprestados,
      "total_registros" => $total_registros
  ] = 
  pegaEmprestimos( $_SESSION['Id'], isset($_POST['page'] ), $paginacao['linha_inicial'] );  


?>