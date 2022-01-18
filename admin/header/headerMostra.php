<?php
        session_start();
        include "../../publico/telas/topo.php";
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 2 ){
            header('location: ../../publico/index.php');
        }
?>
<link rel="stylesheet" href="../../css/style.css"> 
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
                         <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="../../controle/index.php"><button class="button border-0 mt-2">Inicio</button></a>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="admin" role="button" data-toggle="dropdown" >Cadastrar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="admin">
                            <h5 class="text-center text-danger">CADASTRAR</h5>
                            <a class="a dropdown-item p-4 border-bottom border-top" href="../cadastra/cadastraAluno.php">ALUNO</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../cadastra/cadastraAutor.php">AUTOR</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../cadastra/cadastraEditora.php">EDITORA</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../cadastra/cadastraLivro.php">LIVRO</a>
                            <a class="a dropdown-item p-4" href="../cadastra/cadastraLogin.php">LOGIN</a>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="vizualizar" role="button" data-toggle="dropdown" >Visualizar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="vizualizar">
                            <h5 class="text-center text-danger">VIZUALIZAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-top" href="mostraEmprestimos.php">EMPRESTIMOS</a></button>
                            <button class="a" ><a class="a dropdown-item p-4  border-top" href="mostraReservas.php">RESERVAS</a></button>    
                        </div>
                    </li>
                    <li>
                        <form method="POST" action="../validacao/logout.php">
                            <div class="ml-1 mt-2 mr-1 text-center">
                                <a class="text-decoration-none text-body mt-1" type="submit" name="sair"><button class="button border-0 mt-2">Sair</button></a>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>