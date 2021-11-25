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
            <label class="esquerda">NOME:</label>
            <input type="text" class="form-control-dark" name="nome">
            <label class="esquerda">SOBRENOME:</label>
            <input type="text" class="form-control-dark" name="sobrenome">
            <label>CPF:</label>
            <input type="text" class="form-control-dark mb-3" name="cpf">
            
            </div>  
            <input type="submit" name="salvar" value="SALVAR">      
          </div>
        </form>
  </main>
  <footer>

  </footer>
</body>
</html>