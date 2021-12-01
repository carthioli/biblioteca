<?php
        include "telas/topo.php";
        session_start();
        if ( !isset($_SESSION['logado'] ) && !$_SESSION['logado'] == 2 ){
            header('location: ..\login.php'); 
        }
?>
<?php

    include "..\\config.php";
    $link =  include CONTROLE . "insere\\conexao.php";

    $pesquisa = false;

    if( isset( $_POST['pesquisar'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                        FROM livro AS l
                        JOIN autor AS a ON a.id = l.id_autor
                        JOIN editora AS e ON e.id = l.id_editora
                        WHERE l.nome LIKE  '%$titulo%'");

        $livros = [];

        while( $resultado = pg_fetch_assoc( $query ) ){
        $livros[] = [
            'id' => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor' => $resultado['autor'],
        'editora' => $resultado['editora']
        ];
        }
    }   
    if( isset( $_POST['fechar'] ) ){
        $pesquisar = false;
    } 
?>
<title>Biblioteca Digital</title>

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
                    <li >
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="emprestar" href="cadastraEmprestimo.php"><button class="button border-0 mt-2">Emprestar<br/>Livro</button></a><br>
                        </div>
                    </li>
                    <li>
                        <div class="mt-2 mr-2 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="reservar" href="cadastraReserva.php"><button class="button border-0 mt-2">Reservar<br/>Livro</button></a>
                        </div>
                    </li> 
                    <li class="nav-item active dropleft p-0 mt-0">
                        <div class="mt-2">
                        <a class="nav-link" id="user" role="button" data-toggle="dropdown" >
                            <button class="glyphicon glyphicon-user border-0 bg-danger rounded-circle p-3 text-white mt-1 ml-4"></button>
                        </a>
                        <div class="dropdown-menu rounded" aria-labelledby="user">
                            <h5 class="text-center text-danger text-uppercase"><?php echo $_SESSION['usuarioNome'] . "&nbsp;&nbsp" . $_SESSION['usuarioSobrenome'] ?></h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom border-top" href="..\publico\alteraPerfil.php">PERFIL</a></button>
                            <form method="POST" action="../controle/validacao/logout.php">
                                <div class="ml-1 mt-2 mr-1 mb-3 text-center">
                                    <a class="text-decoration-none text-body mt-1" type="submit" name="sair"><button class="button bg-white border-0 mt-2">SAIR</button></a>
                                </div>
                            </form>    
                        </div>
                        </div>
                    </li>
                </ul>    
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
                    <form method="POST" action="index.php">
                        <input class="p-1 float-left" type="text" name="pesquisar" placeholder="Pesquisar livros...">
                        <a class="text-decoration-none text-body" type="submit"><button class="glyphicon glyphicon-search col-1 b border-0 mt-2 float-left"></button></a>
                    </form>
                </div><br>
                <div class="mt-5 ml-5">
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                </div>
            </div>
            <div class="grid-item ml-5 border-right g2">
                <?php if( $pesquisa == true ): ?>
                    <form method="POST" action="index.php">    
                        <button type="submit" name="fechar" class="close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                    <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">TITULO</th>
                            <th class="text-center">AUTOR</th>
                            <th class="text-center">EDITORA</th>
                        </tr>  
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach ( $livros as $livro):    
                        ?>
                            <td class="text-center"><?php echo $livro['id'];?></td>
                            <td><?php echo $livro['titulo'];?></td>
                            <td><?php echo $livro['autor'];?></td>
                            <td><?php echo $livro['editora'];?></td>    
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <div class="container col-8 border-bottom p-2">
                    <h4>A divina comédia, de Dante Alighieri</h4>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>
   