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
    console.log(data)
  })
})