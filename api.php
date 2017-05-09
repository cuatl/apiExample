<?php
   /*
   * ejemplo simple de api
   */
   $msg = new stdclass;//nuevo objeto, regresará un mensaje en JSON
   if(isset($_POST['me'])) {
      //llamada a "me"
      $msg->me = "Si, soy yo :-)";
      $msg->error=null; //no hay error.
   } elseif(isset($_POST['time'])) {
      $msg->time = "Son las ".date('H:i:s')." en el servidor, no se en el tuyo.";
      $msg->error=null;
   } elseif(isset($_POST['data'])) {
      //aquí digamos que obtenemos los datos de una db y ya los tenemos en un array();
      $data = [
         [
            'nombre' => 'Jorge',
            'apellido' => 'M.',
            'edad' => 39,
         ]
      ];
      $msg->data = $data; //asignamos el contenido de $data al objeto a regresar
      $msg->error = null;
   } else {
      $msg->error = "No se de qué hablas";
   }
   echo json_encode($msg,JSON_PRETTY_PRINT);//devuelve el resultado que sea, en formato JSON
   /*
   * este ejemplo se puede leer desde CURL: curl -X POST -d "data=1" https://tar.mx/apps/apiExample/api.php
   * donde data es el método a usar, en el ejemplo están disponibles: me, data, time
   */
