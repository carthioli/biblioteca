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
    
	mostraEscondidos()
	criaAjax('nome')	
	$("#txPesquisar").val('')
})
$("#close").click(function(){
	$("#close").attr('class', 'd-none')
	$("#tabela").attr('class', 'd-none')
	$("#paginacao").attr('class', 'd-none')
})
function criaAjax(campo){
	$.ajax({
		url: 'pesquisa/pesquisar.php',
		type: 'post',
		dataType: 'json',
		data: {
			'titulo' : $("#txPesquisar").val(),   
			 'campo' : campo	
		}
	}).success(function(data){
		paginacao(data)
	})
}
function verMais(titulo){
	$("#txPesquisar").val(titulo)
	mostraEscondidos()
	criaAjax('nome')
	$("#txPesquisar").val('')
}
$(function(){

	$.ajax({
		url: '../controle/mostra/mostraTodosLivros.php',
		type: 'post',
		dataType: 'json',
		data: {
			'titulo' : $("#txPesquisar").val()   
		}
	}).success(function(data){
		
		mostraTodosLivros(data)
	})
})
function paginacao(data){
	var arr = data
	let mostrar = document.getElementById('mostrar')

	mostrar.innerText = ""

	var tamanhoPagina = 5;
	var pagina = 0;

	function paginar() {
		$('table > tbody > tr').remove();

		for (var i = pagina * tamanhoPagina; i < arr.length && i < (pagina + 1) *  tamanhoPagina; i++) {

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
		$('#numeracao').text((pagina + 1));
	}
	function ajustarBotoes() {
		$('#proximo').prop('disabled', arr.length <= tamanhoPagina || pagina > arr.length / tamanhoPagina - 1);
		$('#anterior').prop('disabled', arr.length <= tamanhoPagina || pagina == 0);
	}
	$(function() {
		$('#proximo').click(function() {
			if (pagina < arr.length / tamanhoPagina - 1) {
				pagina++;
				paginar();
				ajustarBotoes();
			}
		});
		$('#anterior').click(function() {
			if (pagina > 0) {
				pagina--;
				paginar();
				ajustarBotoes();
			}
		});
		paginar();
		ajustarBotoes();
	});  
}
function mostraEscondidos(){
	$("#close").attr('class', 'close text-body')
	$("#tabela").attr('class', 'table table-bordered')
	$("#paginacao").attr('class', 'text-center')
}
function mostraTodosLivros(data){
	var mostraLivros = $("#todosLivros")

	var arr = data
		for (var i = 0; i < arr.length; i++) {
			var titulo = arr[i]['titulo']
			mostraLivros.append('<p class="border-bottom">' + arr[i]['titulo'] + ',  ' + arr[i]['autor'] + "<button class='float-right text-decoration-none' onclick='verMais("  + '"' + titulo + '"' + ")' >" + 'Ver mais' + '</button>' + "</p><br>")
		}
}
function cancelar(campo1, campo2, campo3, campo4, campo5){

    document.getElementById(campo1).value = "";
    document.getElementById(campo2).value = "";
    document.getElementById(campo3).value = "";
    document.getElementById(campo4).value = "";
    document.getElementById(campo5).value = "";

}
