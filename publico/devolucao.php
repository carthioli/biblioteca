<?php

    session_start();  

    include "header.php";
    include "..\\config.php";
    include "..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    
?>
<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT l.id, l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora, el.data_emprestimo, el.dias_emprestimo
                     FROM emprestimo_livro as el 
                     JOIN livro as l ON l.id = el.id_livro
                     JOIN autor as a ON a.id = l.id_autor
                     JOIN editora as e ON e.id = l.id_editora
                     JOIN emprestimo as em ON em.id = el.id_emprestimo 
                     WHERE em.id_aluno = {$_SESSION['Id']}");
                     
        $sqlContador = ("SELECT COUNT(*) AS total_registros
                         FROM livro ");

                         $stm = $link->prepare($sqlContador);
                         $stm->execute();
                         $valor = $stm ->fetch(PDO::FETCH_OBJ); 
      
      $emprestados = [];
       
      while ( $resultado = pg_fetch_assoc( $sql ) ){
        if ( isset($resultado['id']) ){
          $emprestados[] = [
            'id'   => $resultado['id'],
            'titulo'     => $resultado['titulo'],
            'autor'      => $resultado['nome_autor'],
            'editora'    => $resultado['nome_editora'],
    'data_emprestimo'    => $resultado['data_emprestimo'],
    'dias_emprestimo'    => $resultado['dias_emprestimo'] 
          ];
        }
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

  <title>Seus emprestimo</title>
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
        <h4>DEVOLVER EMPRESTIMOS</h4>         
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">DATA EMPRESTIMO</th>
                <th class="text-center">DATA ENTREGA</th>
                <th class="text-center">STATUS</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\remove\removeEmprestimo.php">
              <tr>
              <input type="hidden" name=id_aluno value="<?php echo $_SESSION['Id'];?>">
                <?php foreach ( $emprestados as $emprestado ):    
                ?>
                  <td class="text-center"><input type="checkbox" name="id_livro" value="<?php echo $emprestado['id'];?>"></td>
                  <td><?php echo $emprestado['titulo'];?></td>
                  <td><?php echo $emprestado['autor']?></td>
                  <td class="text-center"><?php echo $emprestado['editora'];?></td>
                  <td class="text-center"><?php echo date("d/m/Y", strtotime( $emprestado['data_emprestimo'] ) ); ?></td>
                  <td class="text-center">
                    <?php
                      $data = date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) ));
                      echo $data;       
                    ?>
                 </td>   
                 <td class="text-center">
                 <p class="text-success text-uppercase">
                 <?php
                      if ( date("d/m/Y", strtotime('21-12-2021') ) < date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) )) ){
                        echo "Em dia";
                      }     
                    ?>
                  </p>  
                  <p class="text-warning text-uppercase">
                 <?php
                      if ( date("d/m/Y", strtotime('21-12-2021') ) == date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) )) ){
                        echo "dia da devolução";
                      }     
                    ?>
                  </p>
                  <p class="text-danger text-uppercase">
                 <?php
                      if ( date("d/m/Y", strtotime('21-12-2021')) > date("d/m/Y", strtotime( '+'.$emprestado['dias_emprestimo']. 'days', strtotime($emprestado['data_emprestimo']) )) ){
                        echo "Em atraso";
                      }     
                    ?>
                  </p>
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
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraEmprestimo.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                  <span aria-hidden="true">Primeira</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraEmprestimo.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
              </li>
              <?php  
                for ($i=$range_inicial; $i <= $range_final; $i++):   
                  $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
              ?>   
                  <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraEmprestimo.php?page=<?=$i?>"><?=$i?></a> </li>
              <?php endfor; ?>  
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraEmprestimo.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Próximo</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraEmprestimo.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                  <span aria-hidden="true">Ultima</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>  
        <!--FIM PAGINAÇÃO-->      
        <div class="text-center">  
          <button onclick="emprestar()" class="btn-danger border-0 p-2 rounded" type="submit">DEVOLVER</button>            
        </div>          
      </div>  
      </form>             
    </main>
<footer>
  
</footer>
</body>
</html>