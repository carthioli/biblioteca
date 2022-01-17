<?php
    include "../header/header.php";
?>
  <title>Cadastra Livro</title>
</head>
<body>
  <header>
      <div id="message"></div>
      <div class="container col-6 text-center">
        <h4>CADASTRAR LIVRO</h4>
      </div>
  </header>
  <main>
      <div class="container col-3 border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereLivro.php">
          <div class="d-flex flex-column">
            <label class="mb-0">TITULO:</label>
            <input type="text" class="form-control-dark mb-1" id="titulo" name="titulo">
            <div class="mt-1 d-flex flex-column">
            <label class="mb-0">AUTOR:</label>  
              <select id="id_autor" name="id_autor" class="p-1">
                  <option selected disabled>SELECIONE UM AUTOR...</option>
              </select>
              <label class="mb-0">EDITORA:</label> 
              <select id="id_editora" name="id_editora" class="p-1">
                <option selected disabled>SELECIONE UMA EDITORA...</option>
            </select>
          </div>  
        </div>
        <div class="text-center">  
          <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
          <input type="button" onclick="cancelar('titulo', 'id_autor', 'id_editora')" value="CANCELAR" class="mt-2"><a href="cadastraLivro.php" ></a>
        </div>          
        </form>
  </main>
        <!--<table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
              
            </tbody>
        </table>-->
        
  <footer>
  </footer>
</body>
</html>