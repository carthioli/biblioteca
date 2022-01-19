<?php

    include "../../vendor/autoload.php";

    use Carlos\Biblioteca\App\Pesquisar;

    $pesquisa = $_POST['titulo'];

    $tabela = $_POST['tabela'];

    switch( $tabela ){
        case 'aluno':
            if ( is_numeric($pesquisa) ){
                $pesquisas = (new Pesquisar)->alunoPesquisadoId($pesquisa);
            }else{
                $pesquisas = (new Pesquisar)->alunoPesquisadoNome($pesquisa);
            }
            echo json_encode($pesquisas);
        break;
        case 'autor':
            if ( is_numeric($pesquisa) ){
                $pesquisas = (new Pesquisar)->autorPesquisadoId($pesquisa);
            }else{
                $pesquisas = (new Pesquisar)->autorPesquisadoNome($pesquisa);
            }
            echo json_encode($pesquisas);
        break;        
        case 'editora':
            if ( is_numeric($pesquisa) ){
                $pesquisas = (new Pesquisar)->editoraPesquisadoId($pesquisa);
            }else{
                $pesquisas = (new Pesquisar)->editoraPesquisadoNome($pesquisa);
            }
            echo json_encode($pesquisas);
        break;
        case 'livro':
            if ( is_numeric($pesquisa) ){
                $pesquisas = (new Pesquisar)->livroPesquisadoId($pesquisa);
            }else{
                $pesquisas = (new Pesquisar)->livroPesquisadoNome($pesquisa);
            }
            echo json_encode($pesquisas);
        break;   
        case 'login':
            if ( is_numeric($pesquisa) ){
                $pesquisas = (new Pesquisar)->loginPesquisadoId($pesquisa);
            }else{
                $pesquisas = (new Pesquisar)->loginPesquisadoNome($pesquisa);
            }
            echo json_encode($pesquisas);
        break; 

    }
    
?>