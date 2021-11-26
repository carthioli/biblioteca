<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="../javascript/script.js"></script>
    <link rel="stylesheet" href="../css/estilo.css">
    <style>

    </style>
    

 
    <title>Biblioteca Digital</title>
</head>
<body>
    <header>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto float-right">
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                        <a class="a text-decoration-none text-body mt-1" type="submit" name="emprestar" href="index.php"><button class="button border-0 mt-2">Inicio</button></a>
                        </div>
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
                    <li class="nav-item active dropdown p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="cadastrar" role="button" data-toggle="dropdown" href="#">Cadastrar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="cadastrar">
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraAluno.php">ALUNO</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraAutor.php">AUTOR</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraEditora.php">EDITORA</a></button>
                            <button class="a" ><a class="a dropdown-item p-4" href="../admin/cadastraLivro.php">LIVRO</a></button>
                        </div>
                    </li>
                    <li >
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="emprestar" href="cadastraEmprestimo.php"><button class="btn">Emprestar<br/>Livro</button></a><br>
                        </div>
                    </li>
                    <li>
                        <div class="mt-2 mr-2 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="reservar" href="cadastraReserva.php"><button class="btn">Reservar<br/>Livro</button></a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </header>