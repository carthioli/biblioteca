<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
?>
<?php
    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT id, nome, telefone 
                    FROM editora
                    LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                    
    $sqlContador = ("SELECT COUNT(*) AS total_registros
                    FROM editora ");

    $stm = $link->prepare($sqlContador);
    $stm->execute();
    $valor = $stm ->fetch(PDO::FETCH_OBJ); 

    $editoras = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
    $editoras[] = [
        'id'   => $resultado['id'],
        'nome' => $resultado['nome'],
        'telefone' => $resultado['telefone']
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
  <title>Cadastra Editora</title>
</head>
<body>
  <header>
      <p class="text-success text-center">
        <?php
              if ( isset( $_SESSION['valida'] ) ){  
                    $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                    unset($_SESSION['erro']);
                    unset($_SESSION['valida']);
                    echo "{$mensagem_confirma}";
              }
        ?>
      </p> 
      <p class="text-danger text-center">
        <?php
              if ( isset( $_SESSION['erro'] ) ){ 
                    $mensagem_erro = mensagensErro( $_SESSION['erro'] );
                    unset($_SESSION['valida']); 
                    unset($_SESSION['erro']);        
                    echo "{$mensagem_erro}";
              }
        ?>
      </p> 
      <div class="container col-6 text-center">
        <h4>CADASTRAR EDITORA</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereEditora.php">
          <div class="d-flex flex-column">
            <label>NOME:</label>
            <input type="text" class="form-control-dark" id="nome" name="nome">
            <label>TELEFONE:</label>
            <input type="text" class="form-control-dark" id="telefone" name="telefone"> 
          </div>  
          <div class="text-center">  
            <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
            <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraEditora.php" ></a>
          </div>        
        </div>
       </form>
  </main>
        <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th class="col-1"></th>
                <th class="text-center col-1">ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center" col-2>TELEFONE</th>
                <th class="text-center col-2">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
              <tr>
              <?php foreach ( $editoras as $editora): ?>
                <td class="text-center"><input type="checkbox" name="id_editora" value="<?php echo $editora['id'];?>"></td>
                <td class="text-center"><?php echo $editora['id'];?></td>
                <td><?php echo $editora['nome'];?></td>
                <td class="col-2 text-center"><?php echo $editora['telefone'];?></td>
                <td class="d-flex justify-content-center border-bottom-0">
                  <form method="GET" action="../controle/remove/removeLivro.php">
                    <input type="hidden" name="id_excluir" value="<?php echo $livro['id'];?>"/>
                    <input class="float-left" name="excluir" onclick="excluir()" type="image" src="..//img/excluir.png" width="20px">
                  </form>
                </td>   
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center">   
          <nav aria-label="Navegação de página exemplo">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraEditora.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                  <span aria-hidden="true">Primeira</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraEditora.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
              </li>
              <?php  
                for ($i=$range_inicial; $i <= $range_final; $i++):   
                  $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
              ?>   
                  <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraEditora.php?page=<?=$i?>"><?=$i?></a> </li>
              <?php endfor; ?>  
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraEditora.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Próximo</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraEditora.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                  <span aria-hidden="true">Ultima</span>
                </a>
              </li>
            </ul>
          </nav> 
        <div>   
  <footer>

  </footer>
</body>
</html>