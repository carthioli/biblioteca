<?php
    include "../header/header.php";
?>
  <title>Cadastra Aluno</title>
</head>
<body>
  <header>
      <div class="container col-6 text-center">
        <h4>ALTERAR PERFIL</h4>
      </div>
  </header>
  <main>
      <div id='message'></div>
      <div class="container col-3  border p-3 rounded">
        <form>
          <div class="d-flex flex-column">
            <input type="hidden" id="id_usuario" name="id" value="<?php echo $_SESSION['Id']?>">
            <label class="mb-0 float-left">NOME:</label> 
            <input type="text" class="form-control-dark mb-2" id="nome" name="nome" value="<?php echo $_SESSION['usuarioNome']?>">
            <label class="mb-0">SOBRENOME:</label>
            <input type="text" class="form-control-dark mb-2" id="sobrenome" name="sobrenome" value="<?php echo $_SESSION['usuarioSobrenome']?>">
            <label class="mb-0">TELEFONE:</label>
            <input type="text" class="form-control-dark mb-2" id="telefone" name="telefone" value="<?php echo $_SESSION['usuarioTelefone']?>">
            <label class="mb-0">USUARIO:</label>
            <input type="text" class="form-control-dark mb-2" id="usuario" name="usuario" value="<?php echo $_SESSION['usuarioUsuario']?>">
            <label class="mb-0">SENHA ATUAL:</label>
            <input type="password" class="form-control-dark mb-2" id="senha_atual" name="senha_atual" autocomplete="on">
            <label class="mb-0">SENHA NOVA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha_nova" name="senha_nova" autocomplete="on">
            <label class="mb-0">CONFIRMAR SENHA NOVA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha_confirma" name="senha_confirma" autocomplete="on">
            </div> 
            <div class="text-center">  
              <input type="button" id="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2">
            </div>   
          </div>
        </form>        
  </main>     
  
        <script src="../../javascript/scriptAlteraPerfil.js"></script>      
  <footer>

  </footer>
</body>
</html>