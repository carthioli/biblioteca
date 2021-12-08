<?php
        include "..\publico\\telas\\topo.php";
        include "..\controle\mostra\mostraLivros.php";

        session_start();
        if ( isset($_SESSION['logado'] ) && $_SESSION['logado'] == 1 ){
            
        }else{
            header('location: ..\\publico\\login.php'); 
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
                    'id'  => $resultado['id'],
                  'nome'  => $resultado['nome'],
             'sobrenome'  => $resultado['sobrenome'],
                   'cpf'  => $resultado['cpf'],
              'telefone'  => $resultado['telefone']
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
    $pagina_atualAluno = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

    $linha_inicialAluno = ( $pagina_atualAluno - 1 ) * QTD_RESGISTROS;

    $query = pg_query("SELECT id, nome, sobrenome, cpf, telefone
                       FROM aluno 
                       LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicialAluno}");
        $alunosPagina = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $alunosPagina[] = [
                    'id'  => $resultado['id'],
                  'nome'  => $resultado['nome'],
             'sobrenome'  => $resultado['sobrenome'],
                   'cpf'  => $resultado['cpf'],
              'telefone'  => $resultado['telefone']
        ];
        }
        
      $sqlContadorAluno = pg_query("SELECT COUNT(id) AS total_registros
                              FROM aluno");

      $valor = pg_fetch_assoc( $sqlContadorAluno ); 

      $primeira_paginaAutorAluno = 1;

      $ultima_paginaAluno = ceil( $valor['total_registros'] / QTD_RESGISTROS);

      $pagina_anteriorAluno = ( $pagina_atualAluno > 1 ) ? $pagina_atualAluno - 1 : '';

      $proxima_paginaAluno = ( $pagina_atualAluno < $ultima_paginaAluno ) ? $pagina_atualAluno + 1 : '';

      $range_inicialAluno = ( ( $pagina_atualAluno - RANGE_PAGINAS ) >= 1 ) ? $pagina_atualAluno - RANGE_PAGINAS : 1;

      $range_finalAluno = ( ( $pagina_atualAluno - RANGE_PAGINAS ) <= $ultima_paginaAluno ) ? $pagina_atualAluno + RANGE_PAGINAS : $ultima_paginaAluno;

      $exibir_botao_inicialAluno = ( $range_inicialAluno < $pagina_atualAluno ) ? 'mostrar' : 'esconder';

      $exibir_botao_finalAluno = ( $range_finalAluno > $pagina_atualAluno ) ? 'mostrar' : 'esconder';
    
    /*TABELA AUTOR PAGINAÇÃO*/
        $pagina_atualAutor = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicialAutor = ( $pagina_atualAutor - 1 ) * QTD_RESGISTROS;

        $query = pg_query("SELECT id, nome, sobrenome, cpf
                        FROM autor 
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicialAutor}");

        $autoresPagina = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $autoresPagina[] = [
                   'id'  => $resultado['id'],
                 'nome'  => $resultado['nome'],
            'sobrenome'  => $resultado['sobrenome'],
                  'cpf'  => $resultado['cpf'],
        ];
        }
            
        $sqlContadorAutor = pg_query("SELECT COUNT(id) AS total_registros
                                      FROM autor");

        $valorAutor = pg_fetch_assoc( $sqlContadorAutor ); 

        $primeira_paginaAutor = 1;

        $ultima_paginaAutor = ceil( $valorAutor['total_registros'] / QTD_RESGISTROS);

        $pagina_anteriorAutor = ( $pagina_atualAutor > 1 ) ? $pagina_atualAutor - 1 : '';

        $proxima_paginaAutor = ( $pagina_atualAutor < $ultima_paginaAutor ) ? $pagina_atualAutor + 1 : '';

        $range_inicialAutor = ( ( $pagina_atualAutor - RANGE_PAGINAS ) >= 1 ) ? $pagina_atualAutor - RANGE_PAGINAS : 1;

        $range_finalAutor = ( ( $pagina_atualAutor - RANGE_PAGINAS ) <= $ultima_paginaAutor ) ? $pagina_atualAutor + RANGE_PAGINAS : $ultima_paginaAutor;

        $exibir_botao_inicialAutor = ( $range_inicialAutor < $pagina_atualAutor ) ? 'mostrar' : 'esconder';

        $exibir_botao_finalAutor = ( $range_finalAutor > $pagina_atualAutor ) ? 'mostrar' : 'esconder';

    /*TABELA EDITORA PAGINAÇÃO*/
        $pagina_atualEditora = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicialEditora = ( $pagina_atualEditora - 1 ) * QTD_RESGISTROS;

        $query = pg_query("SELECT id, nome, telefone
                        FROM editora 
                        LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicialEditora}");

        $editorasPagina = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $editorasPagina[] = [
                  'id'  => $resultado['id'],
                'nome'  => $resultado['nome'],
            'telefone'  => $resultado['telefone']
        ];
        }
            
        $sqlContadorEditora = pg_query("SELECT COUNT(id) AS total_registros
                                        FROM editora");

        $valorEditora = pg_fetch_assoc( $sqlContadorEditora ); 

        $primeira_paginaEditora = 1;

        $ultima_paginaEditora = ceil( $valorEditora['total_registros'] / QTD_RESGISTROS);

        $pagina_anteriorEditora = ( $pagina_atualEditora > 1 ) ? $pagina_atualEditora - 1 : '';

        $proxima_paginaEditora = ( $pagina_atualEditora < $ultima_paginaEditora ) ? $pagina_atualEditora + 1 : '';

        $range_inicialEditora = ( ( $pagina_atualEditora - RANGE_PAGINAS ) >= 1 ) ? $pagina_atualEditora - RANGE_PAGINAS : 1;

        $range_finalEditora = ( ( $pagina_atualEditora - RANGE_PAGINAS ) <= $ultima_paginaEditora ) ? $pagina_atualEditora + RANGE_PAGINAS : $ultima_paginaEditora;

        $exibir_botao_inicialEditora = ( $range_inicialEditora < $pagina_atualEditora ) ? 'mostrar' : 'esconder';

        $exibir_botao_finalEditora = ( $range_finalEditora > $pagina_atualEditora ) ? 'mostrar' : 'esconder';
        
    /*TABELA LIVRO PAGINAÇÃO*/
        $pagina_atualLivro = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicialLivro = ( $pagina_atualLivro - 1 ) * QTD_RESGISTROS;

        $query = pg_query("SELECT l.id, l.nome AS titulo, a.nome AS nome_autor, e.nome AS nome_editora
                           FROM livro AS l 
                           JOIN autor AS a ON a.id = l.id_autor
                           JOIN editora AS e ON e.id = l.id_editora
                           LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicialLivro}");

        $livrosPagina = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $livrosPagina[] = [
                  'id'  => $resultado['id'],
              'titulo'  => $resultado['titulo'],
               'autor'  => $resultado['nome_autor'],
             'editora'  => $resultado['nome_editora']
        ];
        }
            
        $sqlContadorLivro = pg_query("SELECT COUNT(id) AS total_registros
                                      FROM Livro");

        $valorLivro = pg_fetch_assoc( $sqlContadorLivro ); 

        $primeira_paginaLivro = 1;

        $ultima_paginaLivro = ceil( $valorLivro['total_registros'] / QTD_RESGISTROS);

        $pagina_anteriorLivro = ( $pagina_atualLivro > 1 ) ? $pagina_atualLivro - 1 : '';

        $proxima_paginaLivro = ( $pagina_atualLivro < $ultima_paginaLivro ) ? $pagina_atualLivro + 1 : '';

        $range_inicialLivro = ( ( $pagina_atualLivro - RANGE_PAGINAS ) >= 1 ) ? $pagina_atualLivro - RANGE_PAGINAS : 1;

        $range_finalLivro = ( ( $pagina_atualLivro - RANGE_PAGINAS ) <= $ultima_paginaLivro ) ? $pagina_atualLivro + RANGE_PAGINAS : $ultima_paginaLivro;

        $exibir_botao_inicialLivro = ( $range_inicialLivro < $pagina_atualLivro ) ? 'mostrar' : 'esconder';

        $exibir_botao_finalLivro = ( $range_finalLivro > $pagina_atualLivro ) ? 'mostrar' : 'esconder';
        
    /*TABELA LOGIN PAGINAÇÃO*/
        $pagina_atualLogin = ( isset( $_POST['page']) && is_numeric( $_POST['page'] ) ) ? $_POST['page'] : 1;

        $linha_inicialLogin = ( $pagina_atualLogin - 1 ) * QTD_RESGISTROS;

        $query = pg_query("SELECT l.id, l.nivel, a.nome AS nome_aluno, l.nome AS usuario
                           FROM login AS l 
                           JOIN aluno AS a ON a.id = l.id_usuario
                           LIMIT ".QTD_RESGISTROS." OFFSET {$linha_inicialLogin}");

        $loginsPagina = [];

        while ( $resultado = pg_fetch_assoc( $query ) ){
            $loginsPagina[] = [
                'id'  => $resultado['id'],
             'nivel'  => $resultado['nivel'],
        'nome_aluno'  => $resultado['nome_aluno'],
           'usuario'  => $resultado['usuario']
        ];
        }
            
        $sqlContadorLogin = pg_query("SELECT COUNT(id) AS total_registros
                                    FROM Login");

        $valorLogin = pg_fetch_assoc( $sqlContadorLogin ); 

        $primeira_paginaLogin = 1;

        $ultima_paginaLogin = ceil( $valorLogin['total_registros'] / QTD_RESGISTROS);

        $pagina_anteriorLogin = ( $pagina_atualLogin > 1 ) ? $pagina_atualLogin - 1 : '';

        $proxima_paginaLogin = ( $pagina_atualLogin < $ultima_paginaLogin ) ? $pagina_atualLogin + 1 : '';

        $range_inicialLogin = ( ( $pagina_atualLogin - RANGE_PAGINAS ) >= 1 ) ? $pagina_atualLogin - RANGE_PAGINAS : 1;

        $range_finalLogin = ( ( $pagina_atualLogin - RANGE_PAGINAS ) <= $ultima_paginaLogin ) ? $pagina_atualLogin + RANGE_PAGINAS : $ultima_paginaLogin;

        $exibir_botao_inicialLogin = ( $range_inicialLogin < $pagina_atualLogin ) ? 'mostrar' : 'esconder';

        $exibir_botao_finalLogin = ( $range_finalLogin > $pagina_atualLogin ) ? 'mostrar' : 'esconder';

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
                    <!--PAGINAÇÃO-->
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="aluno">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioAluno?>" type="submit" name="page" value="<?=$primeira_paginaAutorAluno?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioAluno?>" type="submit" name="page" value="<?=$pagina_anteriorAutorAluno?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$range_inicialAluno; $i < $range_finalAluno; $i++):   
                                    $destaque = ($i == $pagina_atualAluno);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalAluno?>" type="submit" name="page" value="<?=$proxima_paginaAluno?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalAluno?>" name="page" type="submit" value="<?=$ultima_paginaAluno?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                    </div>
                    <!--FIM PAGINAÇÃO-->   
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
                     <!--PAGINAÇÃO-->
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="autor">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioAutor?>" type="submit" name="page" value="<?=$primeira_paginaAutor?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioAutor?>" type="submit" name="page" value="<?=$pagina_anteriorAutor?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$range_inicialAutor; $i < $range_finalAutor; $i++):   
                                    $destaque = ($i == $pagina_atualAutor);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalAutor?>" type="submit" name="page" value="<?=$proxima_paginaAutor?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalAutor?>" name="page" type="submit" value="<?=$ultima_paginaAutor?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                    </div>
                    <!--FIM PAGINAÇÃO-->   
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
                    <!--PAGINAÇÃO-->
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="editora">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioEditora?>" type="submit" name="page" value="<?=$primeira_paginaEditora?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioEditora?>" type="submit" name="page" value="<?=$pagina_anteriorEditora?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$range_inicialEditora; $i < $range_finalEditora; $i++):   
                                    $destaque = ($i == $pagina_atualEditora);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalEditora?>" type="submit" name="page" value="<?=$proxima_paginaEditora?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalEditora?>" name="page" type="submit" value="<?=$ultima_paginaEditora?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                    </div>
                    <!--FIM PAGINAÇÃO-->    
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
                    <!--PAGINAÇÃO-->
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="livro">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioLivro?>" type="submit" name="page" value="<?=$primeira_paginaLivro?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioLivro?>" type="submit" name="page" value="<?=$pagina_anteriorLivro?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$range_inicialLivro; $i < $range_finalLivro; $i++):   
                                    $destaque = ($i == $pagina_atualLivro);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalLivro?>" type="submit" name="page" value="<?=$proxima_paginaLivro?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalLivro?>" name="page" type="submit" value="<?=$ultima_paginaLivro?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                    </div>
                    <!--FIM PAGINAÇÃO-->    
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
                    <!--PAGINAÇÃO-->
                    <div class="text-center">
                        <nav aria-label="Navegação de página exemplo">
                            <form method="POST" action="index.php">
                            <ul class="pagination">
                                <li class="page-item">
                                <input type="hidden" name="login">
                                <input type="hidden" name="pesquisar">    
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioLogin?>" type="submit" name="page" value="<?=$primeira_paginaLogin?>" aria-label="primeira">
                                    <span aria-hidden="true">Primeira</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_inicioLogin?>" type="submit" name="page" value="<?=$pagina_anteriorLogin?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Anterior</span>
                                </button>
                                </li>
                                <?php  
                                for ($i=$range_inicialLogin; $i < $range_finalLogin; $i++):   
                                    $destaque = ($i == $pagina_atualLogin);  
                                ?>   
                                    <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
                                <?php endfor; ?>  
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalLogin?>" type="submit" name="page" value="<?=$proxima_paginaLogin?>" aria-label="proximo">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Próximo</span>
                                </button>
                                </li>
                                <li class="page-item">
                                <button class="float-left page-link box-navegacao <?=$exibir_botao_finalLogin?>" name="page" type="submit" value="<?=$ultima_paginaLogin?>" aria-label="ultima">
                                    <span aria-hidden="true">Ultima</span>
                                </button>
                                </li>
                            </ul>
                            </form>
                        </nav> 
                    </div>
                    <!--FIM PAGINAÇÃO-->    
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
   