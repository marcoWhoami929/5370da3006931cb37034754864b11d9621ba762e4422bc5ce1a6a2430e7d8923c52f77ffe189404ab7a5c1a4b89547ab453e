<?php

    include_once("../../../controladores/crm.php");
    include_once("../../../modelos/crm.php");


      $idProspecto = $_POST['idCartera'];

      $table = "ventas";
      $campos = "v.fechaVenta,v.montoTotal,p.nombreCompleto as v";
      $parametros = "as v INNER JOIN prospectos as p ON v.idOportunidad = p.id WHERE idOportunidad = ".$idProspecto." order by v.fechaVenta";
      $respuesta = ControladorGeneral::ctrObtenerDatosGraficoVentas($table,$campos,$parametros);

      echo json_encode($respuesta);




?>
