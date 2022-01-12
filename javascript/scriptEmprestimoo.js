function finalizar(){
	var dias = $("#dias").val()
	var userId = $("#userId").val()
	var checked = check()
	var id_livro = $("#idLivroUnico").val()

	$.ajax({
		url: '../../controle/insere/insereEmprestimo.php',
		type: 'post',
		dataType: 'json',
		data: {
			'id_aluno' : userId,
			'id_livros' : checked,
			'id_livro' : id_livro,
			'dias_devolucao' : dias
		}
	}).success(function(data){
		if(data.erro == false){
			$('#message').attr('class', 'd-flex justify-content-center text-success')
		}else{
			$('#message').attr('class', 'd-flex justify-content-center text-danger')
		}
		$("#message").html(data.message)
		console.log(data.message)
		mostrarLivros()
		$("#dias").prop('selectedIndex',0);
		$("#idLivroUnico").val(null)
	})
	$(".close").click()
}
$(function(){
	mostrarLivros()
})
function mostrarLivros(){
	$.ajax({
		url: '../../controle/mostra/mostraEmprestimo.php',
		type: 'post',
		dataType: 'json'
	}).success(function(data){
		paginacao(data)
	})
}
function paginacao(data){
	var arr = data
	let mostrar = document.getElementById('mostrar')

	mostrar.innerText = ""

	var tamanhoPagina = 5;
	var pagina = 0;
	var paginaInicial = pagina 
  var paginaFinal = Math.ceil(arr.length / tamanhoPagina - 1);
  
	function paginar() {
		$('table > tbody > tr').remove();

		for (var i = pagina * tamanhoPagina; i < arr.length && i < (pagina + 1) *  tamanhoPagina; i++) {

			let tr = mostrar.insertRow()

      let td_idCheck = tr.insertCell()
			let td_id = tr.insertCell()
			let td_titulo = tr.insertCell()
			let td_autor = tr.insertCell()
			let td_editora = tr.insertCell()
			let td_emprestar = tr.insertCell()

			arr.id = (i + 1);
			arr.titulo = (i + 1);
			arr.autor = (i + 1);
			arr.editora = (i + 1);
			arr.emprestar = (i + 1);
	
			id = arr[i]['id']
			titulo = arr[i]['titulo']  
			autor = arr[i]['autor']
			editora = arr[i]['editora']
			emprestar = arr[i]['id']

			td_idCheck.innerHTML = "<input type='checkbox' class='teste' name='check' id='" + data[i]['id'] + "' value='" + data[i]['id'] + "'>"
			td_id.innerText = data[i]['id']
			td_titulo.innerText = data[i]['titulo']
			td_autor.innerText = data[i]['autor']
			td_editora.innerText = data[i]['editora']
			td_emprestar.innerHTML = "<button class='text-decoration-none bg-transparent text-danger glyphicon glyphicon-check col-1 b border-0 mt-2 reservar' data-toggle='modal' data-target='#usuario' id='" + data[i]['id'] + "' onclick=empresta('" + data[i]['id'] + "')></button>"
		
			td_idCheck.classList.add('check','text-center')
			td_id.classList.add('text-center')
			td_titulo.classList.add('text-capitalize')
			td_autor.classList.add('text-capitalize')
			td_editora.classList.add('text-capitalize')

		}
		$('#numeracao').text((pagina +1));
	}
	function ajustarBotoes() {
		$('#primeiro').prop('disabled', arr.length <= tamanhoPagina || pagina == 0);
		$('#anterior').prop('disabled', arr.length <= tamanhoPagina || pagina == 0);
		$('#proximo').prop('disabled', pagina >= arr.length / tamanhoPagina - 1);
    	$('#ultimo').prop('disabled', pagina >= arr.length / tamanhoPagina - 1);
	}
	$(function() {
		$('#primeiro').click(function() {
			if (pagina > 0) {
				pagina = paginaInicial;
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
		$('#proximo').click(function() {
			if (pagina < arr.length / tamanhoPagina - 1) {
				pagina++;
				paginar();
				ajustarBotoes();
			}
		});
		$('#ultimo').click(function() {
			if (pagina < paginaFinal) {
				pagina = paginaFinal;
				paginar();
				ajustarBotoes();
			}
		});
		paginar();
		ajustarBotoes();
	});  
}
function check(){
	var checados = [];
			$.each($("input[name='check']:checked"), function(){            
					checados.push($(this).val());
			});
			return checados;

}
function empresta(id){
	$("#idLivroUnico").val(id)
}