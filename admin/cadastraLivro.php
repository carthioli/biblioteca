<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
    include "..\\controle\\mostra\\mostraAutor.php";
    include "..\\controle\\mostra\\mostraEditora.php";
    include "..\\controle\\mostra\\mostraLivros.php";
?>
<?php
    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
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
  <title>Cadastra Livro</title>
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
        <h4>CADASTRAR LIVRO</h4>
      </div>
  </header>
  <main>
      <div class="container col-3 border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereLivro.php">
          <div class="d-flex flex-column">
            <label class="mb-0">TITULO:</label>
            <input type="text" class="form-control-dark mb-1" id="titulo" name="titulo">
            <div class="mt-1 d-flex flex-column">
            <label class="mb-0">AUTOR:</label>  
              <select id="id_autor" name="id_autor" class="p-1">
                  <option selected disabled>SELECIONE UM AUTOR...</option>
                <?php foreach ( $autores as $autor){    
                ?>
                  <option value="<?php echo $autor['id'];?>"><?php echo $autor['nome'];?></option>
                <?php }?>
              </select>
              <label class="mb-0">EDITORA:</label> 
              <select id="id_editora" name="id_editora" class="p-1">
              <option selected disabled>SELECIONE UMA EDITORA...</option>
                <?php foreach ( $editoras as $editora){    
                ?>
                  <option value="<?php echo $editora['id'];?>"><?php echo $editora['nome'];?></option>
                <?php }?>
            </select>
          </div>  
        </div>
        <div class="text-center">  
          <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
          <input type="button" onclick="cancelarLivro()" value="CANCELAR" class="mt-2"><a href="cadastraLivro.php" ></a>
        </div>          
        </form>
  </main>
        <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
              <tr>
              <?php foreach ( $livros as $livro):    
              ?>
                <td class="text-center"><input type="checkbox" name="id_livro" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td>        
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
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraLivro.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                  <span aria-hidden="true">Primeira</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraLivro.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
              </li>
              <?php  
                for ($i=$range_inicial; $i < $range_final; $i++):   
                  $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
              ?>   
                  <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraLivro.php?page=<?=$i?>"><?=$i?></a> </li>
              <?php endfor; ?>  
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraLivro.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Próximo</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraLivro.php?page=<?=$ultima_pagina?>" aria-label="ultima">
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