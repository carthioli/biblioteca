<?php
    include "../paginacao/funPaginacao.php";
    include "../paginacao/paginacaoCadastraReserva.php";
?>
  <title>Reserva</title>
</head>
<body>
    <main>    
      <div class="container">
        <div class="text-center">
          <p class="text-success">
            <?php
                  if ( isset( $_SESSION['valida'] ) ){  
                       $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                       unset($_SESSION['erro']);
                       unset($_SESSION['valida']);
                       echo "{$mensagem_confirma}";
                  }
            ?>
          </p> 
          <p class="text-danger">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){ 
                       $mensagem_erro = mensagensErro( $_SESSION['erro'] );
                       unset($_SESSION['valida']);
                       unset($_SESSION['erro']);
                       echo "{$mensagem_erro}";
                  }
            ?>
          </p> 
        </div>
        <h4>RESERVAS DE LIVROS</h4>
        <table class="table table-striped table-bordered border" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">DISPONÍVEL EM</th>
                <th class="text-center col-1">RESERVAR</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\..\controle\insere\insereReserva.php">
              <tr>
              <input type="hidden" name=id_aluno value="<?php echo $_SESSION['Id'];?>">
              <?php foreach ( $livros as $livro):    
              ?>
                <td class="text-center"><input type="checkbox" name="id_livro[]" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td>
                <td class="text-center"><?php echo date("d/m/Y", strtotime($livro['data_devolucao'])); ?></td>
                <td class="text-center"><button name="id_livro[]" value="<?php echo $livro['id'];?>" type="submit" class="glyphicon glyphicon-check border-0 bg-transparent"></button></td>   
              </tr>

              <?php endforeach; ?>

            </tbody>
        </table> 
        <div class="text-center">  
          <button type="submit" onclick="emprestar()" class="btn-danger border-0 p-2 rounded text-white ">RESERVAR</button>
        </div>
        </form>     
      </div>
      <!-- PAGINAÇÃO -->
      <div class="text-center">
          <nav aria-label="Navegação de página exemplo">
            <form method="POST" method="cadastraReserva.php">
                <?php require "../paginacao/paginacao.php"; ?>
            </form>
          </nav>
        </div>
        <!-- FIM PAGINAÇÃO -->
    </main>
<footer>
  
</footer>
</body>
</html>