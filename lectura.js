/*
* lectura json a api tar.mx
*/
$(function() {
   $(".resultado").html(':-)'); //ready
});
/* función que lee del api */
var leer = function(tipo) {
   var numero=0;
   if(tipo == 'dv') {
      numero = Math.floor((Math.random() * 1000000) + 1);
      $(".resultado").prepend('Consultando DV de '+numero+'\n');
   } else {
      $(".resultado").prepend('Consultando método '+tipo+'\n');
   }
   $.post("api.php", { metodo: tipo, number: numero }, function(m) {
      if(tipo == 'time') $(".resultado").prepend('<span class="respuesta">'+m.time+'</span>\n\n');
      else {
         //dibujamos...
         var botija = 'Número enviado: '+numero+'\n';
         botija += 'Dígito verificador (algoritmo de Luhn): '+m.dv+'\n';
         botija += 'Número + DV: '+m.numerocondv+'\n\n';
         $(".resultado").prepend(botija);
      }
      console.log(m);
   },'json'); //leemos JSON
}
