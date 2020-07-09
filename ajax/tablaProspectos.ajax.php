<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaProspectos{


	public function mostrarTablas(){	

 		$prospectos = ControladorGeneral::ctrMostrarProspectos();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($prospectos); $i++){

	 		if ($prospectos[$i]["estatus"] == 1) {
	 			$estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
	 		}else{
	 			$estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
	 		}




	 		$item = "idProspecto";
	 		$valor = $prospectos[$i]["id"];
	 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

	 		if ($obtenerUltimoSeguimiento["titulo"] == "") {
	 			$seguimiento = "Nuevo prospecto creado apartir de encuesta blitz";
	 		}else{
	 			$seguimiento = $obtenerUltimoSeguimiento["titulo"];
	 		}

	 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			$fecha = new DateTime("now");
			$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
			$diferencia = $fechaOperacion -> diff($fecha);
	
			$transcurrido = ControladorGeneral::formatearFecha($diferencia);

			if ($prospectos[$i]["habilitado"] != 0) {
				$habilitado = "<button type='button' class='btn btn-success btn-sm btnHabilitarProspecto' idProspecto='".$prospectos[$i]["id"]."' estadoProspecto='0'><i class='fa fa-power-off'></i>Habilitado</button>";
			}else{

				$habilitado = "<button type='button' class='btn btn-danger btn-sm btnHabilitarProspecto' idProspecto='".$prospectos[$i]["id"]."' estadoProspecto='1'><i class='fa fa-power-off'></i>Deshabilitado</button>";
			}

	 		
	 		

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$prospectos[$i]["id"].'",
				      "<strong>'.$prospectos[$i]["nombreCompleto"].'</strong><br>'.$prospectos[$i]["taller"].'",
				      "<strong>'.$prospectos[$i]["correo"].'</strong><br>'.$prospectos[$i]["telefono"].'",
				      "'.$prospectos[$i]["fase"].'",
				      "'.$prospectos[$i]["origen"].'",
				      "<strong>'.$transcurrido.'</strong>'.$seguimiento.'",
				      "'.$prospectos[$i]["agente"].'",
				      "'.$habilitado.'",
				      "'.$estado.'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaProspectos();
$activar -> mostrarTablas();



