<?php
error_reporting(E_ALL);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaBitacora{


	public function mostrarTablas(){	

 		$bitacora = ControladorGeneral::ctrMostrarBitacora();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($bitacora); $i++){


	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$bitacora[$i]["id"].'",
				      "<strong>'.$bitacora[$i]["accion"].'</strong>",
				      "'.$bitacora[$i]["fecha"].'",
				      "'.$bitacora[$i]["agente"].'",
				      "'.$bitacora[$i]["prospecto"].'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaBitacora();
$activar -> mostrarTablas();



