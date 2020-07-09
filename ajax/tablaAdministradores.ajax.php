<?php
error_reporting(0);
require_once "../controladores/administradores.php";
require_once "../modelos/administradores.php";

class TablaAdministradores{

	public function mostrarTablas(){	

		$item = null;
 		$valor = null;

 		$administradores = ControladorAdministradores::ctrMostrarAdministradores($item, $valor);


 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($administradores); $i++){

	 		if ($administradores[$i]["estado"] == 1) {
	 			$estado = "Activo";
	 		}else{
	 			$estado = "Inactivo";
	 		}

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$administradores[$i]["id"].'",
				      "'.$administradores[$i]["nombre"].'",
				      "'.$administradores[$i]["email"].'",
				      "'.$administradores[$i]["grupo"].'",
				      "'.$administradores[$i]["perfil"].'",
				      "'.$estado.'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaAdministradores();
$activar -> mostrarTablas();



