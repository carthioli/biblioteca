$("#sair").click(function(){
  $.ajax({
  url: '../../controle/validacao/logout.php',
  type: 'post',
  dataType: 'json',
  data: {
    'sair' : true       
  }
}).success(function(data){
      if(data.sair){
          $(location).attr('href', '../index.php')
      }
      
})
})