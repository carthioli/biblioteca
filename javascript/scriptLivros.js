$(function(){

	$.ajax({
		url: '../controle/mostra/mostraTodosLivros.php',
		type: 'post',
		dataType: 'json',
		data: {
			'livros' : true  
		}
	}).success(function(data){
		mostraTodosLivros(data)
	})
})
function mostraTodosLivros(data){
	var mostraLivros = $("#todosLivros")

	var arr = data
		for (var i = 0; i < arr.length; i++) {
			var titulo = arr[i]['id']
			mostraLivros.append('<p class="border-bottom text-uppercase">' + arr[i]['titulo'] + ',  ' + arr[i]['autor'] + "<button class='float-right btn p-1' onclick='verMais("  + '"' + titulo + '"' + ")' >" + 'Ver mais' + '</button>' + "</p><br>")
		}
}
