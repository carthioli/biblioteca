$(function(){
	mostrarLivros()
})
function mostrarLivros(){
	$.ajax({
		url: '../../controle/mostra/mostraEmprestimos.php',
		type: 'post',
		dataType: 'json'
	}).success(function(data){
		console.log(data)
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

			let td_id = tr.insertCell()
			let td_titulo = tr.insertCell()
			let td_autor = tr.insertCell()
			let td_editora = tr.insertCell()
      let td_data_emprestimo = tr.insertCell()
			let td_data_entrega = tr.insertCell()
      let td_msg_devolucao = tr.insertCell()
      let td_aluno = tr.insertCell()

			arr.id = (i + 1);
			arr.titulo = (i + 1);
			arr.autor = (i + 1);
			arr.editora = (i + 1);
      arr.td_data_emprestimo = (i + 1);
			arr.data_entrega = (i + 1);
      arr.msg_devolucao = (i + 1);
      arr.aluno = (i + 1);
	
			id = arr[i]['id']
			titulo = arr[i]['titulo']  
			autor = arr[i]['autor']
			editora = arr[i]['editora']
      data_emprestimo = arr[i]['data_devolucao']
			data_entrega = arr[i]['data_devolucao']
      msg_devolucao = arr[i]['msg_devolucao']['status']
      aluno = arr[i]['aluno']

			td_id.innerText = data[i]['id']
			td_titulo.innerText = data[i]['titulo']
			td_autor.innerText = data[i]['autor']
			td_editora.innerText = data[i]['editora']
      td_data_emprestimo.innerText = data[i]['data_livro']
      td_data_entrega.innerText = data[i]['data_devolucao']
      td_msg_devolucao.innerText = data[i]['msg_devolucao']['status']
      td_aluno.innerText = data[i]['aluno']
		
			td_id.classList.add('text-center')
			td_titulo.classList.add('text-capitalize')
			td_autor.classList.add('text-capitalize')
			td_editora.classList.add('text-capitalize')
      td_data_emprestimo.classList.add('text-center')
      td_data_entrega.classList.add('text-center')
      td_msg_devolucao.classList.add('text-center', 'text-uppercase', data[i]['msg_devolucao']['cor'])
      td_aluno.classList.add('text-center', 'text-capitalize')

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
$("#cancelar").click(function(){
	$(".close").click()
})