<?php
error_reporting(E_ALL);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaDirectorio{


  public function mostrarTablas(){  

    $directorio = ControladorGeneral::ctrMostrarDirectorio();

    $datosJson = '{
     
    "data": [ ';

    for($i = 0; $i < count($directorio); $i++){

      if ($directorio[$i]["estatus"] == 0 && $directorio[$i]["descartado"] == 1) {
        $estado = "<button type='button' class='btn btn-danger btn-sm'>Descartado</button>";
      }else if ($directorio[$i]["estatus"] == 0 && $directorio[$i]["descartado"] == 0){
        $estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
      }else{
        $estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
      }

      $telefono = "<a href='tel:".$directorio[$i]["telefono"]."'><strong>".$directorio[$i]["telefono"]."</strong></a>";
      $celular = "<a href='tel:".$directorio[$i]["celular"]."'><em>".$directorio[$i]["celular"]."</em></a>";
      $correo = "<a href='mailto:".$directorio[$i]["correo"]."'><em>".$directorio[$i]["correo"]."</em></a>";

      /*=============================================
      DEVOLVER DATOS JSON
      =============================================*/

      $datosJson   .= '[
              "'.$directorio[$i]["id"].'",
              "<strong>'.$directorio[$i]["nombreCompleto"].'</strong><br><em>'.$directorio[$i]["taller"].'</em>",
              "<strong>'.$correo.'</strong>",
              "'.$telefono.'<br>'.$celular.'",
              "'.$directorio[$i]["domicilio"].'",
              "'.$directorio[$i]["agente"].'",
              "'.$estado.'"

            ],';

    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson.=  ']
        
    }'; 

    echo $datosJson;

  }

}

$activar = new TablaDirectorio();
$activar -> mostrarTablas();



