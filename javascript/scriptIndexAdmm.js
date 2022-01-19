$("#pesquisar").click(function(){  
  $("#close").click()
  let mostrar = document.getElementById('mostrar');
  mostrar.innerText = "";
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
function criaAjax(pesquisa){
  
    if(pesquisa == 'aluno'){
      var tabela = 'aluno'
    }
    if(pesquisa == 'autor'){
      var tabela = 'autor'
    }
    if(pesquisa == 'editora'){
      var tabela = 'editora'
    }
    if(pesquisa == 'livro'){
      var tabela = 'livro'
    }
    if(pesquisa == 'login'){
      var tabela = 'login'
    }

    console.log(tabela)
    
    $.ajax({
      url: '../publico/pesquisa/pesquisar.php',
      type: 'post',
      dataType: 'json',
      data: {
        'titulo' : $("#txPesquisar").val(),
        'tabela' : tabela
      }
    }).success(function(data){
      console.log(data)
      paginacao(data, tabela)
    })
    
}
function verMais(titulo){
    $("#txPesquisar").val(titulo)
    mostraEscondidosVerMais()
    criaAjax()
    $("#txPesquisar").val('')
    $("#todosLivros").attr('class', 'd-none')
}
function paginacao(data, tabela){
  if(tabela == 'aluno'){
    montarAluno(data)
  }
  if(tabela == 'autor'){
    montarAutor(data)
  }
  if(tabela == 'editora'){
    montarEditora(data)
  }
  if(tabela == 'livro'){
    montarLivro(data)
  }
  if(tabela == 'login'){
    montarLogin(data)
  }
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
function check(){
      var checados = [];
      $.each($("input[name='check']:checked"), function(){            
          checados.push($(this).val());
      });
      return checados;
}
function montarAluno(data){
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
    let td_telefone = tr.insertCell()

    arr.id = (i + 1);
    arr.nome = (i + 1);
    arr.sobrenome = (i + 1);
    arr.telefone = (i + 1);

    id = arr[i]['id']
    nome = arr[i]['nome']  
    sobrenome = arr[i]['sobrenome']
    telefone = arr[i]['telefone']

    td_id.innerText = data[i]['id']
    td_nome.innerText = data[i]['nome']
    td_sobrenome.innerText = data[i]['sobrenome']
    td_telefone.innerText = data[i]['telefone']
  
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
function montarAutor(data){
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
    
        arr.id = (i + 1);
        arr.nome = (i + 1);
        arr.sobrenome = (i + 1);
    
        id = arr[i]['id']
        nome = arr[i]['nome']  
        sobrenome = arr[i]['sobrenome']
    
        td_id.innerText = data[i]['id']
        td_nome.innerText = data[i]['nome']
        td_sobrenome.innerText = data[i]['sobrenome']
      
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
function montarEditora(data){
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
      let td_telefone = tr.insertCell()
  
      arr.id = (i + 1);
      arr.nome = (i + 1);
      arr.telefone = (i + 1);
  
      id = arr[i]['id']
      nome = arr[i]['nome']  
      telefone = arr[i]['telefone']
  
      td_id.innerText = data[i]['id']
      td_nome.innerText = data[i]['nome']
      td_telefone.innerText = data[i]['telefone']
    
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
function montarLivro(data){
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
function montarLogin(data){
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
    let td_id_usuario = tr.insertCell()
    let td_nivel = tr.insertCell()

    arr.id = (i + 1);
    arr.nome = (i + 1);
    arr.id_usuario = (i + 1);
    arr.nivel = (i + 1);

    id = arr[i]['id']
    nome = arr[i]['nome']
    id_usuario = arr[i]['id_usuario']  
    nivel = arr[i]['nivel']

    td_id.innerText = data[i]['id']
    td_nome.innerText = data[i]['nome']
    td_id_usuario.innerText = data[i]['id_usuario']
    td_nivel.innerText = data[i]['nivel']
  
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