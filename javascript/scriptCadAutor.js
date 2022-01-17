$("#salvar").click(function(){
  var nome = $("#nome").val()
  var sobrenome = $("#sobrenome").val()
  var cpf = $("#cpf").val()

  $.ajax({
    url: '../../controle/insere/insereAutor.php',
    type: 'post',
    dataType: 'json',
    data: {
          'nome' : nome,
     'sobrenome' : sobrenome,
           'cpf' : cpf
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
function limpaCampos(){
  $("#nome").val(null)
  $("#sobrenome").val(null)
  $("#cpf").val(null)
  $("#message").html('')
}
function cancelar(){
  limpaCampos()
}