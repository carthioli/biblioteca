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


    
</head>
<body>
    <header>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand text " href="../index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto float-right">
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                        <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="../controle/index.html"><button class="button border-0 mt-2">Inicio</button></a>
                        </div>
                    </li>
                   <!-- <form class="mt-3" method="POST" action="categoria.php">
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle text-dan" id="categoria" role="button" data-toggle="dropdown" >Categoria</a>
                        <div class="dropdown-menu rounded" aria-labelledby="categoria">
                            <button class="a" type="submit" name="acao"><a class="a dropdown-item p-4 border-bottom">AÇÃO</a></button>
                            <button class="a" type="submit" name="aventura"><a class="a dropdown-item p-4 border-bottom">AVENTURA</a></button>
                            <button class="a" type="submit" name="suspense"><a class="a dropdown-item p-4 border-bottom">SUSPENSE</a></button>
                            <button class="a" type="submit" name="ficcao"><a class="a dropdown-item p-4">FICÇÃO</a></button>
                        </div>
                    </li>
                    </form>--> 
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="cadastrar" role="button" data-toggle="dropdown" >Cadastrar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="cadastrar">
                            <h5 class="text-center text-danger">CADASTRAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom border-top" href="../admin/cadastraAluno.php">ALUNO</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraAutor.php">AUTOR</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraLogin.php">LOGIN</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraEditora.php">EDITORA</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 " href="../admin/cadastraLivro.php">LIVRO</a></button>
                            
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="vizualizar" role="button" data-toggle="dropdown" >Vizualizar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="vizualizar">
                            <h5 class="text-center text-danger">VIZUALIZAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-top" href="mostra/cadastraEmprestimo.php">EMPRESTIMOS</a></button>
                            <button class="a" ><a class="a dropdown-item p-4  border-top" href="mostra/cadastraReserva.php">RESERVAS</a></button>    
                        </div>
                    </li>
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                        <a class="text-decoration-none text-body mt-1" type="submit" name="sair" href="../login.php"><button class="button border-0 mt-2">Sair</button></a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>