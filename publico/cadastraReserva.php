<?php

    session_start();  

    include "header.php";
    include "..\\config.php";
    include "..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    include CONTROLE . "insere\\conexao.php";
    
?>
<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, em.data_emprestimo, el.dias_emprestimo, el.data_devolucao
                     FROM livro as l
                     JOIN autor AS a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo_livro as el ON el.id_livro = l.id
                     JOIN emprestimo as em ON em.id = el.id_emprestimo
                     LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");

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

      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                               FROM livro 
                               WHERE id in (SELECT id_livro FROM emprestimo_livro)
                               LIMIT ".QTD_RESGISTROS."");
        
      $valor = pg_fetch_assoc( $sqlContador );

      $primeira_pagina = 1;

      $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

      $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

      $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

      $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

      $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) < $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

      $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

      $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';

?>
  <title>Reserva</title>
</head>
<body>
    <header>
      
    </header>
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
        <h4>RESERVAS DE LIVROS</h4>
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">DISPONÍVEL EM</th>
                <th class="text-center col-1">RESERVAR</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\insere\insereReserva.php">
              <tr>
              <input type="hidden" name=id_aluno value="<?php echo $_SESSION['Id'];?>">
              <?php foreach ( $livros as $livro):    
              ?>
                <td class="text-center"><input type="checkbox" name="id_livro[]" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td>
                <td class="text-center"><?php echo date("d/m/Y", strtotime($livro['data_devolucao'])); ?></td>
                <td class="text-center"><button name="id_livro[]" value="<?php echo $livro['id'];?>" type="submit" class="glyphicon glyphicon-check border-0 bg-transparent"></button></td>   
              </tr>

              <?php endforeach; ?>

            </tbody>
        </table> 
        <div class="text-center">  
          <button type="submit" onclick="emprestar()" class="btn-danger border-0 p-2 rounded text-white ">RESERVAR</button>
        </div>
        </form>     
      </div>
      <!-- PAGINAÇÃO -->
      <div class="text-center">
          <nav aria-label="Navegação de página exemplo">
            <form method="POST" method="cadastraReserva.php">
              <ul class="pagination">
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$primeira_pagina?>" aria-label="primeira">
                    <span aria-hidden="true">Primeira</span>
              </button>
                </li>
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$pagina_anterior?>" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
              </button>
                </li>
                <?php  
                  for ($i=$range_inicial; $i < $range_final; $i++):   
                    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
                ?>   
                    <li class="float-left page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' type="submit" name="page" value="<?=$i?>"><?=$i?></button> </li>
                <?php endfor; ?>  
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$proxima_pagina?>" aria-label="proximo">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próximo</span>
                  </button>
                </li>
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$ultima_pagina?>" aria-label="ultima">
                    <span aria-hidden="true">Ultima</span>
                  </button>
                </li>
              </ul>
            </form>
          </nav>
        </div>
        <!-- FIM PAGINAÇÃO -->
    </main>
<footer>
  
</footer>
</body>
</html>