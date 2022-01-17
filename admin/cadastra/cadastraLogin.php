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
              <input type="submit" name="salvar" value="SALVAR" class="mt-3">  
              <input type="button" onclick="cancelar('nivel', 'id_usuario', 'usuario', 'senha', 'confirma_senha')" value="CANCELAR" class="mt-2"><a href="cadastraAluno.php" ></a>
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
                <th class="text-center">NOME USUARIO</th>
                <th class="text-center">USUARIO</th>
                <th class="text-center">AÇÕES</th>
              </tr>  
            </thead>
            <tbody>
              <tr>
              <?php foreach ( $logins as $login): ?>
                <td class="text-center"><input type="checkbox" name="id_login" value="<?php echo $login['id'];?>"></td>
                <td class="text-center"><?php echo $login['id'];?></td>
                <td><?php echo $login['nivel'];?></td>
                <td><?php echo $login['nome_usuario'];?></td>
                <td><?php echo $login['usuario'];?></td>   
                <td class="d-flex justify-content-center border-bottom-0">
                  <form method="POST" action="../controle/remove/removeLogin.php">
                    <input type="hidden" name="id_excluir" value="<?php echo $login['id'];?>"/>
                    <input class="float-left" name="excluir" onclick="excluir()" type="image" src="..//img/excluir.png" width="20px">
                  </form>
                </td>   
              </tr>
              <?php endforeach; ?>
            </tbody>
        </table>   
        <div class="text-center">   
          <nav aria-label="Navegação de página exemplo">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraLogin.php?page=<?=$primeira_pagina?>" aria-label="primeira">
                  <span aria-hidden="true">Primeira</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_inicio?>" href="cadastraLogin.php?page=<?=$pagina_anterior?>" aria-label="Anterior">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Anterior</span>
                </a>
              </li>
              <?php  
                for ($i=$range_inicial; $i <= $range_final; $i++):   
                  $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
              ?>   
                  <li class="page-item"><a class='box-numero <?=$destaque?>' href="cadastraLogin.php?page=<?=$i?>"><?=$i?></a> </li>
              <?php endfor; ?>  
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraLogin.php?page=<?=$proxima_pagina?>" aria-label="proximo">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Próximo</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link box-navegacao <?=$exibir_botao_final?>" href="cadastraLogin.php?page=<?=$ultima_pagina?>" aria-label="ultima">
                  <span aria-hidden="true">Ultima</span>
                </a>
              </li>
            </ul>
          </nav> 
        <div>    
  <footer>

  </footer>
</body>
</html>
