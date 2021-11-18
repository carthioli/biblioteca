<?php
    include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Login</title>
    <style>
        .grid{
            display: grid;
            grid-template-columns: 3fr 8fr 3fr;
            grid-template-rows: 550px 250px;
            grid-template-areas: "g2 g2 g1"
                                 "g2 g2 g3";
        }
        .g1{
            grid-area: g1;
        }
        .g2{
            grid-area: g2;
        }
        .g3{
            grid-area: g3;
        }
        .inp{
            height: 100px
        }
    </style>
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
                        <a class="nav-link text-body" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" id="categoria" role="button" data-toggle="dropdown" href="#">Categoria</a>
                        <div class="dropdown-menu rounded" aria-labelledby="categoria">
                            <a class="dropdown-item p-4" href="">Ação</a>
                            <a class="dropdown-item p-4" href="">Aventura</a>
                            <a class="dropdown-item p-4" href="">Suspense</a>
                            <a class="dropdown-item p-4" href="">Ficção</a>
                        </div>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" id="cadastrar" role="button" data-toggle="dropdown" href="#">Cadastrar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="cadastrar">
                            <a class="dropdown-item p-4" href="">Autor</a>
                            <a class="dropdown-item p-4" href="">Editora</a>
                            <a class="dropdown-item p-4" href="">Livro</a>
                        </div>
                    </li>
                    <li>
                        <div class="ml-3 mt-2 mr-3">
                            <a class="text-decoration-none text-body" href="">Emprestar<br/>Livro</a>
                        </div>
                    </li>
                    <li>
                        <div class="ml-3 mt-2 mr-3">
                            <a class="text-decoration-none text-body" href="">Emprestar<br/>Livro</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="p-5 mt-3 mb-5 border-bottom">

            </div>
        </div>
        <div class="grid">
            <div class="grid-item ml-5 mr-5 border-left g1">
                <div class="d-flex justify-content-center mt-5 rounded">
                    <input class="p-2" type="text" placeholder="Pesquisar...">   
                </div><br>
                <div class="mt-5 ml-5">
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                </div>
            </div>
            <div class="grid-item ml-5 border align-middle g2">
                <img class="bg-dark" src="#" width="100px">
            </div>

            <div class="grid-item ml-5 mt-5 mr-5 border g3">
                <form method="POST" action="">
                    <div class="d-flex justify-content-center mt-3 rounded">
                        <input class="inp" type="text" placeholder="Sugestão">   
                    </div><br>
                    <div class="d-flex justify-content-center rounded">
                        <input class="p-2" type="text" placeholder="Email:">   
                    </div>
                    <div class="d-flex justify-content-center mt-3 rounded">
                        <input class="p-2" type="submit">   
                    </div>
                </form>
            </div>
        </div>
        
    </main>
    <footer>
        <div class="container-fluid bg-danger mt-5 p-5">

        </div>
    </footer>    
</div>
</body>
</html>
   