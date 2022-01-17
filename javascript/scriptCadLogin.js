$("#salvar").click(function(){
  var id_usuario = $("#id_usuario").val()
  var nivel = $("#nivel").val()
  var usuario = $("#usuario").val()
  var senha = $("#senha").val()
  var confirma_senha = $("#confirma_senha").val()

  $.ajax({
    url: '../../controle/insere/insereLogin.php',
    type: 'post',
    dataType: 'json',
    data: {
    'id_usuario' : id_usuario,
         'nivel' : nivel,
       'usuario' : usuario,
         'senha' : senha,
'confirma_senha' : confirma_senha
    }
  }).success(function(data){
    if(data.erro == false){
      $("#message").attr('class', 'text-center text-success')
      limpaCampos()
    }else{
      $("#message").attr('class', 'text-center text-danger')
      $("#senha").val(null)
      $("#confirma_senha").val(null)
    }  
      $("#message").html(data.message)
  })
})
function limpaCampos(){
  $("#id_usuario").prop('selectedIndex', 0)
  $("#nivel").prop( 'selectedIndex', 0)
  $("#usuario").val(null)
  $("#senha").val(null)
  $("#confirma_senha").val(null)
  $("#message").html('')
}
function cancelar(){
  limpaCampos()
}
function mostraNomes(){
  buscaNomes()
}
function buscaNomes(){
  $.ajax({
    url: '../../controle/mostra/mostraAlunos.php',
    type: 'post',
    dataType: 'json'
  }).success(function(data){
      montaOption(data)
  })
}
function montaOption(data){
  var arr = data
  
  console.log(data)
  for( i=1; i<arr.length; i++){
    $('#id_usuario').append('<option class="usuario_id text-capitalize" value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>')  
  }
}
$(function(){
  mostraNomes()
})

