<?php
    include "telas/topo.php";
?>
<title>Login</title>
<body>
    <header>
        <div class="container-fluid bg-light border-bottom mb-5">
            <p class="navbar-brand text " href="index.php"><span class="glyphicon glyphicon-book text-danger"></span>&nbsp;  &nbsp;Biblioteca Digital</p> 
        </div>
    </header>
    <main>
    <div class="container col-4 d-flex justify-content-center border"> 
    <form>
      <fieldset class="w-100 text-center mt-5">
        <legend>Dados de Login</legend>
          <div class="text-center" id="mostrar"></div>
          <div class="">
          <label class="mb-3 mr-2" for="txUsuario">Usuário:</label>
            <input class="mb-3" type="text" name="usuario" id="txUsuario" maxlength="25" />
          </div>
          <div>  
          <label class="mt-3 mr-4" for="txSenha">Senha:</label>
            <input type="password" name="senha" id="txSenha"/>
          </div>
          <div class=" mt-5 mb-3">
            <button class="bg-danger text-white border-0 rounded p-2 w-50" type="button" id="acessar">ACESSAR</button>
          </div>
          <div class="mb-4">
            <a href="index.php">Esqueceu senha?</a>
          </div>
      </fieldset>
    </form>
    </div>
    </main>   
      
    <script src="../javascript/script.js"></script>
</body>
</html>
   
