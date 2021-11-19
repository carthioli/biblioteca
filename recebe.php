<?php

      include 'conexao.php';

      $nome = $_POST['nome'];
      $autor = $_POST['autor'];
      $editora = $_POST['editora'];
      
      $livro = "INSERT INTO livro(nome, id_autor, id_editora) VALUES ('{$nome}', '{$autor}', '{$editora}')";
      pg_query($link, $livro);

header('location:cadastra.php');