<?php

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Pesquisar;

    $campo = $_POST['campo'];
    $livro = $_POST['titulo'];

    $livros = (new Pesquisar)->livroPesquisado($campo, $livro);

    echo json_encode($livros)
?>