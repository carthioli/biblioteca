<?php
    include "header.php";
?>
    <main>
        <div class="container">
            <div class="p-5 mt-3 mb-5 border-bottom">

            </div>
        </div>
        <div class="grid">
            <div class="grid-item ml-5 mr-5 border-left g1">
                <div class="d-flex justify-content-center mt-5 rounded">
                    <form method="POST" action="recebe.php">
                        <input class="p-1" type="text" name="pesquisar" placeholder="Pesquisar...">   
                        <button class="btn glyphicon glyphicon-search text-body col-1"></button>
                    </form>
                </div><br>
                <div class="mt-5 ml-5">
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                <a class="p-3 text-decoration-none" href="#">Mais procurados</a><br>
                </div>
            </div>
            <div class="grid-item ml-5 border-right g2">
                <div class="container col-8 border-bottom p-2">
                    <div class="text-center container col-6">  
                        <img class="p-2" src="../img/divina.jpg">
                    </div> 
                    <h4>A divina comédia, de Dante Alighieri</h4>
                    <p>Um dos principais clássicos do mundo, A divina comédia não poderia 
                    ficar de fora da lista. Este livro é um poema épico e teológico. 
                    Escrito por Dante Alighieri no século XIV, um dos principais livros 
                    da literatura mundial é dividido em três partes: Inferno, Purgatório 
                    e Paraíso. Além do próprio autor, há outros três personagens principais. 
                    Na história, Virgílio é um guia no inferno e no purgatório, Beatriz 
                    atua no paraíso terrestre, enquanto São Bernardo, nas esferas celestes.</p>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
                <div class="container col-8 border-bottom p-2">
                    <div class="text-center container col-6">  
                        <img class="p-2" src="../img/romeu.jpg">
                    </div> 
                    <h4>Romeu e Julieta, de William Shakespeare</h4>
                    <p>A trama de Romeu e Julieta, primeira grande tragédia de William Shakespeare, é baseada em fatos ocorridos na própria cidade de Verona. Outros escritores, antes do bardo inglês, criaram enredos inspirados no destino dos dois jovens amantes que viveram um amor proibido de desfecho trágico devido à rivalidade das famílias Montechcchio (de Verona) e Capuleto (de Cremona). Mas nenhuma versão se compara à de Shakespeare que transformou uma história, aparentemente corriqueira em termos literários, numa obra-prima de dimensão universal.</p>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
                <div class="container col-8 border-bottom p-2">
                    <div class="text-center container col-6">  
                        <img class="p-2" src="../img/republica.jpg">
                    </div> 
                    <h4>A república, de Platão</h4>
                    <p>Se o centro nevrálgico da discussão e investigação desenvolvidas por Platão é, por certo, a cidade e as formas e estruturas do governo, os padrões de moral e de justiça que os conduzem e regulam o embate de seus interesses e a perfeita solução que lhes pode ser dada numa politeia ideal, não é menos verdade que os argumentos em torno do problema da tirania e da democracia encontram-se na pauta dos conflitos e dos debates de nossa contemporaneidade.</p>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
                <div class="container col-8 border-bottom p-2">
                    <div class="text-center container col-6">  
                        <img class="p-2" src="../img/nacoes.jpeg">
                    </div> 
                    <h4>A riqueza das nações, de Adam Smith</h4>
                    <p>O livro A riqueza das nações é um clássico de relevante interesse histórico no pensamento econômico. Trata-se, na verdade, de uma obra considerada por especialistas como “uma das grandes construções intelectuais da história moderna”. Ideias fundamentais, como a da divisão do trabalho ou a da organização natural da vida econômica, foram particularmente aprofundadas por Adam Smith.</p>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
                <div class="container col-8 border-bottom p-2">
                    <div class="text-center container col-6">  
                        <img class="p-2" src="../img/odisseia.jpg">
                    </div> 
                    <h4>Odisseia, de Homero</h4>
                    <p>Composta por volta do século VIII a.C., a Odisseia relata o complexo e aventuroso percurso de Odisseu, um herói grego, ao tentar regressar para Ítaca e para Penélope, sua esposa, após o fim da guerra. É um dos principais livros do mundo.</p>
                    <a class="float-right mr-5" href="#">Ler mais...</a><br>
                </div>
            </div>

            <div class="grid-item ml-5 mt-5 mr-5 border g3">
                <form method="POST" action="">
                    <div class="d-flex justify-content-center mt-3 rounded">
                        <textarea class="p-4" placeholder="Sugestão"></textarea>
                    </div><br>
                    <div class="d-flex justify-content-center rounded">
                        <input class="p-2" type="text" placeholder="Email:">   
                    </div>
                    <div class="d-flex justify-content-center mt-3 rounded">
                        <input class="p-2" type="submit">   
                    </div>
                </form>
            </div>
        </div>
      </div>
    </main>
      

</body>
</html>
   