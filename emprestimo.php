<?php
    include 'conexao.php';

      $livro = "INSERT INTO livro(nome, id_autor, id_editora) VALUES ('aaa', '1', '1')";
      pg_query($link, $livro);