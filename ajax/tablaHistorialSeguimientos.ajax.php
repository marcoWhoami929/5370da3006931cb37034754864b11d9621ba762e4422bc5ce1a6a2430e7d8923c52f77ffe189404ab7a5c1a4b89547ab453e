<?php
error_reporting(E_ALL);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaHistorialSeguimientos{


	public function mostrarTablas(){	

 		$historial = ControladorGeneral::ctrMostrarHistorialSeguimientos();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($historial); $i++){


	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$historial[$i]["id"].'",
				      "<strong>'.$historial[$i]["titulo"].'</strong>",
				      "'.$historial[$i]["fecha"].'",
				      "'.$historial[$i]["agente"].'",
				      "'.$historial[$i]["prospecto"].'",
				      "'.$historial[$i]["accion"].'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaHistorialSeguimientos();
$activar -> mostrarTablas();



