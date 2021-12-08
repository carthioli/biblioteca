<?php
    session_start();  

    include "..\\header\\header.php";
    include "..\\..\\config.php";
    include "..\\..\\controle\\mensagem.php";
    include CONTROLE . "insere\\conexao.php";
    include CONTROLE . "mostra\\mostraAlunos.php";

    definePaginacao();

    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                               FROM livro 
                               WHERE id in (SELECT id_livro FROM emprestimo_livro)
                               LIMIT ".QTD_RESGISTROS."");
    
    $paginacao = verificaPaginas( isset($_POST['page']), $sqlContador );

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, em.data_emprestimo, el.dias_emprestimo, el.data_devolucao
                     FROM livro as l
                     JOIN autor AS a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo_livro as el ON el.id_livro = l.id
                     JOIN emprestimo as em ON em.id = el.id_emprestimo
                     WHERE l.id in (SELECT id_livro FROM emprestimo_livro)
                     LIMIT ".QTD_RESGISTROS." OFFSET {$paginacao['linha_inicial']}");

      $livros = [];

      while ( $resultado = pg_fetch_assoc( $sql ) ){
      $livros[] = [
        'id'       => $resultado['id'],
        'titulo'   => $resultado['titulo'],
        'autor'    => $resultado['nome_autor'],
        'editora'  => $resultado['nome_editora'],
        'data_emprestimo' => $resultado['data_emprestimo'],
        'dias_emprestimo' => $resultado['dias_emprestimo'],
        'data_devolucao'  => $resultado['data_devolucao']
      ];
      }
?>