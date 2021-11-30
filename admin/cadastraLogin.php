<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraAlunos.php";
    include "..\\controle\\mostra\\mostraLogin.php";
    include "header.php";
?>

  <title>Cadastra Login</title>
</head>
<body>
  <header>
      <p class="text-success text-center">
        <?php
              if ( isset( $_SESSION['valida'] ) ){  
                    $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                    unset($_SESSION['erro']);
                    unset($_SESSION['valida']);
                    echo "{$mensagem_confirma}";
              }
        ?>
      </p> 
      <p class="text-danger text-center">
        <?php
              if ( isset( $_SESSION['erro'] ) ){ 
                    $mensagem_erro = mensagensErro( $_SESSION['erro'] );
                    unset($_SESSION['valida']); 
                    unset($_SESSION['erro']);        
                    echo "{$mensagem_erro}";
              }
        ?>
      </p> 
      <div class="container col-6 text-center">
        <h4>CADASTRAR LOGIN</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereLogin.php">
          <div class="d-flex flex-column">
            <label>NOME:</label>
            <select id="id_usuario" name="id_usuario" class="p-1" >
               <option selected disabled>SELECIONE UM ALUNO...</option>
               <?php foreach ( $alunos as $aluno ) :    
             ?>
               <option value="<?php echo $aluno['id'];?>"><?php echo $aluno['nome'];?></option>
             <?php endforeach; ?>
            </select>  
            <label class="mt-3 mb-0">NÍVEL:</label>
            <select id="nivel" name="nivel" class="mt-2 p-1">
              <option selected disabled>SELECIONE UM NÍVEL...</option>
              <option>1</option>
              <option>2</option>
            </select>  
            <label class="mt-3 mb-2">USUARIO:</label> 
            <input type="text" class="form-control-dark mb-1" id="usuario" name="usuario">    
            <p class="text-danger text-center">
            <?php
                  if ( isset( $_SESSION['erroCampo'] ) ){   
                    
                    $mensagem_erro = mensagensErroCampo( $_SESSION['erroCampo'] );
                    echo "{$mensagem_erro}";
                  }
            ?>
            </p>     
            <label class="mt-3 mb-2">SENHA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha" name="senha"> 
            <label class="mt-3 mb-2">CONFIRMAR SENHA:</label>
            <input type="password" class="form-control-dark mb-2" id="confirma_senha" name="confirma_senha">     
            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelarLogin()" value="CANCELAR" class="mt-2"><a href="cadastraAluno.php" ></a>
            </div>   
          </div>
        </form>        
  </main>
  <table class="table table-striped table-bordered border mt-5" id="tabela_livro">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">ID</th>
                <th class="text-center">NÍVEL</th>
                <th class="text-center">ID USUARIO</th>
                <th class="text-center">USUARIO</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
        
              <tr>

              <?php foreach ( $logins as $login):    
              ?>

                <td class="text-center"><input type="checkbox" name="id_login" value="<?php echo $login['id'];?>"></td>
                <td class="text-center"><?php echo $login['id'];?></td>
                <td><?php echo $login['nivel'];?></td>
                <td><?php echo $login['id_usuario'];?></td>
                <td><?php echo $login['usuario'];?></td>   
                <td class="d-flex justify-content-center border-bottom-0">
                  <form method="GET" action="../controle/remove/removelogin.php">
                    <input type="hidden" name="id_excluir" value="<?php echo $login['id'];?>"/>
                    <input class="float-left" name="excluir" onclick="excluir()" type="image" src="..//img/excluir.png" width="20px">
                  </form>
                </td>   
              </tr>

              <?php endforeach; ?>

            </tbody>
        </table>      
  <footer>

  </footer>
</body>
</html>