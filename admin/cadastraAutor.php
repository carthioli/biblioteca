<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraAutor.php";
    include "header.php";
?>

  <title>Cadastra Autor</title>
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
        <h4>CADASTRAR AUTOR</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereAutor.php">
          <div class="d-flex flex-column">
            <label class="mb-0">NOME:</label>
            <input type="text " class="form-control-dark" name="nome">
            <label class="mb-0 mt-2">SOBRENOME:</label>
            <input type="text" class="form-control-dark" name="sobrenome">
            <label class="mb-0 mt-2">CPF:</label>
            <input type="text" class="form-control-dark mb-3" name="cpf">
          </div>
          <div class="text-center">  
            <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
            <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraAutor.php" ></a>
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
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
        
              <tr>

              <?php foreach ( $autores as $autor):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_autor" value="<?php echo $autor['id'];?>"></td>
                <td class="text-center"><?php echo $autor['id'];?></td>
                <td><?php echo $autor['nome'];?></td>
        
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