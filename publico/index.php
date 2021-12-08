<?php   
        include "paginacao\\fechaPaginacao.php";
        include "paginacao\\paginacaoIndex.php";    
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
                    <li >
                        <div class="ml-1 mt-2 mr-1 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="emprestar" href="cadastra/cadastraEmprestimo.php"><button class="button border-0 mt-2">Emprestar<br/>Livro</button></a><br>
                        </div>
                    </li>
                    <li>
                        <div class="mt-2 mr-2 text-center">
                            <a class="text-decoration-none text-body" type="submit" name="reservar" href="cadastra/cadastraReserva.php"><button class="button border-0 mt-2">Reservar<br/>Livro</button></a>
                        </div>
                    </li> 
                    <li>
                        <div class="ml-1 mt-2 mr-1 text-center">
                         <a class="text-decoration-none text-body mt-1" type="submit" name="inicio" href="devolucao/devolucao.php"><button class="button border-0 mt-2">Devolução</button></a>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <div class="mt-2">
                        <a class="nav-link" id="user" role="button" data-toggle="dropdown" >
                            <button class="glyphicon glyphicon-user border-0 bg-danger rounded-circle p-3 text-white mt-1 ml-4"></button>
                        </a>
                        <div class="dropdown-menu rounded" aria-labelledby="user">
                            <h5 class="text-center text-danger text-uppercase"><?php echo $_SESSION['usuarioNome'] . "&nbsp;&nbsp" . $_SESSION['usuarioSobrenome'] ?></h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom border-top" href="../publico/altera/alteraPerfil.php">PERFIL</a></button>
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
                                <th class="text-center">EMPRESTAR</th>
                            </tr>  
                        </thead>
                        <tbody>
                            <tr>
                            <?php if( !empty( $_POST['pesquisar'] )): ?>
                            <form method="POST" action="cadastra/cadastraEmprestimo.php">
                            <?php foreach ( $livros as $livro):    
                            ?>
                                <td class="text-center"><?php echo $livro['id'];?></td>
                                <td><?php echo $livro['titulo'];?></td>
                                <td><?php echo $livro['autor'];?></td>
                                <td><?php echo $livro['editora'];?></td>  
                                <td class="text-center col-1">
                                <input type="hidden" name="pesquisar" value="<?php echo $livro['titulo']; ?>">
                                <button type="submit" class="glyphicon glyphicon-check border-0 bg-transparent"></button>
                                </td>  
                            </tr>
                            <?php endforeach; ?>
                            </form>
                            <?php endif; ?>  
                            <?php if( empty( $_POST['pesquisar'] )): ?> 
                            <form method="POST" action="cadastra\cadastraEmprestimo.php">    
                            <?php foreach ( $livrosPagina as $livro):    
                            ?>
                                <td class="text-center"><?php echo $livro['id'];?></td>
                                <td><?php echo $livro['titulo'];?></td>
                                <td><?php echo $livro['autor'];?></td>
                                <td><?php echo $livro['editora'];?></td>     
                                <td class="text-center col-1">
                                <input type="hidden" name="pesquisar" value="<?php echo $livro['titulo']; ?>">
                                <button type="submit" class="glyphicon glyphicon-check border-0 bg-transparent"></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </form>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="livro">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$primeira_pagina?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$pagina_anterior?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$paginacao['range_inicial']; $i < $paginacao['range_final']; $i++):   
                                    $destaque = ($i == $paginacao['pagina_atual']);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$paginacao['proxima_pagina']?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" name="page" type="submit" value="<?=$paginacao['ultima_pagina']?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                      </div>
                <?php endif; ?>
                <div class="container col-8 p-2">
                    <?php if( empty( $_POST['pesquisar'] ) ) : ?>
                    <?php foreach( $todoslivros AS $livro ): ?>
                        <form method="POST" action="index.php">
                            <h4><?php echo $livro['titulo']; ?>, de <?php echo $livro['autor'];?></h4>
                            <div class="border-bottom">
                            <input type="hidden" name="pesquisar" value="<?php echo $livro['titulo']; ?>">
                            <input type="hidden" name="livro">
                            <div class="mb-1">
                            <a class="float-right mr-5"><button  type="submit" class="border-0 bg-white">Ver mais...</button></a><br>   
                            </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>
   