<?php
    session_start();  
    include "../paginacao/funPaginacao.php";
    include "../paginacao/paginacaoCadastraEmprestimo.php";  
?>
  <title>Emprestimo</title>
</head>
<body>
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
            
            <tbody>
        <form method="POST" action="..\..\controle\insere\insereEmprestimo.php">
              <tr>
              <input type="hidden" name='id_aluno' value="<?php echo $_SESSION['Id'];?>">
                <?php foreach ( $livros as $livro ):    
                ?>
                  <td class="text-center"><input type="checkbox" name="id_livro[]" value="<?php echo $livro['id'];?>"></td>
                  <td class="text-center"><?php echo $livro['id'];?></td>
                  <td><?php echo $livro['titulo'];?></td>
                  <td><?php echo $livro['autor']?></td>
                  <td class="text-center"><?php echo $livro['editora'];?></td> 
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
                  <?php require "../paginacao/paginacao.php"; ?>
            </form>
        </nav> 
      </div>
      <!--FIM PAGINAÇÃO-->                
    </main>
<footer>
  
</footer>
</body>
</html>