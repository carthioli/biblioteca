<?php

  function definePaginacao(){

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    return;

  }

  function verificaPaginasPesquisa( $pagina_atual, $sqlContador ){

    $valor = pg_fetch_assoc( $sqlContador ); 

    $primeira_pagina = 1;

    $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

    $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

    $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

    $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

    $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

    $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

    $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';
    
    return[
      'range_inicial' => $range_inicial,
        'range_final' => $range_final,
     'proxima_pagina' => $proxima_pagina,
       'pagina_atual' => $pagina_atual,
    'pagina_anterior' => $pagina_anterior,
      'ultima_pagina' => $ultima_pagina
    ];


  }
  function verificaPaginas( $pagina_atual, $sqlContador ){

    $valor = pg_fetch_assoc( $sqlContador ); 

    $primeira_pagina = 1;

    $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

    $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

    $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

    $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

    $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

    $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

    $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';
    
    return[
      'range_inicial' => $range_inicial,
        'range_final' => $range_final,
     'proxima_pagina' => $proxima_pagina,
       'pagina_atual' => $pagina_atual,
    'pagina_anterior' => $pagina_anterior,
      'ultima_pagina' => $ultima_pagina
    ];


  }