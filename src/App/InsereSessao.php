<?php
    
    namespace Carlos\Biblioteca\App;

    class InsereSessao
    {
        public function insereSessao($resultado, $nivel)
        {
            $_SESSION['Id'] = $resultado['id_usuario'];
            $_SESSION['usuarioId'] = $resultado['id'];
            $_SESSION['usuarioNome'] = $resultado['nome_usuario'];
            $_SESSION['usuarioUsuario'] = $resultado['nome'];
            $_SESSION['usuarioSobrenome'] = $resultado['sobrenome'];
            $_SESSION['usuarioNivel'] = $resultado['nivel'];
            $_SESSION['usuarioTelefone'] = $resultado['telefone'];
            $_SESSION['logado'] = $nivel;  
        }
    }