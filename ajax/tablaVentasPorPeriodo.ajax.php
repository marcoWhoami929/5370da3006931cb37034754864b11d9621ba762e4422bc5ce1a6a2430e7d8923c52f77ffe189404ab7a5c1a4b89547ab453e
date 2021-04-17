<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaVentas{

	public function mostrarTablas(){
		$idAgente = $_GET["idAgente"];
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFin"];

        if ($idAgente != 0 && $fechaInicial != "" && $fechaFinal != "") {
            $parametros = "WHERE av.id = ".$idAgente." AND vt.fechaVenta BETWEEN '".$fechaInicial."%' AND '".$fechaFinal."%'";
        }else if ($idAgente == 0 && $fechaInicial != "" && $fechaFinal != "") {
            $parametros = "WHERE vt.fechaVenta BETWEEN '".$fechaInicial."%' AND '".$fechaFinal."%'";
        }else if ($idAgente != 0) {
            $parametros = "WHERE av.id = ".$idAgente;
        }else{
            $parametros = "";
        }

        $ventas = ControladorGeneral::ctrMostrarVentas($parametros);

 		$datosJson = '{

	 	"data": [ ';

	 	for($i = 0; $i < count($ventas); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			if ($ventas[$i]["estatusVenta"] == 1) {
				$estatus = "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-money-bill-wave'></i>Vigente</button>";

			}else{
				$estatus = "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-money-bill-wave'></i>Cancelada</button>";
			}

			if ($ventas[$i]["productos"] != "") {
				$productos = "<button type='button' class='btn btn-success btn-sm btnVisualizarProductos' data-toggle='modal' data-target='#visualizarProductos' idOportunidad='".$ventas[$i]["idOportunidadVenta"]."'>Visualizar</button>";
			}else{
				$productos = "<button type='button' class='btn btn-danger btn-sm'>Sin Productos</button>";
			}

			$datosJson	 .= '[
				      "'.($ventas[$i]["idVenta"]).'",
				      "<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $ventas[$i]["nombreCompleto"]).'</strong><br><em>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $ventas[$i]["taller"]).'</em>",
				      "<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $ventas[$i]["concepto"]).'</strong>",
				      "<strong>'.$ventas[$i]["serie"].'</strong><em>'.$ventas[$i]["folio"].'</em>",
				      "'.$ventas[$i]["fechaVenta"].'",
				      "'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $ventas[$i]["observaciones"]).'",
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
