<?php

    namespace Carlos\Biblioteca\App;

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Conexao;

    class Alterar
    {
      public function alterarAluno($id, $nome, $sobrenome, $telefone)
      {
       $link = new Conexao;
      
       $alterar = "UPDATE aluno
                        SET nome = ('$nome'), sobrenome = ('$sobrenome'), telefone = ($telefone)
                        WHERE id = $id";
       $alterou = pg_query( $link->conecta(), $alterar );  

       if( pg_affected_rows( $alterou ) ){
        $_SESSION['usuarioNome'] = $nome;
        $_SESSION['usuarioSobrenome'] = $sobrenome;
        $_SESSION['usuarioTelefone'] = $telefone;

            $dados[] = [
              'nome' => $nome,
         'sobrenome' => $sobrenome,
          'telefone' => $telefone     
            ];

        return $dados;

        }
      }
      public function alterarPerfil( $id, $usuario, $senha )
      {
        $link = new Conexao;

        $alterarLogin = "UPDATE login
                         SET nome = ('$usuario'), senha = ('$senha')
                         WHERE id_usuario = ($id)";
        $alterouLogin = pg_query( $link->conecta(), $alterarLogin );   

        if( pg_affected_rows( $alterou ) ){
          $_SESSION['usuarioUsuario'] = $_POST['usuario'];
  
              $dados[] = [
                'usuario' => $usuario,
                         ];
            return $dados;
        }
      }     
    }
               

                            
                            
?>
 