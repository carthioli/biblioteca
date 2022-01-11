<?php
    include "../header/header.php";
?>
  <title>Seus emprestimo</title>
</head>
<body>
    <main>    
      <div id='message'></div>
      <div class="container">
        <h4 class="float-left">DEVOLVER EMPRESTIMOS</h4>     
        <input type='hidden' id='userId' value="<?php echo $_SESSION['Id']; ?>">    
        <div class="text-center float-right">  
          <button onclick="devolver()" class="btn-danger border-0 p-2 rounded" type="submit">DEVOLVER</button>            
        </div>       
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="text-center col-1">#</th>
                <th class="text-center col-2">TITULO</th>
                <th class="text-center col-2">AUTOR</th>
                <th class="text-center col-1">EDITORA</th>
                <th class="text-center col-2">DATA EMPRESTIMO</th>
                <th class="text-center col-2">DATA ENTREGA</th>
                <th class="text-center col-1">STATUS</th>
                <th class="text-center col-1">DEVOLVER</th>
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
    <script src="../../javascript/scriptDevolucao.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<footer>
  
</footer>
</body>
</html>