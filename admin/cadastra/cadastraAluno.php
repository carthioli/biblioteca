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
      <div class="container col-3 border p-3 rounded">
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
    
    <div class="container mt-3 d-flex justify-content-center">
      <button id="ver" class="botoes text-uppercase border float-left rounded bg-transparent text-primary" data-toggle="modal" data-target="#tabelaEdita">Ver </br> cadastros</button>
    </div>
    <div class="modal fade" id="tabelaEdita" tabindex="-1" role="dialog" aria-labelledby="tabelaEdita" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="tituloModal"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                <thead>
                  <tr>
                    <th class="text-center col-1">ID</th>
                    <th class="text-center col-2">NOME</th>
                    <th class="text-center col-2">SOBRENOME</th>
                    <th class="text-center col-2">CPF</th>
                    <th class="text-center col-2">TELEFONE</th>
                    <th class="text-center col-1">ALTERAR</th>
                    <th class="text-center col-1">EXCLUIR</th>
                  </tr>  
                </thead>
                <tbody id="mostrar">

                </tbody>
              </table>

              <div id="paginacao" class="text-center mt-4">
                <button id="primeiro" class="btn border text-danger" disabled>Primeira</button>
                <button id="anterior" class="btn border text-danger" disabled>&lsaquo;</button>
                <span id="numeracao" class="btn border text-danger"></span>
                <button id="proximo" class="btn border text-danger" disabled> &rsaquo;</button>
                <button id="ultimo" class="btn border text-danger" disabled>Ultima</button>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>  
      </div>
    </div>
    
    <footer>
      <script src="../../javascript/scriptCadAlunooo.js"></script>
    </footer>
  </body>
</html>
