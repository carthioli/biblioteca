$("#acessar").click(function(){
    $.ajax({
		url: '../controle/validacao/validacao.php',
		type: 'post',
		dataType: 'json',
		data: {
			'usuario' : $("#txUsuario").val(),
              'senha' : $("#txSenha").val()        
		}
	}).success(function(data){
        if (data.erro != true){
			$('#mostrar').attr('class', 'd-flex justify-content-center text-danger')
		}
        if (data.status == 1){
            $(location).attr('href', '../acesso/index.php')
        }else{
            if(data.status == 2){
                $(location).attr('href', 'index.php')
            }
        }
        $("#mostrar").html(data.message)
        console.log(data.message)
	})


})
function cancelar(campo1, campo2, campo3, campo4, campo5){

    document.getElementById(campo1).value = "";
    document.getElementById(campo2).value = "";
    document.getElementById(campo3).value = "";
    document.getElementById(campo4).value = "";
    document.getElementById(campo5).value = "";

}
