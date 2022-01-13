<?php

    namespace Carlos\Biblioteca\App;

    use Carlos\Biblioteca\Model\Db;

    class Conexao 
    {

        private $host = null;
        private $dbname = null;
        private $user = null;
        private $password = null;
        private $port = null;

        private $link = null;

        public function __construct(  $host = '127.0.0.1', 
                                      $port = "5432",
                                      $dbname = "biblioteca",
                                      $user = "postgres",
                                      $password = "@1234bf"  ){

          $this->host = $host;
          $this->dbname = $dbname;
          $this->user = $user;
          $this->password = $password;
          $this->port = $port;

          $this->conecta();

        }

        public function conecta()
        {
            try {
              //$link = pg_connect("host=localhost port=2408 dbname=biblioteca user=postgres password=24082015");
              //$link = pg_connect("host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");
                $this->link = pg_connect("host={$this->host} port={$this->port} dbname={$this->dbname} user={$this->user} password=$this->password");
                return $this->link;
              } 
              catch (Exception $e) 
              {
                echo $e->getMessage();
              }
              catch (Erro $e)
              {
                echo $e->getMessage();
              }
        } 
        public function ultimoId( $tabela )
        {
            $query = pg_query("SELECT id, data_livro
                              FROM $tabela
                              ORDER BY 1 DESC");
            $result = pg_fetch_assoc( $query );

            if( $result ){
              return $result;
            }
            else {
              return false;
            }
        }   
        public function validar( $id, $senha)
        {
          $query = pg_query("SELECT id_usuario, senha
                             FROM login
                             WHERE id_usuario = ($id) AND (senha = '".$senha."')");
          $result = pg_fetch_assoc( $query );

          if( $result == true ){
            return true;
          }else{
            return false;
          }
          
        }
    }
?>