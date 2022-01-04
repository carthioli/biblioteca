<?php   
        include "telas/topo.php";
        include "header/headerP.php";  
        include "../vendor/autoload.php";

        use Carlos\Biblioteca\App\Conexao;

        $link = new Conexao;

        define('RANGE_PAGINAS', 1);
        define('QTD_RESGISTROS', 5);
        $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;
    
        $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;
    
        $query = pg_query("SELECT l.id, l.nome AS titulo, a.nome AS nome_autor, e.nome AS nome_editora
                           FROM livro AS l 
                           JOIN autor AS a ON a.id = l.id_autor
                           JOIN editora AS e ON e.id = l.id_editora
                           LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
        $livros = [];
    
        while ( $resultado = pg_fetch_assoc( $query ) ){
            $livros[] = [
                  'id'  => $resultado['id'],
              'titulo'  => $resultado['titulo'],
               'autor'  => $resultado['nome_autor'],
             'editora'  => $resultado['nome_editora']
        ];
        }
            
        $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                                 FROM livro");
    
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
    <title>Biblioteca Digital</title>
<body>
    <main>
        <div class="container">
            <div class="p-5 mt-3 mb-5 border-bottom">
            </div>
        </div>
        <div class="grid">
          <div class="grid-item ml-5 mr-5 border-left g1">
            <div class="d-flex justify-content-center mt-5 rounded">
              <form>
                <input class="p-1 float-left" type="text" name="pesquisar" id="txPesquisar" placeholder="Pesquisar livros...">
                <button class="text-decoration-none text-body glyphicon glyphicon-search col-1 b border-0 mt-2 float-left" id="pesquisar"></button>
              </form>
            </div>
          </div>
          <div class="grid-item ml-5 border-right g2">
            <table id="tabela" class="d-none">
                <button type="button" name="fechar" class="close d-none"><span aria-hidden="true">&times;</span></button>
                <thead>
                    <th class="center">ID</th>
                    <th>TITULO</th>
                    <th>AUTOR</th>
                    <th>EDITORA</th>
                </thead>
                <tbody id="mostrar">

                </tbody>
            </table>


            <div class="d-none" id="paginacao">   
              <nav aria-label="Navegação de página exemplo">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraAluno.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                      <span aria-hidden="true">Primeira</span>
                    </a>
                  </li>
                  <li class="page-item">
                    <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraAluno.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Anterior</span>
                    </a>
                  </li>
                  
                      <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraAluno.php?page=">1</a> </li>
                  
                  <li class="page-item">
                    <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraAluno.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Próximo</span>
                    </a>
                  </li>
                  <li class="page-item">
                    <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraAluno.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                      <span aria-hidden="true">Ultima</span>
                    </a>
                  </li>
                </ul>
              </nav> 
            <div>   






            
          </div>
        </div>
    </main>

    <script src="../javascript/script.js"></script>

</body>
</html>
   
