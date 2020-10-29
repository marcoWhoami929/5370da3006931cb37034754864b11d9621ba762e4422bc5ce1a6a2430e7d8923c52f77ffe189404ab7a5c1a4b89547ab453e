<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaVentas{

	public function mostrarTablas(){	

 		$ventas = ControladorGeneral::ctrMostrarVentas();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($ventas); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			if ($ventas[$i]["estatusVenta"] == 1) {
				$estatus = "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-money-bill-wave'></i></button>";

			}else{
				$estatus = "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-money-bill-wave'></i></button>";
			}

			if ($ventas[$i]["productos"] != "") {
				$productos = "<button type='button' class='btn btn-success btn-sm btnVisualizarProductos' data-toggle='modal' data-target='#visualizarProductos' idOportunidad='".$ventas[$i]["idOportunidadVenta"]."'>Visualizar</button>";
			}else{
				$productos = "<button type='button' class='btn btn-danger btn-sm'>Sin Productos</button>";
			}

			$datosJson	 .= '[
				      "'.($ventas[$i]["idVenta"]).'",
				      "<strong>'.$ventas[$i]["nombreCompleto"].'</strong><br><em>'.$ventas[$i]["taller"].'</em>",
				      "<strong>'.$ventas[$i]["concepto"].'</strong>",
				       "<strong>'.$ventas[$i]["serie"].'</strong><em>'.$ventas[$i]["folio"].'</em>",
				      "'.$ventas[$i]["fechaVenta"].'",
				      "'.$ventas[$i]["observaciones"].'",
				      "<strong> $ '.number_format($ventas[$i]["montoTotal"],2).'</strong>",
				      "'.$ventas[$i]["cerradoDia"].'",
				      "'.$ventas[$i]["agente"].'",
				      "'.$productos.'",
				      "'.$estatus.'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaVentas();
$activar -> mostrarTablas();



