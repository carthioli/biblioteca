<?php
    session_start();  
    include "../header/header.php";
?>
  <title>Emprestimo</title>
</head>
<body>
    <main>  
      <div id='message'></div>
      <div class="container">
        <h4>EMPRESTIMOS DE LIVROS</h4>
        <input type='hidden' id='userId' value="<?php echo $_SESSION['Id']; ?>">
        <table class="table table-striped table-bordered border" id="tabela" class="d-none">
            <thead>
              <tr>
                <th class="text-center col-1">#</th>
                <th class="text-center col-1">ID</th>
                <th class="text-center col-2">TITULO</th>
                <th class="text-center col-3">AUTOR</th>
                <th class="text-center col-3">EDITORA</th>
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
        </div>   
        <div class="modal fade" id="usuario" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">INFORME O ALUNO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">  
              <select  name="dias_devolucao" id="dias" class="mt-2 p-1 w-75">
                <option selected disabled>SELECIONE UMA DATA...</option>
                <option>3</option>
                <option>5</option>
                <option>7</option>
                <option>14</option>
                <option>21</option>
              </select>      
              </div>
              <div class="modal-footer">
                <button href="cadastraEmprestimo.php" class="btn-danger border-0 p-2 rounded">CANCELAR</button>
                <button type="btn" id="finalizar" class="btn-primary border-0 p-2 rounded" onclick="check()">FINALIZAR</button>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">  
          <button class="btn-danger border-0 p-2 rounded" data-toggle="modal" data-target="#usuario">EMPRESTAR</button>            
        </div>          
      </div>        
    </main>
    <script src="../../javascript/scriptEmprestimo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<footer>

</footer>
</body>
</html>