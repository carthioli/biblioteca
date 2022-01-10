function reservas(livro){
	var checked = check()
	var userId = $("#userId").val()

	$.ajax({
		url: '../../controle/insere/insereReserva.php',
		type: 'post',
		dataType: 'json',
		data: {
			'id_aluno'  : userId,
			'id_livros' : checked,
			'id_livro'  : livro
		}
	}).success(function(data){
		console.log(data)
		//$("#message").html(data.message)
		mostrarLivros()
	})
}
$(function(){
	mostrarLivros()
})
function mostrarLivros(){
	$.ajax({
		url: '../../controle/mostra/mostraReserva.php',
		type: 'post',
		dataType: 'json',
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
      let td_data_devolucao = tr.insertCell()
      let td_reservar = tr.insertCell()

			arr.id = (i + 1);
			arr.titulo = (i + 1);
			arr.autor = (i + 1);
			arr.editora = (i + 1);
      arr.data_devolucao = (i + 1);
      arr.reservar = (i + 1);
	
			id = arr[i]['id']
			titulo = arr[i]['titulo']  
			autor = arr[i]['autor']
			editora = arr[i]['editora']
      data_devolucao = arr[i]['data_devolucao']
      reservar = arr[i]['reservar']

			td_idCheck.innerHTML = "<input type='checkbox' class='teste' name='check' id='" + data[i]['id'] + "' value='" + data[i]['id'] + "'>"
			td_id.innerText = data[i]['id']
			td_titulo.innerText = data[i]['titulo']
			td_autor.innerText = data[i]['autor']
			td_editora.innerText = data[i]['editora']
      td_data_devolucao.innerText = data[i]['data_devolucao']
      td_reservar.innerHTML = "<button class='text-decoration-none bg-transparent text-danger glyphicon glyphicon-check col-1 b border-0 mt-2 reservar' id='" + data[i]['id'] + "' onclick=reserva('" + data[i]['id'] + "')></button>"

			td_idCheck.classList.add('check','text-center')
			td_id.classList.add('text-center')
			td_titulo.classList.add('text-capitalize')
			td_autor.classList.add('text-capitalize')
			td_editora.classList.add('text-capitalize')
      td_data_devolucao.classList.add('text-center')
      td_reservar.classList.add('text-center')

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
function reserva(id){
  reservas(id)
}

