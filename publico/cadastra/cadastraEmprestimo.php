<?php
    session_start();  
    include "../paginacao/funPaginacao.php";
    include "../header/header.php";
?>

  <title>Emprestimo</title>
</head>
<body>
    <main>    
      <div class="container">
        <div class="text-center">
          <p class="text-success"></p> 
        </div>
        <h4>EMPRESTIMOS DE LIVROS</h4>         
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="col-1"></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
              </tr>  
            </thead>
            
            <tbody>
        
            </tbody>
        </table>    
        
        

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
                <select  name="dias_devolucao" class="mt-2 p-1 w-75">
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
                  <button type="submit" class="btn-primary border-0 p-2 rounded">FINALIZAR</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="text-center">  
          <button onclick="emprestar()" class="btn-danger border-0 p-2 rounded" data-toggle="modal" data-target="#usuario">EMPRESTAR</button>            
        </div>          
      </div>        
    </main>
<footer>
  
</footer>
</body>
</html>