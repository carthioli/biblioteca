$("#salvar").click(function(){
  var nome = $("#nome").val()
  var telefone = $("#telefone").val()

  $.ajax({
    url: '../../controle/insere/insereEditora.php',
    type: 'post',
    dataType: 'json',
    data: {
          'nome' : nome,
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
      console.log(data)
  })
})
function limpaCampos(){
  $("#nome").val(null)
  $("#telefone").val(null)
  $("#message").html('')
}
function cancelar(){
  limpaCampos()
}