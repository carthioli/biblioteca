<?php

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Pesquisar;

    $livro = $_POST['titulo'];

    if ( is_numeric($livro) ){
        $livros = (new Pesquisar)->livroPesquisadoId($livro);
    }else{
        $livros = (new Pesquisar)->livroPesquisadoNome($livro);
    }
    echo json_encode($livros)
?>