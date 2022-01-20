$("#salvar").click(function(){
  var id = $("#id_usuario").val()
  var nome = $("#nome").val()
  var sobrenome = $("#sobrenome").val()
  var cpf = $("#cpf").val()
  var telefone = $("#telefone").val()

  $.ajax({
    url: '../../controle/insere/insereAluno.php',
    type: 'post',
    dataType: 'json',
    data: {
            'id' : id, 
          'nome' : nome,
     'sobrenome' : sobrenome,
           'cpf' : cpf,
      'telefone' : telefone
    }
  }).success(function(data){
    if(data.erro == false){
      $("#message").attr('class', 'text-center text-success')
      limpaCampos()
    }else{
      $("#message").attr('class', 'text-center text-danger')
    }  
      $("#message").html(data.message)
      
  })
})
$("#ver").click(function(){
  $(".tituloModal").html("VISUALIZAR CADASTROS DE ALUNOS")
})
function limpaCampos(){
  $("#nome").val(null)
  $("#sobrenome").val(null)
  $("#cpf").val(null)
  $("#telefone").val(null)
  $("#message").html('')
}
function cancelar(){
  limpaCampos()
}
$(function(){
  $.ajax({
    url: '../../controle/mostra/mostraAlunos.php',
    type: 'post',
    dataType: 'json',
    data: {
      'livros' : true
    }
  }).success(function(data){
    paginacao(data)
  })
  $("#ver").mouseenter(function(){
    $("#ver").attr("class", "text-danger botoes text-uppercase border float-left rounded bg-transparent")
  })
  $("#ver").mouseout(function(){
    $("#ver").attr("class", "text-primary botoes text-uppercase border float-left rounded bg-transparent")
  })
})
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
			let td_nome = tr.insertCell()
			let td_sobrenome = tr.insertCell()
			let td_cpf = tr.insertCell()
      let td_telefone = tr.insertCell()
      let td_alterar = tr.insertCell()
      let td_excluir = tr.insertCell()

			arr.id = (i + 1);
			arr.nome = (i + 1);
			arr.sobrenome = (i + 1);
			arr.cpf = (i + 1);
      arr.telefone = (i + 1);
      arr.alterar = (i + 1);
      arr.excluir = (i + 1);
	
			id = arr[i]['id']
			nome = arr[i]['nome']  
			sobrenome = arr[i]['sobrenome']
			cpf = arr[i]['cpf']
      telefone = arr[i]['telefone']

			td_id.innerText = data[i]['id']
			td_nome.innerText = data[i]['nome']
			td_sobrenome.innerText = data[i]['sobrenome']
			td_cpf.innerText = data[i]['cpf']
      td_telefone.innerText = data[i]['telefone']
      td_alterar.innerHTML = "<button class='text-decoration-none bg-transparent text-danger glyphicon glyphicon-check col-1 b border-0 mt-2 reservar' data-toggle='modal' data-target='#usuario' id='" + data[i]['id'] + "' onclick=alterar('" + data[i]['id'] + "')></button>"
      td_excluir.innerHTML = "<button class='text-decoration-none bg-transparent text-danger glyphicon glyphicon-trash col-1 b border-0 mt-2 reservar' data-toggle='modal' data-target='#usuario' id='" + data[i]['id'] + "' onclick=excluir('" + data[i]['id'] + "')></button>"

      td_id.classList.add('text-center')
      td_alterar.classList.add('text-center')
      td_excluir.classList.add('text-center')

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