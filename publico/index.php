<?php   
        include "telas/topo.php";
        include "header/headerP.php";  
        include "../vendor/autoload.php";         
?>       
    <title>Biblioteca Digital</title>
<body>
    <main>
        <div class="container">
            <div class="p-5 mt-3 mb-5 border-bottom">
            </div>
        </div>
        <div class="grid">
          <div class="grid-item ml-5 mr-5 border-left g1">
            <div class="d-flex justify-content-center mt-5 rounded">
              <input class="p-1 float-left" type="text" name="pesquisar" id="txPesquisar" placeholder="Pesquisar livros...">
              <button class="text-decoration-none text-body glyphicon glyphicon-search col-1 b border-0 mt-2 float-left" id="pesquisar"></button>
            </div>
          </div>
          <div class="grid-item ml-5 border-right g2">
            <table id="tabela" class="d-none">
                <button type="button" name="fechar" class="d-none" id="close"><span aria-hidden="true">&times;</span></button>
                <thead>
                    <th class="center">ID</th>
                    <th>TITULO</th>
                    <th>AUTOR</th>
                    <th>EDITORA</th>
                </thead>
                <tbody id="mostrar">

                </tbody>
            </table>
            <div id="paginacao" class="d-none">
                <button id="anterior" class="btn border text-primary" disabled>&lsaquo;</button>
                <span id="numeracao" class="btn border text-primary"></span>
                <button id="proximo" class="btn border text-primary" disabled> &rsaquo;</button>
            </div>   

            <div class="container col-8 p-2" id="todosLivros">
              <div class="text-center container col-6">  
               </div> 
            </div>

          </div>
        </div>
    </main>

    <script src="../javascript/script.js"></script>

</body>
</html>
   
