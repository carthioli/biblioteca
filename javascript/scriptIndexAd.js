$("#pesquisar").click(function(){
  mostraEscondidos()
  criaAjax(check())	
  $(".check").attr("checked", false);
  $("#txPesquisar").val('')
  $("#todosLivros").attr('class', 'd-none')
})
$("#close").click(function(){
  $("#close").attr('class', 'd-none')
  $("#tabela").attr('class', 'd-none')
  $("#paginacao").attr('class', 'd-none')
  $("#todosLivros").attr('class', 'container col-8 p-2')
})
var url = ""
  function criaAjax(pesquisa){
    console.log(pesquisa)
    
    if( pesquisa == 'livro' ){
      url = '../publico/pesquisa/pesquisar.php';
    }
    
    $.ajax({
      url: url,
      type: 'post',
      dataType: 'json',
      data: {
        'titulo' : $("#txPesquisar").val()
      }
    }).success(function(data){
      paginacao(data)
    })
    
  }
  function verMais(titulo){
    $("#txPesquisar").val(titulo)
    mostraEscondidosVerMais()
    criaAjax()
    $("#txPesquisar").val('')
    $("#todosLivros").attr('class', 'd-none')
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
      
        td_id.classList.add('text-center')
    
      }
      $('#numeracao').text((pagina + 1));
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
function mostraEscondidosVerMais(){
  $("#close").attr('class', 'close text-body')
  $("#tabela").attr('class', 'table table-bordered')
}
function mostraEscondidos(){
  $("#close").attr('class', 'close text-body')
  $("#tabela").attr('class', 'table table-bordered')
  $("#paginacao").attr('class', 'text-center')
}
function cancelar(campo1, campo2, campo3, campo4, campo5){

  document.getElementById(campo1).value = "";
  document.getElementById(campo2).value = "";
  document.getElementById(campo3).value = "";
  document.getElementById(campo4).value = "";
  document.getElementById(campo5).value = "";

}
function check(){
  var checados = [];
      $.each($("input[name='check']:checked"), function(){            
          checados.push($(this).val());
      });
      return checados;
}
  