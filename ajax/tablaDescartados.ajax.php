<?php
error_reporting(E_ALL);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaDescartados{


	public function mostrarTablas(){	

 		$descartados = ControladorGeneral::ctrMostrarDescartados();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($descartados); $i++){

	 		if ($descartados[$i]["estatus"] == 0 && $descartados[$i]["descartado"] == 1) {
	 			$estado = "<button type='button' class='btn btn-danger btn-sm'>Descartado</button>";
	 		}else if ($descartados[$i]["estatus"] == 0 && $descartados[$i]["descartado"] == 0){
	 			$estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
	 		}else{
	 			$estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
	 		}


	 		$item = "idProspecto";
	 		$valor = $descartados[$i]["id"];
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
	 		

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$descartados[$i]["id"].'",
				      "<strong>'.$descartados[$i]["nombreCompleto"].'</strong><br>'.$descartados[$i]["taller"].'",
				      "<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $descartados[$i]["correo"]).'</strong><br>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $descartados[$i]["telefono"]).'",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $descartados[$i]["motivo"]).'",
				      "'.$descartados[$i]["origen"].'",
				      "<strong>'.$transcurrido.'</strong>'.$seguimiento.'",
				      "'.$descartados[$i]["agente"].'",
				      "'.$estado.'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaDescartados();
$activar -> mostrarTablas();



