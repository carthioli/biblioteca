<?php

    session_start();  

    include "..\\..\\config.php";
    include "..\\header\\header.php";
    include "..\\..\\controle\\mensagem.php";
    include "..\\paginacao\\funPaginacao.php";
    include "..\\cadastra\\pegaEmprestimos.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";

    $link = include "..\\..\\controle\\insere\\conexao.php";

    definePaginacao();

    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;
    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    [
        "emprestados"     => $emprestados,
        "total_registros" => $total_registros
    ] = 
    pegaEmprestimos( $_SESSION['Id'], isset($_POST['page'] ), $linha_inicial );   

    $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                              FROM livro
                              WHERE id in (SELECT id_livro FROM emprestimo_livro)");


    $paginacao = verificaPaginas( $pagina_atual, $sqlContador );

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
        <form method="POST" action="..\..\controle\remove\removeEmprestimo.php">
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
                 <?php if( $emprestado['msg_devolucao'] == 'em dia' ): ?>  
                    <p class="text-success text-uppercase">   
                 <?php elseif( $emprestado['msg_devolucao'] == 'dia da devolucao' ): ?>
                    <p class="text-warning text-uppercase">
                 <?php elseif( $emprestado['msg_devolucao'] == 'atrasado' ): ?>
                    <p class="text-danger text-uppercase">       
                 <?php endif; ?>
                   <?php echo $emprestado['msg_devolucao']?>
                  </p>  
                 </td>
              </tr>
                <?php endforeach; ?>
            </tbody>
        </table>     
        <div class="text-center">  
          <button onclick="emprestar()" class="btn-danger border-0 p-2 rounded" type="submit">DEVOLVER</button>            
        </div>          
      </div>  
      </form>  
      <!--PAGINAÇÃO-->
      <div class="text-center">  
          <nav aria-label="Navegação de página exemplo">
            <form method="POST" action="devolucao.php">
              <ul class="pagination">
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" name="page" value="<?=$primeira_pagina?>" aria-label="primeira">
                    <span aria-hidden="true">Primeira</span>
                 </button>
                </li>
                <li class="page-item">
                  <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" name="page" value="<?=$paginacao['pagina_anterior']?>" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                 </button>
                </li>
                <?php  
                  for ($i=$paginacao['range_inicial']; $i < $paginacao['range_final']; $i++):   
                    $destaque = ($i == $paginacao['pagina_atual']) ? 'destaque' : '' ;  
                ?>   
                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary  box-numero <?=$destaque?>' name="page" value="<?=$i?>"><?=$i?></button> </li>
                <?php endfor; ?>  
                <li class="float-left page-item">
                  <button class="page-link box-navegacao <?=$exibir_botao_final?>" name="page" value="<?=$paginacao['proxima_pagina']?>" aria-label="proximo">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próximo</span>
                  </button>
                </li>
                <li class="float-left page-item">
                  <button class="page-link box-navegacao <?=$exibir_botao_final?>" name="page" value="<?=$paginacao['ultima_pagina']?>" aria-label="ultima">
                    <span aria-hidden="true">Ultima</span>
                  </button>
                </li>
              </ul>
            </form>
          </nav>
        </div>  
        <!--FIM PAGINAÇÃO-->            
    </main>
<footer>
  
</footer>
</body>
</html>