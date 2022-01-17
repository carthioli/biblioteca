<?php
    include "../header/header.php";
?>
  <title>Cadastra Autor</title>
</head>
<body>
  <header>
    <div id="message"></div>
      <div class="container col-6 text-center">
        <h4>CADASTRAR AUTOR</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form>
          <div class="d-flex flex-column">
            <label class="mb-0">NOME:</label>
            <input type="text " class="form-control-dark text-capitalize" id="nome" name="nome">
            <label class="mb-0 mt-2">SOBRENOME:</label>
            <input type="text" class="form-control-dark text-capitalize" id="sobrenome" name="sobrenome">
            <label class="mb-0 mt-2">CPF:</label>
            <input type="text" class="form-control-dark mb-3" id="cpf" name="cpf">
          </div>
          <div class="text-center">  
            <input type="button" id="salvar" name="salvar" value="SALVAR" class="mt-3 btn-primary rounded border-0 p-2">  
            <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2 btn-danger rounded border-0 p-2">
          </div>     
          </div>
        </form>
  </main>
         <!-- <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">NOME</th>
                <th class="text-center">SOBRENOME</th>
                <th class="text-center">CPF</th>
                <th class="text-center col-1">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
            
            </tbody>
        </table>-->
  <footer>
    <script src="../../javascript/scriptCadAutor.js"></script>
  </footer>
</body>
</html>
