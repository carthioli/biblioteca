<?php
    $link = include "..\\controle\\insere\\conexao.php";

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);

    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $sql = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                    FROM livro AS l
                    JOIN autor AS a ON a.id = l.id_autor 
                    JOIN editora AS e ON e.id = l.id_editora
                    LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
    $livrosPagina = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
    $livrosPagina[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora']
    ];
    }

    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                             FROM livro 
                             LIMIT ".QTD_RESGISTROS."");
    
    $valor = pg_fetch_assoc( $sqlContador ); 

    $primeira_pagina = 1;

    $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

    $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

    $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

    $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

    $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

    $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

    $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';

?>