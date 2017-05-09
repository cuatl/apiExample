<?php
   /*
   * ejemplo simple de api
   * tar.mx
   */
   $msg = new stdclass;//nuevo objeto, regresará un mensaje en JSON
   if(isset($_POST['metodo']) && !strcmp($_POST['metodo'],'me')) {
      //llamada a "me"
      $msg->me = "Si, soy yo :-)";
      $msg->error=null; //no hay error.
   } elseif(isset($_POST['metodo']) && !strcmp($_POST['metodo'],'time')) {
      $msg->time = "Son las ".date('H:i:s')." en el servidor, no se en el tuyo.";
      $msg->error=null;
   } elseif(isset($_POST['metodo']) && !strcmp($_POST['metodo'],'dv')) {
      //devolvemos un dígito verificar usando el método de Luhn 
      //https://tar.mx/archivo/2016/crear-y-validar-numeros-de-longitud-fija-con-algoritmo-de-luhn.html
      if(!preg_match("/^[0-9]{1,}$/",$_POST['number'])) {
         $msg->error = 1;
         $msg->errormsg = $_POST['number']." - No es un número ··_";
      } else {
         function digito($digito) {
            $a=2; $sum = [];
            for($i=strlen($digito)-1;$i>=0;$i--) {
               $d =$digito[$i];
               if($a<1) { $a=2; }
               $sum[] = $d*$a; $a--;
            }
            $total = 0;
            foreach($sum AS $d) {
               if(strlen($d)==1) $total += $d;
               else { $da = str_split($d); foreach($da AS $one) { $total += $one; } }
            }
            $total %= 10; if($total != 0) $total = 10-$total; return $total;
         }
         $msg->numero = $_POST['number'];
         $msg->dv = digito($_POST['number']);
         $msg->numerocondv = $msg->numero.$msg->dv;
      }
   } else {
      $msg->error = "No se de qué hablas";
   }
   echo json_encode($msg,JSON_PRETTY_PRINT);//devuelve el resultado que sea, en formato JSON
   /*
   * este ejemplo se puede leer desde CURL: curl -X POST -d "metodo=data" https://tar.mx/apps/apiExample/api.php
   * donde data es el método a usar, en el ejemplo están disponibles: me, time, dv
   * en el caso de dv, habría que enviar algo como "metodo=dv&number=12345" (dos argumentos);
   */
