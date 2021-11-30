<?php

    session_start();  

    include "header.php";
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraAlunoAltera.php"
    
?>
 <title>Alterar Aluno</title>
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
        <h4>ALTERAR ALUNO</h4>
      </div>
  </header>
  <main>
      <?php foreach ( $alunos AS $aluno ): ?>

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
            <input type="text" class="form-control-dark mb-2" id="nome" name="nome" value="">
            <label class="mb-0">USUARIO:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" id="sobrenome" name="sobrenome">
            <label class="mb-0">SENHA:</label>
            <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    $mensagem_confirma = mensagensErroCampo( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <input type="text" class="form-control-dark mb-2" id="cpf" name="cpf"> 
            <label class="mb-0">CONFIRMAR SENHA:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone">
            
            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2">
            </div>   
          </div>
        </form>        
  </main>
<?php endforeach;?>

  
  <footer>

  </footer>
</body>
</html>