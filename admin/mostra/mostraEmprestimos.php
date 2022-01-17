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
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">DATA EMPRESTIMO</th>
                <th class="text-center">DATA ENTREGA</th>
                <th class="text-center">STATUS</th>
              </tr>  
            </thead>
            <tbody id="mostrar">

            </tbody>
        </table>      
      </div>

    </main>
<footer>
  <script src="../../javascript/scriptMstEmprestimos.js"></script>      
</footer>
</body>
</html>