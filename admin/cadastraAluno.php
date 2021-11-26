<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
?>

  <title>Cadastra Aluno</title>
</head>
<body>
  <header>

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
            <input type="submit" name="salvar" value="SALVAR">    
            </div>  
          </div>
        </form>
  </main>
  <footer>

  </footer>
</body>
</html>