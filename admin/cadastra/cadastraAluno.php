<?php
    include "../header/header.php";
?>
    <title>Cadastra Aluno</title>
  </head>
  <body>
    <header>
        <div id="message"></div>
        <div class="container col-6 text-center">
          <h4>CADASTRAR ALUNO</h4>
        </div>
    </header>
    <main>
      <div class="container col-3  border p-3 rounded">
        <form>
          <div class="d-flex flex-column">
            <label class="mb-0 float-left">NOME:</label>
            <input type="text" class="form-control-dark mb-2 text-capitalize" id="nome" name="nome">
            <label class="mb-0">SOBRENOME:</label>
            <input type="text" class="form-control-dark mb-2 text-capitalize" id="sobrenome" name="sobrenome">
            <label class="mb-0">CPF:</label>
            <input type="text" class="form-control-dark mb-2" id="cpf" name="cpf"> 
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone"> 
          </div> 
          <div class="text-center">  
            <input type="button" id="salvar" name="salvar" value="SALVAR" class="mt-3 btn-primary rounded border-0 p-2">  
            <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2 btn-danger rounded border-0 p-2">
          </div>   
        </form>   
      </div>       
    </main>

    <!--<table class="table table-striped table-bordered border mt-5" id="tabela_livro">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">ID</th>
          <th class="text-center">NOME</th>
          <th class="text-center">SOBRENOME</th>
          <th class="text-center">CPF</th>
          <th class="text-center">TELEFONE</th>
          <th class="text-center">AÇÕES</th>
        </tr>  
      </thead>
      <tbody id="mostrar">

      </tbody>
    </table>

    <div id="paginacao" class="text-center mb-4">
      <button id="primeiro" class="btn border text-danger" disabled>Primeira</button>
      <button id="anterior" class="btn border text-danger" disabled>&lsaquo;</button>
      <span id="numeracao" class="btn border text-danger"></span>
      <button id="proximo" class="btn border text-danger" disabled> &rsaquo;</button>
      <button id="ultimo" class="btn border text-danger" disabled>Ultima</button>
    </div> -->
    <footer>
      <script src="../../javascript/scriptCadAluno.js"></script>
    </footer>
  </body>
</html>
