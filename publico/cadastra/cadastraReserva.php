<?php
    include "../header/header.php";
?>
  <title>Reserva</title>
</head>
<body>
    <main>    
    <div id='message'></div>
      <div class="container">
        <h4 class="float-left">RESERVAS DE LIVROS</h4>
        <input type='hidden' id='userId' value="<?php echo $_SESSION['Id']; ?>">
        <div class="text-center">  
          <button type="submit" onclick="reservas()" class="btn-danger border-0 p-2 rounded text-white float-right">RESERVAR</button>
        </div>  
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th class="text-center col-1">#</th>
                <th class="text-center col-1">ID</th>
                <th class="text-center col-3">TITULO</th>
                <th class="text-center col-2">AUTOR</th>
                <th class="text-center col-2">EDITORA</th>
                <th class="text-center col-2">DISPONÍVEL EM</th>
                <th class="text-center col-1">RESERVAR</th>
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
    <script src="../../javascript/scriptReservaa.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<footer>
  
</footer>
</body>
</html>