<?php
        include "..\publico\\telas\\topo.php";
        include "..\controle\mostra\mostraLivros.php";

        session_start();
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 1 ){
            
        }else{
            header('location: ..\\index.php'); 
            $_SESSION['erro'] = 12;
        }
?>
<?php

    include "..\\config.php";
    $link =  include CONTROLE . "insere\\conexao.php";
    if( isset( $_POST['pesquisar'] ) ){
        $titulo = $_POST['pesquisar'];
    }
    $pesquisa = false;

    /*PESQUISA ALUNO*/    
    if( isset( $_POST['pesquisar'] ) && isset( $_POST['aluno'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT id, nome, sobrenome, cpf, telefone
                           FROM aluno AS a
                           WHERE a.nome LIKE  '%$titulo%'");
        $alunos = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $alunos[] = [
                'id'   => $resultado['id'],
                'nome' => $resultado['nome'],
                'sobrenome' => $resultado['sobrenome'],
                'cpf' => $resultado['cpf'],
                'telefone' => $resultado['telefone']
        ];
        }
    } 
    /*PESQUISA AUTOR*/ 
    if( isset( $_POST['pesquisar'] ) && isset( $_POST['autor'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT id, nome, sobrenome, cpf 
                           FROM autor AS a 
                           WHERE nome LIKE  '%$titulo%'");
        $autores = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $autores[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'sobrenome' => $resultado['sobrenome'],
            'cpf'  => $resultado['cpf'] 
        ];
        }  
    } 
    /*PESQUISA EDITORA*/ 
    if( isset( $_POST['pesquisar'] ) && isset( $_POST['editora'] ) ){
        $titulo = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT id, nome,telefone
                        FROM  editora 
                        WHERE nome LIKE  '%$titulo%'");
        $editoras = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $editoras[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'telefone' => $resultado['telefone']
        ];
        }

    } 
    /*PESQUISA LOGIN*/ 
    if( isset( $_POST['pesquisar'] ) && isset( $_POST['login'] ) ){
        $nome = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT l.id, l.nivel, a.nome AS nome_usuario, l.nome
                           FROM login AS l   
                           JOIN aluno AS a ON a.id = l.id_usuario
                           WHERE l.nome LIKE  '%$titulo%'");
        $login = [];

        while( $resultado = pg_fetch_assoc( $query ) ){
        $login[] = [
            'id' => $resultado['id'],
         'nivel' => $resultado['nivel'],
  'nome_usuario' => $resultado['nome_usuario'],
       'usuario' => $resultado['nome']
        ];
        }
    } 
    /*PESQUISA LIVRO*/ 
    if( isset( $_POST['pesquisar'] ) && isset( $_POST['livro'] ) ){
        $nivel = $_POST['pesquisar'];
        $pesquisa = true;
        $query = pg_query("SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
                        FROM livro AS l
                        JOIN autor AS a ON a.id = l.id_autor
                        JOIN editora AS e ON e.id = l.id_editora
                        WHERE l.nome LIKE  '%$titulo%'");
        $livros = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
        $livros[] = [
            'id'   => $resultado['id'],
            'titulo' => $resultado['nome'],
            'autor'  => $resultado['autor'],
            'editora'=> $resultado['editora']
        ];
        }
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
    /*FECHA TABELAS*/    
    if( isset( $_POST['fechar'] ) ){
        $pesquisar = false;
    } 
    /*TABELA ALUNO PAGINAÇÃO */
        define('QTD_RESGISTROS', 5);
        define('RANGE_PAGINAS', 1);
        $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;
        
        $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;
        
        $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");
        
        $sql = pg_query("SELECT id, nome, sobrenome, cpf, telefone 
                        FROM aluno
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                        
        $sqlContador = ("SELECT COUNT(*) AS total_registros
                        FROM aluno ");
        
        $stm = $link->prepare($sqlContador);
        $stm->execute();
        $valor = $stm ->fetch(PDO::FETCH_OBJ); 
        
        $alunosPagina = [];
        
        while ( $resultado = pg_fetch_assoc( $sql ) ){
            $alunosPagina[] = [
                'id'   => $resultado['id'],
                'nome' => $resultado['nome'],
                'sobrenome' => $resultado['sobrenome'],
                'cpf' => $resultado['cpf'],
                'telefone' => $resultado['telefone']
        
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
        
        /*TABELA AUTOR PAGINAÇÃO*/

        $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;
        
        $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");
        
        $sql = pg_query("SELECT id, nome, sobrenome, cpf 
                        FROM autor
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                        
        $sqlContador = ("SELECT COUNT(*) AS total_registros
                        FROM autor ");
        
        $stm = $link->prepare($sqlContador);
        $stm->execute();
        $valor = $stm ->fetch(PDO::FETCH_OBJ); 
        
        $autoresPagina = [];
    
        while ( $resultado = pg_fetch_assoc( $sql ) ){
        $autoresPagina[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'sobrenome' => $resultado['sobrenome'],
            'cpf'  => $resultado['cpf'] 
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

    /*TABELA EDITORA PAGINAÇÃO*/
        $pagina_atual = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicial = ( $pagina_atual - 1 ) * QTD_RESGISTROS;

        $link = new PDO("pgsql:host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");

        $sql = pg_query("SELECT id, nome, telefone 
                        FROM editora
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicial}");
                        
        $sqlContador = ("SELECT COUNT(*) AS total_registros
                        FROM editora ");

        $stm = $link->prepare($sqlContador);
        $stm->execute();
        $valor = $stm ->fetch(PDO::FETCH_OBJ); 

        $editorasPagina = [];

        while ( $resultado = pg_fetch_assoc( $sql ) ){
        $editorasPagina[] = [
            'id'   => $resultado['id'],
            'nome' => $resultado['nome'],
            'telefone' => $resultado['telefone']
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
    
    /*TABELA LIVRO PAGINAÇÃO*/
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

        $primeira_pagina = 1;

        $ultima_pagina = ceil( $valor->total_registros / QTD_RESGISTROS);

        $pagina_anterior = ( $pagina_atual > 1 ) ? $pagina_atual - 1 : '';

        $proxima_pagina = ( $pagina_atual < $ultima_pagina ) ? $pagina_atual + 1 : '';

        $range_inicial = ( ( $pagina_atual - RANGE_PAGINAS ) >= 1 ) ? $pagina_atual - RANGE_PAGINAS : 1;

        $range_final = ( ( $pagina_atual - RANGE_PAGINAS ) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        $exibir_botao_inicial = ( $range_inicial < $pagina_atual ) ? 'mostrar' : 'esconder';

        $exibir_botao_final = ( $range_final > $pagina_atual ) ? 'mostrar' : 'esconder';
        
    /*TABELA LOGIN PAGINAÇÃO*/


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
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="admin" role="button" data-toggle="dropdown" >Cadastrar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="admin">
                            <h5 class="text-center text-danger">CADASTRAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom border-top" href="../admin/cadastraAluno.php">ALUNO</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraAutor.php">AUTOR</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraEditora.php">EDITORA</a></button>
                            <button class="a" ><a class="a dropdown-item p-4 border-bottom" href="../admin/cadastraLivro.php">LIVRO</a></button>
                            <button class="a" ><a class="a dropdown-item p-4" href="../admin/cadastraLogin.php">LOGIN</a></button>
                        </div>
                    </li>
                    <li class="nav-item active dropleft p-0 mt-0">
                        <a class="nav-link dropdown-toggle" id="vizualizar" role="button" data-toggle="dropdown" >Visualizar</a>
                        <div class="dropdown-menu rounded" aria-labelledby="vizualizar">
                            <h5 class="text-center text-danger">VIZUALIZAR</h5>
                            <button class="a" ><a class="a dropdown-item p-4 border-top" href="../controle/mostra/mostraEmprestimos.php">EMPRESTIMOS</a></button>
                            <button class="a" ><a class="a dropdown-item p-4  border-top" href="../controle/mostra/mostraReservas.php">RESERVAS</a></button>    
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
    <main>
        <div class="container">
            <div class="p-5 mt-3 mb-5 border-bottom">

            </div>
        </div>
        <div class="grid">
            <div class="grid-item ml-5 mr-5 border-left g1">
                <div class="d-flex justify-content-center mt-5 rounded">
                    <form method="POST" action="index.php">
                        <div>
                        <label for="aluno">ALUNO</label>
                        <input type="checkbox" id="aluno" name="aluno">
                        <label for="autor">AUTOR</label>
                        <input type="checkbox" id="autor" name="autor">
                        <label for="editora">EDITORA</label>
                        <input type="checkbox" id="editora" name="editora">
                        <label for="livro">LIVRO</label>
                        <input type="checkbox" id="livro" name="livro"> 
                        <label for="login">LOGIN</label>
                        <input type="checkbox" id="login" name="login">
                        </div>
                        <input class="p-1 float-left" type="text" name="pesquisar" placeholder="Pesquisar...">
                        <a class="text-decoration-none text-body" type="submit"><button class="glyphicon glyphicon-search col-1 b border-0 mt-2 float-left"></button></a>
                    </form>
                </div>
            </div>
            <div class="grid-item ml-5 border-right g2">


            <!-- TABELA ALUNO -->
                <?php if( isset( $_POST['aluno'] )): ?>
                    <h4>TABELA ALUNOS</h4>
                    <form method="POST" action="index.php">    
                        <button type="submit" name="fechar" class="close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                    
                    <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">SOBRENOME</th>
                            <th class="text-center">CPF</th>
                            <th class="text-center">TELEFONE</th>
                        </tr>  
                        </thead>
                        <tbody>
                        <tr>
                        <?php if( !empty( $_POST['pesquisar'] )): ?>    
                        <?php foreach ( $alunos as $aluno):    
                        ?>
                            <td class="text-center"><?php echo $aluno['id'];?></td>
                            <td><?php echo $aluno['nome'];?></td>
                            <td><?php echo $aluno['sobrenome'];?></td>
                            <td><?php echo $aluno['cpf'];?></td>
                            <td><?php echo $aluno['telefone'];?></td>    
                        </tr>
                        <?php endforeach; ?>  
                        <?php endif; ?>  
                        <?php if( empty( $_POST['pesquisar'] )): ?> 
                        <?php foreach ( $alunosPagina as $aluno):    
                        ?>
                            <td class="text-center"><?php echo $aluno['id'];?></td>
                            <td><?php echo $aluno['nome'];?></td>
                            <td><?php echo $aluno['sobrenome'];?></td>
                            <td><?php echo $aluno['cpf'];?></td>
                            <td><?php echo $aluno['telefone'];?></td>    
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
                            <input type="hidden" name="aluno">
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
                            <input type="hidden" name="aluno">
                            <input type="hidden" name="pesquisar"> 
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
                
             <!-- TABELA AUTOR -->
                <?php if( $pesquisa == true && isset( $_POST['autor'] )): ?>
                    <h4>TABELA AUTORES</h4>
                    <form method="POST" action="index.php">    
                        <button type="submit" name="fechar" class="close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                    <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                        <thead>
                        <tr>
                        <th class="text-center">ID</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">SOBRENOME</th>
                            <th class="text-center">CPF</th>
                        </tr>  
                        </thead>
                        <tbody>
                        <tr>
                        <?php if( !empty( $_POST['pesquisar'] )): ?>    
                        <?php foreach ( $autores as $autor):    
                        ?>
                            <td class="text-center"><?php echo $autor['id'];?></td>
                            <td><?php echo $autor['nome'];?></td>
                            <td><?php echo $autor['sobrenome'];?></td>
                            <td><?php echo $autor['cpf'];?></td>    
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if( empty( $_POST['pesquisar'] )): ?> 
                        <?php foreach ( $autoresPagina as $autor):    
                        ?>
                            <td class="text-center"><?php echo $autor['id'];?></td>
                            <td><?php echo $autor['nome'];?></td>
                            <td><?php echo $autor['sobrenome'];?></td>
                            <td><?php echo $autor['cpf'];?></td>
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
                            <input type="hidden" name="autor">
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
                            <input type="hidden" name="autor">
                            <input type="hidden" name="pesquisar"> 
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
            <!-- TABELA EDITORA -->                    
                <?php if( $pesquisa == true && isset( $_POST['editora'] )): ?>
                    <h4>TABELA EDITORAS</h4>
                    <form method="POST" action="index.php">    
                        <button type="submit" name="fechar" class="close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                    <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">TELEFONE</th>
                        </tr>  
                        </thead>
                        <tbody>
                        <tr>
                        <?php if( !empty( $_POST['pesquisar'] )): ?>
                        <?php foreach ( $editoras as $editora):    
                        ?>
                            <td class="text-center"><?php echo $editora['id'];?></td>
                            <td><?php echo $editora['nome'];?></td>
                            <td><?php echo $editora['telefone'];?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>  
                        <?php if( empty( $_POST['pesquisar'] )): ?> 
                        <?php foreach ( $editorasPagina as $editora):    
                        ?>
                            <td class="text-center"><?php echo $editora['id'];?></td>
                            <td><?php echo $editora['nome'];?></td>
                            <td><?php echo $editora['telefone'];?></td>    
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
                            <input type="hidden" name="editora">
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
                            <input type="hidden" name="editora">
                            <input type="hidden" name="pesquisar"> 
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
            <!-- TABELA LIVRO -->                
                <?php if( $pesquisa == true && isset( $_POST['livro'] )): ?>
                    <h4>TABELA LIVROS</h4>
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
            <!-- TABELA LOGIN -->       

                <?php if( $pesquisa == true && isset( $_POST['login'] )): ?>
                    <h4">TABELA LOGIN</h4>
                    <form method="POST" action="index.php">    
                        <button type="submit" name="fechar" class="close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </form>
                    <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NÍVEL</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">USUARIO</th>
                        </tr>  
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach ( $login as $logins):    
                        ?>
                            <td class="text-center"><?php echo $logins['id'];?></td>
                            <td><?php echo $logins['nivel'];?></td>
                            <td><?php echo $logins['nome_usuario'];?></td>  
                            <td><?php echo $logins['usuario'];?></td>    
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                    <nav aria-label="Navegação de página exemplo">
                        <form method="POST" action="index.php">
                        <ul class="pagination">
                            <li class="page-item">
                            <input type="hidden" name="login">
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
                            <input type="hidden" name="login">
                            <input type="hidden" name="pesquisar"> 
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

                <div class="container col-8 p-2">
                    <div class="text-center container col-6">  
                    </div> 
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
    </main>
</body>
</html>
   