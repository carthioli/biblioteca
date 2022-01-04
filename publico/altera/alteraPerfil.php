<?php
    
    session_start();
    include "../header/header.php";
    
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
                    unset($_SESSION['erro']); 
                    echo "{$mensagem_erro}";
              }
        ?>
      </p>  
      <div class="container col-6 text-center">
        <h4>ALTERAR PERFIL</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\..\controle\altera\alteraPerfil.php">
          <div class="d-flex flex-column">
            <?php if( $_SESSION['usuarioNivel'] == 2 ): ?>
            <input type="hidden" name="id" value="<?php echo $_SESSION['Id']?>">
            <label class="mb-0 float-left">NOME:</label> 
            <input type="text" class="form-control-dark mb-2" id="nome" name="nome" value="<?php echo $_SESSION['usuarioNome']?>">
            <label class="mb-0">SOBRENOME:</label>
            <input type="text" class="form-control-dark mb-2" id="sobrenome" name="sobrenome" value="<?php echo $_SESSION['usuarioSobrenome']?>">
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone" value="<?php echo $_SESSION['usuarioTelefone']?>">
            <label class="mb-0">USUARIO:</label>
            <input type="text" class="form-control-dark mb-2" id="usuario" name="usuario" value="<?php echo $_SESSION['usuarioUsuario']?>">
            <p class="text-danger text-center">
              <?php
                    if ( isset( $_SESSION['erroCampo'] ) ){ 
                          $mensagem_erro = mensagensErroCampo( $_SESSION['erroCampo'] );
                          unset($_SESSION['valida']); 
                          unset($_SESSION['erroCampo']);         
                          echo "{$mensagem_erro}";
                    }
              ?>
            </p> 
            <label class="mb-0">SENHA ATUAL:</label>
            <input type="password" class="form-control-dark mb-2" id="senha" name="senha_atual">
            <label class="mb-0">SENHA NOVA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha" name="senha_nova">
            <label class="mb-0">CONFIRMAR SENHA NOVA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha" name="senha_confirma">

            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2">
            </div>   
          </div>
          <?php else : ?>

          <?php endif; ?>  
        </form>        
  </main>     
  <footer>

  </footer>
</body>
</html>