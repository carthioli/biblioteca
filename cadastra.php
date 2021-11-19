<?php
    include 'conexao.php';
    include 'autores.php';
    include 'editora.php';    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <title id="title">Cadastro</title>
    
</head>
<body>
  <header>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto float-right">
                    <li class="nav-item">
                        <a class="nav-link text-body" href="index.html">Inicio</a>
                    </li>
                    <form class="mt-3" method="POST" action="categoria.php">
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" id="categoria" role="button" data-toggle="dropdown" href="#">Categoria</a>
                        <div class="dropdown-menu rounded" aria-labelledby="categoria">
                            <button class="a" type="submit" name="acao"><a class="a dropdown-item p-4 border-bottom">Ação</a></button>
                            <button class="a" type="submit" name="aventura"><a class="a dropdown-item p-4 border-bottom">Aventura</a></button>
                            <button class="a" type="submit" name="suspense"><a class="a dropdown-item p-4 border-bottom">Suspense</a></button>
                            <button class="a" type="submit" name="ficcao"><a class="a dropdown-item p-4">Ficção</a></button>
                        </div>
                    </li>
                    </form>
                    <form class="d-flex" method="POST" action="emprestimo.php">
                    <li >
                        <div class="ml-3 mt-2 mr-3 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="emprestar"><button class="btn">Emprestar<br/>Livro</button></a><br>
                        </div>
                    </li>
                    <li>
                        <div class="ml-3 mt-2 mr-3 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="reservar"><button class="btn">Reservar<br/>Livro</button></a>
                        </div>
                    </li>
                </form>
                </ul>
            </div>
        </nav>
    </header>
    <main>
      <form class="container col-4 mt-5 border p-4" method="POST" action="recebe.php">
        <div class="lineinput">
          <label>NOME:</label>
          <input class="p-2" type="text" id="nome" name="nome" placeholder="Nome do livro:">
        </div>
        
        <div class="lineinput">
          <label>AUTOR:</label>
          <select class="p-2" id="autor" name="autor">
            <option>Selecione um autor:</option>  
              <?php          
                foreach( pegaAutores() as $autor ){
                    echo "<option value='{$autor['id']}' name='autor'>{$autor['nome']} {$autor['sobrenome']}</option>";
                }
              ?>
            <option>OUTRO</option>
          </select>
        </div>
        <div class="lineinput">
          <label>EDITORA:</label>
          <select class="p-2" id="editora" name="editora">
              <option>Selecione uma editora:</option>  
                <?php          
                  foreach( pegaEditoras() as $editoras ){
                      echo "<option value='{$editoras['id']}' name='editoras'>{$editoras['nome']}</option>";
                  }
                ?>
              <option>OUTRA</option>
          </select>
        </div>
        <div class="botaoform col-10 d-flex justify-content-center ml-5 mb-4">
          <input class="ml-2 button" type="submit" name="salvar" value="SALVAR">
          <input class="ml-2 button" type="button" onclick="cancelar()" name="cancelar" value="CANCELAR">
          <button class="ml-2 button"><a class="text-decoration-none text-body" href="index.html">VOLTAR</a></button>    
        </div>
      </form>  
    </main>
    
</body>
</html>