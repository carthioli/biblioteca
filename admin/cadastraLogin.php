<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraAlunos.php";
    include "header.php";
?>

  <title>Cadastra Aluno</title>
</head>
<body>
  <header>
            <p class="text-success text-center">
            <?php
                  if ( isset( $_SESSION['valida'] ) ){   
                    session_destroy();
                    $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <p class="text-danger text-center">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    session_destroy();
                    $mensagem_confirma = mensagensErro( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
      <div class="container col-6 text-center">
        <h4>CADASTRAR LOGIN</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereAluno.php">
          <div class="d-flex flex-column">
          <select name="id_aluno" class="p-1 w-75">
                  <option selected disabled>SELECIONE UM ALUNO...</option>
                  <?php foreach ( $alunos as $aluno ) :    
                ?>
                  <option value="<?php echo $aluno['id'];?>"><?php echo $aluno['nome'];?></option>
                <?php endforeach; ?>
               </select>  
          
            <label class="mb-0 float-left">NOME:</label>
            <p class="text-danger float-left">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" name="nome">
            <label class="mb-0">SOBRENOME:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" name="sobrenome">
            <label class="mb-0">CPF:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" name="cpf"> 
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" name="telefone">
            
            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraAluno.php" ></a>
            </div>   
          </div>
        </form>        
  </main>
        <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center">SOBRENOME</th>
                <th class="text-center">CPF</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
        
              <tr>

              <?php foreach ( $alunos as $aluno):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_aluno" value="<?php echo $aluno['id'];?>"></td>
                <td class="text-center"><?php echo $aluno['id'];?></td>
                <td><?php echo $aluno['nome'];?></td>
                <td><?php echo $aluno['sobrenome'];?></td>
                <td><?php echo $aluno['cpf'];?></td>
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
  <footer>

  </footer>
</body>
</html>