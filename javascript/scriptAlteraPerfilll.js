$("#salvar").click(function(){
  var id = $("#id_usuario").val()
  var nome = $("#nome").val()
  var sobrenome = $("#sobrenome").val()
  var telefone = $("#telefone").val()
  var usuario = $("#usuario").val()
  var senha_atual = $("#senha_atual").val()
  var senha_nova = $("#senha_nova").val()
  var senha_confirma = $("#senha_confirma").val()

  $.ajax({
    url: '../../controle/altera/alteraPerfil.php',
    type: 'post',
    dataType: 'json',
    data: {
            'id' : id, 
          'nome' : nome,
     'sobrenome' : sobrenome,
      'telefone' : telefone,
       'usuario' : usuario,
   'senha_atual' : senha_atual,
    'senha_nova' : senha_nova,
'senha_confirma' : senha_confirma        
    }
  }).success(function(data){
    if(data.erro == false){
      $("#message").attr('class', 'text-center text-success')
      $("#nome").val(data.aluno[0]['nome'])
      $("#sobrenome").val(data.aluno[0]['sobrenome'])
      $("#telefone").val(data.aluno[0]['telefone'])
      $("#usuario").val(data.perfil[0]['usuario'])
      $("#message").html(data.message)
      limpaCamposSenha()
    }else{
      $("#message").attr('class', 'text-center text-danger')
      $("#message").html(data.message)
      limpaCamposSenha()
    }

    

    console.log(data)

  })
})
function limpaCamposSenha(){
  $("#senha_atual").val('')
  $("#senha_nova").val('')
  $("#senha_confirma").val('')
}
function cancelar(){
  console.log($("#message"))
}