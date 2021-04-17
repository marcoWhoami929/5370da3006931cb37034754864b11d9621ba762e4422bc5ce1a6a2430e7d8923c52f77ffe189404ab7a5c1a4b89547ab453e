<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaEventos{


	public function mostrarTablas(){	

 		$eventos = ControladorGeneral::ctrMostrarEventosGenerales();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($eventos); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/
			$evento = $eventos[$i]["evento"];
			switch ($evento) {
				case 'citas':
					$evento =  "<button type='button' class='btn btn-primary btn-sm'><i class='fa fa-calendar'></i></button>";
					break;
				case 'llamada':
					$evento =  "<button type='button' class='btn btn-success btn-sm'><i class='fa fa-phone-volume'></i></button>";
					break;
				case 'visitas':
					$evento =  "<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-map-marked-alt'></i></button>";
					break;
				case 'demostraciones':
					$evento =  "<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-fill-drip'></i></button>";
					
					break;
				case 'recordatorios':
					$evento =  "<button type='button' class='btn btn-info btn-sm'><i class='fa fa-stopwatch'></i></button>";
					break;

			}

			if ($eventos[$i]["estatus"] == 1) {
				$estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:green'></i>";
			}else{
				$estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:red'></i>";
			}
			
			

			$datosJson	 .= '[
				      "'.$evento.'",
				      "'.$eventos[$i]["id"].'",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["prospecto"]).'",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["asunto"]).'",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["descripcion"]).'",
				      "'.$eventos[$i]["fecha"].'",
				      "'.$eventos[$i]["hora"].'",
				      "'.$estatus.'",
				      "'.$eventos[$i]["agente"].'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaEventos();
$activar -> mostrarTablas();



