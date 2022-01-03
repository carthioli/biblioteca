$("#acessar").click(function(){
    event.preventDefault()
    $.ajax({
        url: 'validacao.php',
        type: 'post',
        dataType: 'html',
        data: {
            'metodo': $('#metodo').val(),
            'usuario': $('#usuario').val(),
            'senha': $('#senha').val()
        }

    }).success(function(data){
        
        alert(data);
    });

    
})
function cancelar(campo1, campo2, campo3, campo4, campo5){

    document.getElementById(campo1).value = "";
    document.getElementById(campo2).value = "";
    document.getElementById(campo3).value = "";
    document.getElementById(campo4).value = "";
    document.getElementById(campo5).value = "";

}
