<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaEventosCalendario{


	public function mostrarTablas(){	

		$tabla = $_GET["tabla"];

		switch ($tabla) {
			case 'citas':
				$campos = "c.id,c.asunto,c.descripcion,c.fecha,c.hora,p.nombreCompleto as contacto,a.nombre as agente,c.finalizada";
				$alias = "c";
				break;
			case 'llamada':
				$campos = "ll.id,ll.titulo as asunto,ll.descripcion,ll.fecha,ll.hora,p.nombreCompleto as contacto,a.nombre as agente,ll.finalizada";
				$alias = "ll";
				break;
			case 'visitas':
				$campos = "v.id,v.asunto,v.descripcion,v.fecha,v.hora,p.nombreCompleto as contacto,a.nombre as agente,v.finalizada";
				$alias = "v";
				break;
			case 'recordatorios':
				$campos = "r.id,r.asunto,r.descripcion,r.fecha,r.hora,p.nombreCompleto as contacto,a.nombre as agente,r.finalizada";
				$alias = "r";
				break;
			case 'demostraciones':
				$campos = "d.id,d.asunto,d.descripcion,d.fecha,d.hora,p.nombreCompleto as contacto,a.nombre as agente,d.finalizada";
				$alias = "d";
				break;
		}
		$referencia = "INNER JOIN prospectos as p ON ".$alias.".idProspecto = p.id INNER JOIN agentesventas as a ON ".$alias.".idAgente = a.id";
 		$eventos = ControladorGeneral::ctrMostrarEventosCalendario($tabla,$campos,$alias,$referencia);

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($eventos); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/
			

			if ($eventos[$i]["finalizada"] != 1) {
				$finalizada =  "";
				$estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:red'></i>".$finalizada;
				
			}else{
				$finalizada =  "<button type='button' class='btn btn-warning btn-sm btnDetalleFinalizado' idEvento='".$eventos[$i]["id"]."' tabla='".$_GET["tabla"]."'><i class='fas fa-info'></i></button>";
				$estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:green'></i>".$finalizada;
				
			}
			if ($_GET["tabla"] == "llamada" || $_GET["tabla"] == "recordatorios") {
				$detalle =  "<button type='button' class='btn btn-info btn-sm' disabled><i class='fa fa-eye'></i></button>";
			}else{

				$detalle =  "<button type='button' class='btn btn-info btn-sm btnDetalleEvento' idEvento='".$eventos[$i]["id"]."' tabla='".$_GET["tabla"]."'><i class='fa fa-eye'></i></button>";
			}
			
			

			$datosJson	 .= '[
				      "'.$eventos[$i]["id"].'",
				      "<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["contacto"]).'</strong>",
				      "<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["asunto"]).'</strong>",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $eventos[$i]["descripcion"]).'",
				      "'.$eventos[$i]["fecha"].'",
				      "'.$eventos[$i]["hora"].'",
				      "'.$estatus.'",
				      "'.$detalle.'",
				      "'.$eventos[$i]["agente"].'"
				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaEventosCalendario();
$activar -> mostrarTablas();



