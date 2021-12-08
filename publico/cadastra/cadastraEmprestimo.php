<?php

    session_start();  

    include "..\\header\\header.php";
    include "..\\..\\config.php";
    include "..\\..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraEmprestimo.php";
    $link = include "..\\..\\controle\\insere\\conexao.php";
    
    
?>
<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $sql = pg_query("SELECT livro.id, livro.nome as titulo, autor.nome as nome_autor, editora.nome as nome_editora
                         FROM livro 
                         JOIN autor on autor.id = livro.id_autor
                         JOIN editora on editora.id = livro.id_editora
                         WHERE livro.id not in (SELECT id_livro FROM emprestimo_livro)
                         LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
    $emprestados = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
      if ( isset($resultado['id']) ){
        $emprestados[] = [
          'id'   => $resultado['id'],
          'titulo'     => $resultado['titulo'],
          'autor'      => $resultado['nome_autor'],
          'editora'    => $resultado['nome_editora'] 
        ];
      }
    } 
        
      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                              FROM livro
                              WHERE id not in (SELECT id_livro FROM emprestimo_livro) 
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
<?php

    if( isset( $_POST['pesquisar'] ) ){
      $titulo = $_POST['pesquisar'];
      $pesquisa = true;

      $queryPesquisado = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                      FROM livro AS l
                      JOIN autor AS a ON a.id = l.id_autor
                      JOIN editora AS e ON e.id = l.id_editora
                      WHERE l.nome LIKE  '%$titulo%'");

      $livrosPesquisados = [];

      while( $resultadoPesquisado = pg_fetch_assoc( $queryPesquisado ) ){
      $livrosPesquisados[] = [
          'id' => $resultadoPesquisado['id'],
      'titulo' => $resultadoPesquisado['nome'],
      'autor' => $resultadoPesquisado['autor'],
      'editora' => $resultadoPesquisado['editora']
      ];
      }
    }   

?>

  <title>Emprestimo</title>
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
        <h4>EMPRESTIMOS DE LIVROS</h4>         
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="col-1"></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
              </tr>  
            </thead>
            <?php if( empty( $_POST['pesquisar'] ) ): ?>
            <tbody>
        <form method="POST" action="..\..\controle\insere\insereEmprestimo.php">
              <tr>
              <input type="hidden" name='id_aluno' value="<?php echo $_SESSION['Id'];?>">
                <?php foreach ( $emprestados as $emprestado ):    
                ?>
                  <td class="text-center"><input type="checkbox" name="id_livro[]" value="<?php echo $emprestado['id'];?>"></td>
                  <td class="text-center"><?php echo $emprestado['id'];?></td>
                  <td><?php echo $emprestado['titulo'];?></td>
                  <td><?php echo $emprestado['autor']?></td>
                  <td class="text-center"><?php echo $emprestado['editora'];?></td> 
              </tr>
                <?php endforeach; ?>
            </tbody>
            <?php endif; ?>
            <?php if( !empty( $_POST['pesquisar'] ) ): ?>
            <tbody>
            <form method="POST" action="..\controle\insere\insereEmprestimo.php">
              <tr>
              <input type="hidden" name='id_aluno' value="<?php echo $_SESSION['Id'];?>">
                <?php foreach ( $livrosPesquisados as $livroPesquisado ):    
                ?>
                  <td class="text-center"><input type="checkbox" name="id_livro[]" value="<?php echo $livroPesquisado['id'];?>"></td>
                  <td class="text-center"><?php echo $livroPesquisado['id'];?></td>
                  <td><?php echo $livroPesquisado['titulo'];?></td>
                  <td><?php echo $livroPesquisado['autor']?></td>
                  <td class="text-center"><?php echo $livroPesquisado['editora'];?></td>   
                  
              </tr>
                <?php endforeach; ?>
            </tbody>
            <?php endif; ?>
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
                <select  name="dias_devolucao" class="mt-2 p-1 w-75">
                  <option selected disabled>SELECIONE UMA DATA...</option>
                  <option>3</option>
                  <option>5</option>
                  <option>7</option>
                  <option>14</option>
                  <option>21</option>
                </select>      
                </div>
                <div class="modal-footer">
                  <button href="cadastraEmprestimo.php" class="btn-danger border-0 p-2 rounded">CANCELAR</button>
                  <button type="submit" class="btn-primary border-0 p-2 rounded">FINALIZAR</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="text-center">  
          <button onclick="emprestar()" class="btn-danger border-0 p-2 rounded" data-toggle="modal" data-target="#usuario">EMPRESTAR</button>            
        </div>          
      </div>
      <!--PAGINAÇÃO-->
      <div class="text-center">
        <nav aria-label="Navegação de página exemplo">
            <form method="POST" action="cadastraEmprestimo.php">
            <ul class="pagination">
                <li class="page-item">
                <input type="hidden" name="livro">
                <input type="hidden" name="pesquisar">    
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
                    $destaque = ($i == $pagina_atual);  
                ?>   
                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                <?php endfor; ?>  
                <li class="page-item">
                <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$proxima_pagina?>" aria-label="proximo">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próximo</span>
                </button>
                </li>
                <li class="page-item">
                <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" name="page" type="submit" value="<?=$ultima_pagina?>" aria-label="ultima">
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