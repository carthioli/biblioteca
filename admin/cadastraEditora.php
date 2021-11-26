<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
?>

  <title>Cadastra Editora</title>
</head>
<body>
  <header>

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
          <div class="text-center">  
            <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
            <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraEditora.php" ></a>
          </div>        
        </div>
       </form>
  </main>
  <footer>

  </footer>
</body>
</html>