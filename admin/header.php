<?php
        include "..\publico\\telas\\topo.php";
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 2 ){
            header('location: ..\\..\\publico\\index.php');
        }
?>
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
                         <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="../controle/index.php"><button class="button border-0 mt-2">Inicio</button></a>
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
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraEditora.php">EDITORA</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraLogin.php">LOGIN</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 " href="../admin/cadastraLivro.php">LIVRO</a></button>
                            
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="vizualizar" role="button" data-toggle="dropdown" >Visualizar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="vizualizar">
                            <h5 class="text-center text-danger">VIZUALIZAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-top" href="mostra/cadastraEmprestimo.php">EMPRESTIMOS</a></button>
                            <button class="a" ><a class="a dropdown-item p-4  border-top" href="mostra/cadastraReserva.php">RESERVAS</a></button>    
                        </div>
                    </li>
                    <li>
                        <form method="POST" action="../controle/validacao/logout.php">
                            <div class="ml-1 mt-2 mr-1 text-center">
                                <a class="text-decoration-none text-body mt-1" type="submit" name="sair"><button class="button border-0 mt-2">Sair</button></a>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>