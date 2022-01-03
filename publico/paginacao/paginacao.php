<ul class="pagination">
    <li class="page-item">
    <input type="hidden" name="livro">
    <input type="hidden" name="pesquisar">    
    <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$primeira_pagina?>" aria-label="primeira">
        <span aria-hidden="true">Primeira</span>
    </button>
    </li>
    <li class="page-item">
    <button class="float-left page-link box-navegacao <?=$exibir_botao_inicio?>" type="submit" name="page" value="<?=$paginacao['pagina_anterior']?>" aria-label="Anterior">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Anterior</span>
    </button>
    </li>
    <?php  
    for ($i=$paginacao['range_inicial']; $i < $paginacao['range_final']; $i++):   
        $destaque = ($i == $paginacao['pagina_atual']);  
    ?>   
        <li class="page-item"><button class='float-left bg-white m-1 border-light text-primary box-numero <?=$destaque?>' name="page" type="submit" value="<?=$i?>"><?=$i?></button></li>
    <?php endfor; ?>  
    <li class="page-item">
    <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" type="submit" name="page" value="<?=$paginacao['proxima_pagina']?>" aria-label="proximo">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Próximo</span>
    </button>
    </li>
    <li class="page-item">
    <button class="float-left page-link box-navegacao <?=$exibir_botao_final?>" name="page" type="submit" value="<?=$paginacao['ultima_pagina']?>" aria-label="ultima">
        <span aria-hidden="true">Ultima</span>
    </button>
    </li>
</ul>