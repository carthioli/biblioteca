<?php

    session_start();  

    include "header.php";
    include "..\\config.php";
    include "..\\controle\\mensagem.php";
    include CONTROLE . "mostra\\mostraLivros.php";
    include CONTROLE . "mostra\\mostraAlunos.php";
    
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
                    session_destroy(); 
                    $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
          </p> 
          <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){  
                    session_destroy(); 
                    $mensagem_confirma = mensagensErro( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
          </p> 
        </div>
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\insere\insereEmprestimo.php">
              <tr>

              <?php foreach ( $livros as $livro):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_livro" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td>   
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
                <button type="submit" class="btn btn-primary">FINALIZAR</button>
              </div>
            </div>
          </div>
        </div>

        </form>
        <div class="text-center">  
          <button onclick="emprestar()" class="btn btn-danger text-body " data-toggle="modal" data-target="#usuario">EMPRESTAR</button>
      
        </div>          
      </div>
    </main>
<footer>
  
</footer>
</body>
</html>