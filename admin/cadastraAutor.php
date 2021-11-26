<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
?>

  <title>Cadastra Autor</title>
</head>
<body>
  <header>

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
  <footer>

  </footer>
</body>
</html>