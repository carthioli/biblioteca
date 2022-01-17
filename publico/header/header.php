<?php
        session_start();  
        if( !isset($_SESSION['logado']) ){
            header('location: ../login.php');
        }
        include "../telas/topo.php";
?>
    <link rel="stylesheet" href="../../css/style.css"> 
</head>
<body>
    <header>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand text " href="index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto float-right">
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="../index.php"><button class="button border-0 mt-2">Inicio</button></a>
                        </div>
                    </li>
                    <li >
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="emprestar" href="../cadastra/cadastraEmprestimo.php"><button class="button border-0 mt-2">Emprestar<br/>Livro</button></a><br>
                        </div>
                    </li>
                    <li>
                        <div class="mt-2 mr-2 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="reservar" href="../cadastra/cadastraReserva.php"><button class="button border-0 mt-2">Reservar<br/>Livro</button></a>
                        </div>
                    </li> 
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                         <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="../devolucao/devolucaoEmprestimo.php"><button class="button border-0 mt-2">Devolução</button></a>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                    <div class="mt-2">
                        <a class="nav-link" id="user" role="button" data-toggle="dropdown" >
                            <button class="glyphicon glyphicon-user border-0 bg-danger rounded-circle p-3 text-white mt-1 ml-4"></button>
                        </a>
                        <div class="dropdown-menu rounded" aria-labelledby="user">
                            <h5 class="text-center text-danger text-uppercase"><?php echo $_SESSION['usuarioNome'] . "&nbsp;&nbsp" . $_SESSION['usuarioSobrenome'] ?></h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom border-top" href="../altera/alteraPerfil.php">PERFIL</a></button>
                            <div class="ml-1 mt-2 mr-1 mb-3 text-center">
                                <a class="text-decoration-none text-body mt-1" type="submit" name="sair" id="sair"><button class="button bg-white border-0 mt-2">SAIR</button></a>
                            </div> 
                        </div>
                    </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script src="../../javascript/scriptHeader.js"></script>  
