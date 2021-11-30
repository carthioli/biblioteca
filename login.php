<?php
    include "publico\\telas\\topo.php";
    include "controle\\mensagem.php";
    session_start();
?>
<title>Login</title>
<body>
    <header>
        <div class="container-fluid bg-light border-bottom mb-5">
            <p class="navbar-brand text " href="publico/index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</p> 
        </div>
    </header>
    <main>
    <div class="container col-4 d-flex justify-content-center border"> 
    <form action="controle\validacao\validacao.php" method="post">
      <fieldset class="w-100 text-center mt-5">
        <legend>Dados de Login</legend>
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
          <div class="">
          <label class="mb-3 mr-2" for="txUsuario">Usuário:</label>
            <input class="mb-3" type="text" name="usuario" id="txUsuario" maxlength="25" />
          </div>
          <div>  
          <label class="mt-3 mr-4" for="txSenha">Senha:</label>
            <input type="password" name="senha" id="txSenha"/>
          </div>
          <div class=" mt-5 mb-3">
            <input class="bg-danger text-white border-0 rounded p-2 w-50" type="submit" value="ACESSAR" />
          </div>
          <div class="mb-4">
            <a href="index.php">Esqueceu senha?</a>
          </div>
      </fieldset>
    </form>
    </div>
    </main>   
      

</body>
</html>
   