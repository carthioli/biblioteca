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