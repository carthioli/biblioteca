<?php
    include "../header/header.php";
?>
  <title>Cadastra Login</title>
</head>
<body>
  <header>
      <div id="message"></div>
      <div class="container col-6 text-center">
        <h4>CADASTRAR LOGIN</h4>
      </div>
  </header>
  <main>
      <div class="container col-3  border p-3 rounded">
        <form>
          <div class="d-flex flex-column">
            <label>NOME:</label>
            <select id="id_usuario" name="id_usuario" class="p-1" >
               <option selected disabled>SELECIONE UM ALUNO...</option>
            </select>  
            <label class="mt-3 mb-0">NÍVEL:</label>
            <select id="nivel" name="nivel" class="mt-2 p-1">
              <option selected disabled>SELECIONE UM NÍVEL...</option>
              <option>1</option>
              <option>2</option>
            </select>  
            <label class="mt-3 mb-2">USUARIO:</label> 
            <input type="text" class="form-control-dark mb-1" id="usuario" name="usuario">    
            <label class="mt-3 mb-2">SENHA:</label>
            <input type="password" class="form-control-dark mb-2" id="senha" name="senha"> 
            <label class="mt-3 mb-2">CONFIRMAR SENHA:</label>
            <input type="password" class="form-control-dark mb-2" id="confirma_senha" name="confirma_senha">     
            </div> 
            <div class="text-center">  
              <input type="button" id="salvar" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar()" value="CANCELAR" class="mt-2"><a href="cadastraAluno.php" ></a>
            </div>   
          </div>
        </form>        
  </main>
  <!--<table class="table table-striped table-bordered border mt-5" id="tabela_livro">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">ID</th>
          <th class="text-center">NÍVEL</th>
          <th class="text-center">NOME USUARIO</th>
          <th class="text-center">USUARIO</th>
          <th class="text-center">AÇÕES</th>
        </tr>  
      </thead>
      <tbody>

      </tbody>
  </table>   -->
        
  <footer>
    <script src="../../javascript/scriptCadLogin.js"></script>              
  </footer>
</body>
</html>
