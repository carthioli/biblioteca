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
$("#sair").click(function(){
    $.ajax({
		url: '../controle/validacao/logout.php',
		type: 'post',
		dataType: 'json',
		data: {
			'sair' : true       
		}
	}).success(function(data){
        if(data.sair){
            $(location).attr('href', 'index.php')
        }
        
	})
})
$("#pesquisar").click(function(){
    event.preventDefault()
	$.ajax({
		url: 'pesquisa/pesquisar.php',
		type: 'post',
		dataType: 'json',
		data: {
			'titulo' : $("#txPesquisar").val()   
		}
	}).success(function(data){
        console.log(data)


		var arr = data
		let mostrar = document.getElementById('mostrar')
		
		$(".close").attr('class', 'close')
		$("#tabela").attr('class', 'table table-bordered')
		$("#paginacao").attr('class', 'text-center')

		mostrar.innerText = ""

		for (let i = 0; i < data.length; i++) {

			let tr = mostrar.insertRow()

			let td_id = tr.insertCell()
			let td_titulo = tr.insertCell()
			let td_autor = tr.insertCell()
			let td_editora = tr.insertCell()

			arr.id = (i + 1);
			arr.titulo = (i + 1);
			arr.autor = (i + 1);
			arr.editora = (i + 1);
	
			id = arr[i]['id']
			titulo = arr[i]['titulo']  
			autor = arr[i]['autor']
			editora = arr[i]['editora']

			td_id.innerText = data[i]['id']
			td_titulo.innerText = data[i]['titulo']
			td_autor.innerText = data[i]['autor']
			td_editora.innerText = data[i]['editora']
		
	
			td_id.classList.add('center')
	
		}        
	})
})
$(".close").click(function(){
	$(".close").attr('class', 'd-none')
	$("#tabela").attr('class', 'd-none')
	$("#paginacao").attr('class', 'd-none')
})


function cancelar(campo1, campo2, campo3, campo4, campo5){

    document.getElementById(campo1).value = "";
    document.getElementById(campo2).value = "";
    document.getElementById(campo3).value = "";
    document.getElementById(campo4).value = "";
    document.getElementById(campo5).value = "";

}
