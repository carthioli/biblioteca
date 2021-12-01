<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
    
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
        <form method="POST" action="..\controle\insere\alteraAluno.php">
          <div class="d-flex flex-column">
            <label class="mb-0 float-left">NOME:</label> 
            <input type="text" class="form-control-dark mb-2" id="nome" name="nome">
            <label class="mb-0">SOBRENOME:</label>
            <input type="text" class="form-control-dark mb-2" id="sobrenome" name="sobrenome">
            <label class="mb-0">CPF:</label>
            <input type="text" class="form-control-dark mb-2" id="cpf" name="cpf"> 
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone">
            <label class="mb-0">USUARIO:</label>
            <input type="text" class="form-control-dark mb-2" id="usuario" name="usuario">
            <label class="mb-0">SENHA:</label>
            <input type="text" class="form-control-dark mb-2" id="senha" name="senha">


            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2">
            </div>   
          </div>
        </form>        
  </main>     
  <footer>

  </footer>
</body>
</html>