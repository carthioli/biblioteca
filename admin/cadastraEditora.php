<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <title>Cadastra Editora</title>
</head>
<body>
  <header>
      <div class="container d-flex justify-content-center mt-4">
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

      <div class="container col-6 text-center">
        <h4>CADASTRAR EDITORA</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereEditora.php">
          <div class="d-flex flex-column">
            <label class="esquerda">NOME:</label>
            <input type="text" class="form-control-dark" name="nome">
            <label class="esquerda">TELEFONE:</label>
            <input type="text" class="form-control-dark" name="telefone"> 
          </div>  
            <input type="submit" name="salvar" value="SALVAR" class="mt-2">      
        </div>
       </form>
  </main>
  <footer>

  </footer>
</body>
</html>