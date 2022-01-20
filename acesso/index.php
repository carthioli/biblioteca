<?php
       session_start();
       if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 2 || !isset($_SESSION['logado']) ){
            header('location: ../publico/index.php');
        }
        include "../publico/telas/topo.php";
?>
<link rel="stylesheet" href="../css/stylee.css"></link>
<title>Biblioteca Digital</title>
<body>
    <header>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <a class="navbar-brand text " href="index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;&nbsp;Biblioteca Digital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto float-right">
                    <!--<li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle rounded" id="alterar" role="button" data-toggle="dropdown">Alterar</a>
                        <div class="text-center dropdown-menu rounded" aria-labelledby="alterar">
                            <h5 class="text-danger">ALTERAR</h5>
                            <button class="a btn dropdown-item p-4 border-bottom border-top">ALUNO</button>
                            
                            <button class="a dropdown-item p-4 border-bottom" >AUTOR</button>
                            <button class="a dropdown-item p-4 border-bottom" >EDITORA</button>
                            <button class="a dropdown-item p-4 border-bottom" >LIVRO</button>
                            <button class="a dropdown-item p-4" >LOGIN</button>                            
                        </div>
                    </li>-->
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="admin" role="button" data-toggle="dropdown" >Cadastrar</a>
                        <div class="dropdown-menu rounded text-center " aria-labelledby="admin">
                            <h5 class="text-danger">CADASTRAR</h5>
                            <a class="a dropdown-item p-4 border-bottom border-top" href="../admin/cadastra/cadastraAluno.php">ALUNO</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../admin/cadastra/cadastraAutor.php">AUTOR</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../admin/cadastra/cadastraEditora.php">EDITORA</a>
                            <a class="a dropdown-item p-4 border-bottom" href="../admin/cadastra/cadastraLivro.php">LIVRO</a>
                            <a class="a dropdown-item p-4" href="../admin/cadastra/cadastraLogin.php">LOGIN</a>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="vizualizar" role="button" data-toggle="dropdown" >Visualizar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="vizualizar">
                            <h5 class="text-center text-danger">VIZUALIZAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-top" href="../admin/mostra/mostraEmprestimos.php">EMPRESTIMOS</a></button>
                            <button class="a" ><a class="a dropdown-item p-4  border-top" href="../admin/mostra/mostraReservas.php">RESERVAS</a></button>    
                        </div>
                    </li>
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body mt-1" type="submit" name="sair" id="sair"><button class="button border-0 mt-2">Sair</button></a>
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
                    <form">
                        <div>
                            <label id="label" for="aluno">ALUNO</label>
                            <input type="checkbox" id="aluno" class="check" name="check" value="aluno">
                            <label id="label" for="autor">AUTOR</label>
                            <input type="checkbox" id="autor" class="check" name="check" value="autor">
                            <label id="label" for="editora">EDITORA</label>
                            <input type="checkbox" id="editora" class="check" name="check" value="editora">
                            <label id="label" for="livro">LIVRO</label>
                            <input type="checkbox" id="livro" class="check" name="check" value="livro"> 
                            <label id="label" for="login">LOGIN</label>
                            <input type="checkbox" id="login" class="check" name="check" value="login">
                        </div>
                        <input class="p-1 float-left" type="text" name="pesquisar" id="txPesquisar" placeholder="Pesquisar livros...">
                        <button class="text-decoration-none text-body glyphicon glyphicon-search col-1 b border-0 mt-2 float-left" id="pesquisar"></button>
                    </form>
                </div>
            </div>
            <div class="grid-item ml-5 border-right g2" id="tabel">
            <table id="tabela" class="d-none">
              <button type="button" name="fechar" class="d-none" id="close"><span aria-hidden="true">&times;</span></button>
              <thead id="montarTabela">

              </thead>
              <tbody id="mostrar">

              </tbody>
            </table>
                <div id="paginacao" class="text-center d-none mb-4">
                    <button id="primeiro" class="btn border text-danger" disabled>Primeira</button>
                    <button id="anterior" class="btn border text-danger" disabled>&lsaquo;</button>
                    <span id="numeracao" class="btn border text-danger"></span>
                    <button id="proximo" class="btn border text-danger" disabled> &rsaquo;</button>
                    <button id="ultimo" class="btn border text-danger" disabled>Ultima</button>
                </div>     

                <div class="container col-8 p-2" id="todosLivros">
                    <div class="text-center container col-6">  
                    </div> 
                </div>

            </div>
            </div>
        </main>

        <script src="../javascript/scriptIndexAdmm.js"></script>
        <script src="../javascript/scriptLivros.js"></script>
        
    </body>
    </html>