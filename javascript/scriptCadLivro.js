$("#salvar").click(function(){
    var titulo = $("#titulo").val()
    var id_autor = $("#id_autor").val()
    var id_editora = $("#id_editora").val()

  $.ajax({
    url: '../../controle/insere/insereLivro.php',
    type: 'post',
    dataType: 'json',
    data: {
    'titulo' : titulo,
  'id_autor' : id_autor,
'id_editora' : id_editora
    }
  }).success(function(data){
    if(data.erro == false){
      $("#message").attr('class', 'text-center text-success')
    }else{
      $("#message").attr('class', 'text-center text-danger')
    }  
      limpaCampos()
      $("#message").html(data.message)      
  })
})
function limpaCampos(){
  $("#titulo").val(null)
  $("#id_autor").prop('selectedIndex', 0)
  $("#id_editora").prop( 'selectedIndex', 0)
}
function cancelar(){
  limpaCampos()
}
function mostraAutores(){
  buscaAutores()
}
function mostraEditoras(){
  buscaEditoras()
}
function buscaAutores(){
  $.ajax({
    url: '../../controle/mostra/mostraAutor.php',
    type: 'post',
    dataType: 'json'
  }).success(function(data){
      montaOptionAutor(data)
  })
}
function buscaEditoras(){
  $.ajax({
    url: '../../controle/mostra/mostraEditora.php',
    type: 'post',
    dataType: 'json'
  }).success(function(data){
      montaOptionEditora(data)
  })
}
function montaOptionAutor(data){
  var arrAutor = data
  
  for( i=0; i<arrAutor.length; i++){
    $('#id_autor').append('<option class="autor_id text-capitalize" value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>')  
  }

}
function montaOptionEditora(data){
  var arr = data

  for( i=0; i<arr.length; i++){
    $('#id_editora').append('<option class="editora_id text-capitalize" value="' + data[i]['id'] + '">' + data[i]['nome'] + '</option>')  
  }

}
$(function(){
  mostraAutores()
  mostraEditoras()
})

