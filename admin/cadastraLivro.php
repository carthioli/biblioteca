<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
    include "..\\controle\\mostra\\mostraAutor.php";
    include "..\\controle\\mostra\\mostraEditora.php";
    include "..\\controle\\mostra\\mostraLivros.php";
    include "..\\controle\\mostra\\mostraAlunos.php";
  
  
?>

  <title>Cadastra Livro</title>
</head>
<body>
  <header>

      <div class="container col-6 text-center">
        <h4>CADASTRAR LIVRO</h4>
      </div>
  </header>
  <main>
      <div class="container col-3 border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereLivro.php">
          <div class="d-flex flex-column">
            <label class="mb-0">TITULO:</label>
            <input type="text" class="form-control-dark mb-1" name="titulo">
            <div class="mt-1 d-flex flex-column">
            <label class="mb-0">AUTOR:</label>  
              <select name="id_autor" class="p-1">
                  <option></option>
                <?php foreach ( $autores as $autor){    
                ?>
                  <option value="<?php echo $autor['id'];?>"><?php echo $autor['nome'];?></option>
                <?php }?>
              </select>
              <label class="mb-0">EDITORA:</label> 
              <select name="id_editora" class="p-1">
              <option></option>
                <?php foreach ( $editoras as $editora){    
                ?>
                  <option value="<?php echo $editora['id'];?>"><?php echo $editora['nome'];?></option>
                <?php }?>
            </select>
          </div>  
        </div>
        <div class="text-center">  
          <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
          <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraLivro.php" ></a>
        </div>          
        </form>
  </main>
  <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">TITULO</th>
                <th class="text-center">AUTOR</th>
                <th class="text-center">EDITORA</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
        <form method="POST" action="..\controle\insere\insereEmprestimo.php">
              <tr>

              <?php foreach ( $livros as $livro):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_livro" value="<?php echo $livro['id'];?>"></td>
                <td class="text-center"><?php echo $livro['id'];?></td>
                <td><?php echo $livro['titulo'];?></td>
                <td><?php echo $livro['autor'];?></td>
                <td><?php echo $livro['editora'];?></td> 
        </form>
                <td class="d-flex justify-content-center border-top-0">
                  <form method="GET" action="../controle/remove/removeLivro.php">
                    <input type="hidden" name="id_excluir" value="<?php echo $livro['id'];?>"/>
                    <input class="float-left" name="excluir" onclick="salvar()" type="image" src="..//img/excluir.png" width="20px">
                  </form>
                </td>   
              </tr>

              <?php endforeach; ?>

            </tbody>
        </table>

  <footer>
  </footer>
</body>
</html>