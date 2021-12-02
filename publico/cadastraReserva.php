<?php

    session_start();  

    include "header.php";
    include "..\\config.php";
    include "..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    
?>
<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, el.data_emprestimos
                     FROM livro as l
                     JOIN autor AS a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo_livro as el ON el.id_livro = l.id
                     LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                    
        $sqlContador = ("SELECT COUNT(*) AS total_registros
                        FROM livro ");

                        $stm = $link->prepare($sqlContador);
                        $stm->execute();
                        $valor = $stm ->fetch(PDO::FETCH_OBJ); 
      $livros = [];

      while ( $resultado = pg_fetch_assoc( $sql ) ){
      $livros[] = [
        'id'       => $resultado['id'],
        'titulo'   => $resultado['titulo'],
        'autor'    => $resultado['nome_autor'],
        'editora'  => $resultado['nome_editora'],
        'data_emprestimo' => $resultado['data_emprestimo']
      ];
      }

      $primeira_pagina = 1;

      $ultima_pagina = ceil( $valor->total_registros / QTD_RESGISTROS);

      $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

      $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

      $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

      $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

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
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\insere\insereReserva.php">
              <tr>

              <?php foreach ( $livros as $livro):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_livro" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td>
                <td class="text-center">
                    <?php
                          $data = date("d/m/Y", strtotime( $livro['data_emprestimo'] ) );
                          echo $data;
                    ?>
                </td>   
              </tr>

              <?php endforeach; ?>

            </tbody>
        </table>

        <div class="modal fade" id="usuario" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">INFORME O ALUNO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">

                
               
                <select name="id_aluno" class="p-1 w-75">
                  <option selected disabled>SELECIONE UM ALUNO...</option>
                  <?php foreach ( $alunos as $aluno ) :    
                ?>
                  <option value="<?php echo $aluno['id'];?>"><?php echo $aluno['nome'];?></option>
                <?php endforeach; ?>
               </select>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">FINALIZAR</button>
              </div>
            </div>
          </div>
        </div>

        </form>
        <nav aria-label="Navegação de página exemplo">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraReserva.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                <span aria-hidden="true">Primeira</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraReserva.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Anterior</span>
              </a>
            </li>
            <?php  
              for ($i=$range_inicial; $i <= $range_final; $i++):   
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
            ?>   
                <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraReserva.php?page=<?=$i?>"><?=$i?></a> </li>
            <?php endfor; ?>  
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraReserva.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Próximo</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraReserva.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                <span aria-hidden="true">Ultima</span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="text-center">  
          <button onclick="emprestar()" class="btn btn-danger text-body " data-toggle="modal" data-target="#usuario">RESERVAR</button>
        </div>          
        
      </div>
    </main>
<footer>
  
</footer>
</body>
</html>