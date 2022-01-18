<?php
    include "../header/header.php";
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 2 ){
            header('location: ../../publico/index.php');
        }
?>
<title>Emprestimos</title>
    <main>    
      <div class="container">
        <h4>LIVROS EMPRESTADOS</h4>         
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="text-center col-1">ID</th>
                <th class="text-center col-2">TITULO</th>
                <th class="text-center col-2">AUTOR</th>
                <th class="text-center col-2">EDITORA</th>
                <th class="text-center col-1">DATA EMPRESTIMO</th>
                <th class="text-center col-1">DATA ENTREGA</th>
                <th class="text-center col-1">STATUS</th>
                <th class="text-center col-2">ALUNO</th>
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
      </div>

    </main>
<footer>
  <script src="../../javascript/scriptMstEmprestimooos.js"></script>      
</footer>
</body>
</html>