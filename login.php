<?php
    include "controle\\mensagem.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../javascript/script.js"></script>
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Login</title>

    
</head>
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
   