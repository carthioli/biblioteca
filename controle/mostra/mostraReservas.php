<?php
    
    session_start();
    include "..\..\publico\\telas\\topoAdmin.php";
    include "..\\..\\admin\\headerMostra.php";
    include "..\insere\conexao.php";
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 2 ){
            header('location: ..\\..\\publico\\index.php');
        }
?>

<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, rl.data_reserva 
                     FROM livro as l
                     JOIN autor AS a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN reserva_livro as rl ON rl.id_livro = l.id
                     LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                     
        $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                                 FROM livro
                                 WHERE id in (SELECT id_livro FROM reserva_livro)");

        $valor = pg_fetch_assoc( $sqlContador ); 
      
      $emprestados = [];
       
      while ( $resultado = pg_fetch_assoc( $sql ) ){
        if ( isset($resultado['id']) ){
          $emprestados[] = [
                'id'     => $resultado['id'],
            'titulo'     => $resultado['titulo'],
             'autor'     => $resultado['nome_autor'],
           'editora'     => $resultado['nome_editora'],
              'data'     => $resultado['data_reserva']
          ];
        }
      }  
    $primeira_pagina = 1;

    $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

    $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

    $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

    $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

    $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

    $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

    $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';

  
?>
<title>Reserva</title>
    <main>    
      <div class="container">
        <div class="text-center">
          <p class="text-success">
            <?php
                  if ( isset( $_SESSION['valida'] ) ){  
                       $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                       unset($_SESSION['erro']);
                       unset($_SESSION['valida']);
                       echo "{$mensagem_confirma}";
                  }
            ?>
          </p> 
          <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){ 
                       $mensagem_erro = mensagensErro( $_SESSION['erro'] );
                       unset($_SESSION['valida']);
                       unset($_SESSION['erro']);
                       echo "{$mensagem_erro}";
                  }
            ?>
          </p> 
        </div>
        <h4>LIVROS RESERVADOS</h4>         
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">DATA RESERVA</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\insere\insereEmprestimo.php">
              <tr>
                <?php foreach ( $emprestados as $emprestado ):    
                ?>
                  <td class="text-center"><?php echo $emprestado['id'];?></td>
                  <td><?php echo $emprestado['titulo'];?></td>
                  <td><?php echo $emprestado['autor']?></td>
                  <td class="text-center"><?php echo $emprestado['editora'];?></td>  
                  <td class="text-center">
                  <?php
                          $data = date("d/m/Y", strtotime( $emprestado['data'] ) );
                          echo $data;
                    ?>  
                  </td>  
              </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--PAGINAÇÃO-->
        <div class="text-center">
        <nav aria-label="Navegação de página exemplo">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="mostraReservas.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                <span aria-hidden="true">Primeira</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="mostraReservas.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
              </a>
            </li>
            <?php  
              for ($i=$range_inicial; $i < $range_final; $i++):   
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
            ?>   
                <li class="page-item"><a class='box-numero <?=$destaque?>' href="mostraReservas.php?page=<?=$i?>"><?=$i?></a> </li>
            <?php endfor; ?>  
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="mostraReservas.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="mostraReservas.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                <span aria-hidden="true">Ultima</span>
              </a>
            </li>
          </ul>
        </nav>
        <!--FIM PAGINAÇÃO-->            
      </div>

    </main>
<footer>
  
</footer>
</body>
</html>