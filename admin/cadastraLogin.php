<?php
    
    session_start();
    include "..\\controle\\mensagem.php";
    include "..\\controle\\mostra\\mostraAlunos.php";
    include "header.php";
?>

  <title>Cadastra Aluno</title>
</head>
<body>
  <header>
            <p class="text-success text-center">
            <?php
                  if ( isset( $_SESSION['valida'] ) ){   
                    session_destroy();
                    $mensagem_confirma = mensagensConfirma( $_SESSION['valida'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
            <p class="text-danger text-center">
            <?php
                  if ( isset( $_SESSION['erro'] ) ){   
                    session_destroy();
                    $mensagem_confirma = mensagensErro( $_SESSION['erro'] );
                    echo "{$mensagem_confirma}";
                  }
            ?>
            </p> 
      <div class="container col-6 text-center">
        <h4>CADASTRAR USUÁRIO</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form method="POST" action="..\controle\insere\insereLogin.php">
          <div class="d-flex flex-column">
            <label>NOME:</label>
            <select name="id_usuario" class="p-1 ">
               <option selected disabled>SELECIONE UM ALUNO...</option>
               <?php foreach ( $alunos as $aluno ) :    
             ?>
               <option value="<?php echo $aluno['id'];?>"><?php echo $aluno['nome'];?></option>
             <?php endforeach; ?>
            </select>  
            <label class="mt-3 mb-0">NÍVEL:</label>
            <select  name="nivel" class="mt-2 p-1">
              <option selected disabled>SELECIONE UMA NÍVEL...</option>
              <option>1</option>
              <option>2</option>
            </select>  
            <label class="mt-3 mb-2">USUARIO:</label> 
            <input type="text" class="form-control-dark mb-1 " name="usuario">    

            <label class="mt-3 mb-2">SENHA:</label>
            <input type="text" class="form-control-dark mb-2" name="senha"> 
            <label class="mt-3 mb-2">CONFIRMAR SENHA:</label>
            <input type="text" class="form-control-dark mb-2" name="confirma_senha">     
            </div> 
            <div class="text-center">  
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraAluno.php" ></a>
            </div>   
          </div>
        </form>        
  </main>
        
  <footer>

  </footer>
</body>
</html>