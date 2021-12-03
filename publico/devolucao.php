<?php

    session_start();  

    include "header.php";
    include "..\\config.php";
    include "pegaEmprestimos.php";
    include "..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    
    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);

    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

            [
                "emprestados"     => $emprestados,
                "total_registros" => $total_registros
            ] = 
            pegaEmprestimos( $_SESSION['Id'] );

              

    
     
          

    $primeira_pagina = 1;
    $ultima_pagina = ceil( $total_registros / QTD_RESGISTROS);
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
                 <p class="text-<?php echo ajudaConverteAvisoParaRotulo( $emprestado['msg_devoluvacao'] )?> text-uppercase">
                   <?php echo $emprestado['msg_devolucao']?>
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
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="devolucao.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                  <span aria-hidden="true">Primeira</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="devolucao.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
              </li>
              <?php  
                for ($i=$range_inicial; $i <= $range_final; $i++):   
                  $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
              ?>   
                  <li class="page-item"><a class='box-numero <?=$destaque?>' href="devolucao.php?page=<?=$i?>"><?=$i?></a> </li>
              <?php endfor; ?>  
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="devolucao.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Próximo</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="devolucao.php?page=<?=$ultima_pagina?>" aria-label="ultima">
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