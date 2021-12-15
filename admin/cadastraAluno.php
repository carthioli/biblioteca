<?php
    
    session_start();
    include "../controle/mensagem.php";
    include "header.php";
    
?>
<?php

    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_GET['page']) && is_numeric( $_GET['page'] ) ) ? $_GET['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $query = pg_query("SELECT id, nome, sobrenome, cpf, telefone
                       FROM aluno 
                       LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
        $alunos = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $alunos[] = [
                    'id'  => $resultado['id'],
                  'nome'  => $resultado['nome'],
             'sobrenome'  => $resultado['sobrenome'],
                   'cpf'  => $resultado['cpf'],
              'telefone'  => $resultado['telefone']
        ];
        }
        
      $sqlContador = pg_query("SELECT COUNT(id) AS total_registros
                              FROM aluno");

      $valor = pg_fetch_assoc( $sqlContador ); 

      $primeira_paginaAutor = 1;

      $ultima_pagina = ceil( $valor['total_registros'] / QTD_RESGISTROS);

      $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

      $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

      $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

      $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

      $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

      $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';

?>

  <title>Cadastra Aluno</title>
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
                    echo "{$mensagem_erro}";
              }
        ?>
      </p>  
      <div class="container col-6 text-center">
        <h4>CADASTRAR ALUNO</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereAluno.php">
          <div class="d-flex flex-column">
            <label class="mb-0 float-left">NOME:</label>
            <p class="text-danger float-left">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" id="nome" name="nome">
            <label class="mb-0">SOBRENOME:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" id="sobrenome" name="sobrenome">
            <label class="mb-0">CPF:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" id="cpf" name="cpf"> 
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone">
            
            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2">
            </div>   
          </div>
        </form>        
  </main>


  <nav>
        <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center">SOBRENOME</th>
                <th class="text-center">CPF</th>
                <th class="text-center">TELEFONE</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
              <tr>
              <?php foreach ( $alunos as $aluno): ?>
                <td class="text-center"><input type="checkbox" name="id_aluno" value="<?php echo $aluno['id'];?>"></td>
                <td class="text-center"><?php echo $aluno['id'];?></td>
                <td><?php echo $aluno['nome'];?></td>
                <td><?php echo $aluno['sobrenome'];?></td>
                <td><?php echo $aluno['cpf'];?></td>
                <td><?php echo $aluno['telefone'];?></td>
                <td class="d-flex justify-content-center border-bottom-0">
                  <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $aluno['id'];?>"/>
                    <input name="editar" type="image" src="../img/editar.png" width="20px">
                  </form> 
                  <form method="POST" action="../controle/remove/removeAluno.php">
                    <input type="hidden" name="id_excluir" value="<?php echo $aluno['id'];?>"/>
                    <input class="float-left" name="excluir" onclick="excluir()" type="image" src="..//img/excluir.png" width="20px">
                  </form>
                </td>   
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
   </nav> 
   <div class="text-center">   
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
            <?php  
              for ($i=$range_inicial; $i < $range_final; $i++):   
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
            ?>   
                <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraAluno.php?page=<?=$i?>"><?=$i?></a> </li>
            <?php endfor; ?>  
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
  <footer>

  </footer>
</body>
</html>
