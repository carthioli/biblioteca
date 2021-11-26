<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "header.php";
    include "..\\controle\\mostra\\mostraAutor.php";
    include "..\\controle\\mostra\\mostraEditora.php";
  
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
      <div class="container col-3  border p-3 rounded">
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
            <input type="submit" name="salvar" value="SALVAR" class="mt-2 ">         
       </form>
  </main>
  <footer>

  </footer>
</body>
</html>