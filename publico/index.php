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


    define('QTD_RESGISTROS', 5);
    define('RANGE_PAGINAS', 1);
    $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

    $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

    $sql = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                    FROM livro AS l
                    JOIN autor AS a ON a.id = l.id_autor 
                    JOIN editora AS e ON e.id = l.id_editora
                    LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                    
    $sqlContador = ("SELECT COUNT(*) AS total_registros
                    FROM livro ");

    $stm = $link->prepare($sqlContador);
    $stm->execute();
    $valor = $stm ->fetch(PDO::FETCH_OBJ); 

    $livrosPagina = [];

    while ( $resultado = pg_fetch_assoc( $sql ) ){
    $livrosPagina[] = [
        'id'   => $resultado['id'],
        'titulo' => $resultado['nome'],
        'autor'  => $resultado['autor'],
        'editora'=> $resultado['editora']
    ];
    }
    /*MOSTRA TODOS OS LIVROS */
    $querytodos = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
    FROM livro AS l
    JOIN autor AS a ON a.id = l.id_autor
    JOIN editora AS e ON e.id = l.id_editora");
$todoslivros = [];

while ( $resultado = pg_fetch_assoc( $querytodos ) ){
$todoslivros[] = [
'id'   => $resultado['id'],
'titulo' => $resultado['nome'],
'autor'  => $resultado['autor'],
'editora'=> $resultado['editora']
];
}

    $primeira_pagina = 1;

    $ultima_pagina = ceil( $valor->total_registros / QTD_RESGISTROS);

    $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

    $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

    $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

    $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

    $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

    $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';
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
                        <?php if( !empty( $_POST['pesquisar'] )): ?>
                        <?php foreach ( $livros as $livro):    
                        ?>
                            <td class="text-center"><?php echo $livro['id'];?></td>
                            <td><?php echo $livro['titulo'];?></td>
                            <td><?php echo $livro['autor'];?></td>
                            <td><?php echo $livro['editora'];?></td>    
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>  
                        <?php if( empty( $_POST['pesquisar'] )): ?> 
                        <?php foreach ( $livrosPagina as $livro):    
                        ?>
                            <td class="text-center"><?php echo $livro['id'];?></td>
                            <td><?php echo $livro['titulo'];?></td>
                            <td><?php echo $livro['autor'];?></td>
                            <td><?php echo $livro['editora'];?></td>     
                        </tr>
                        <?php endforeach; ?>
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
                            for ($i=$range_inicial; $i <= $range_final; $i++):   
                                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
                            ?>   
                                <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                            <?php endfor; ?>  
                            <li class="page-item">
                            <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$proxima_pagina?>" aria-label="proximo">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Próximo</span>
                            </button>
                            </li>
                            <li class="page-item">
                            <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" name="page" type="submit" value="<?=$ultima_pagina?>" aria-label="ultima">
                                <span aria-hidden="true">Ultima</span>
                            </button>
                            </li>
                        </ul>
                        </form>
                      </nav> 
                      </div>
                <?php endif; ?>
                <div class="container col-8 border-bottom p-2">
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
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</body>
</html>
   