<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraEditora.php";
    include "header.php";
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
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center">TELEFONE</th>
                <th class="text-center col-2">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
        
              <tr>

              <?php foreach ( $editoras as $editora):    
              ?>

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
  <footer>

  </footer>
</body>
</html>