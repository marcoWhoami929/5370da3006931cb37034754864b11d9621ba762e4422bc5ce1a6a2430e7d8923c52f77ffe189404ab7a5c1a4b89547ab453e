<?php
error_reporting(E_ALL);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaOportunidades{


	public function mostrarTablas(){	

 		$oportunidades = ControladorGeneral::ctrMostrarOportunidades();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($oportunidades); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			if ($oportunidades[$i]["comision"] != 0) {

				$comision = ($oportunidades[$i]["comision"] * $oportunidades[$i]["monto"])/100;
			}else{
				$comision = $oportunidades[$i]["comision"];
			}

			if (str_replace('%','',$oportunidades[$i]["porcentaje"]) <= 39) {
				$indicador =  "<button type='button' class='btn btn-danger btn-sm'></button>";
			}else if(str_replace('%','',$oportunidades[$i]["porcentaje"]) >= 40 || str_replace('%','',$oportunidades[$i]["porcentaje"]) <= 69){
				$indicador =  "<button type='button' class='btn btn-warning btn-sm'></button>";
			}else{
				$indicador =  "<button type='button' class='btn btn-success btn-sm'></button>";
			}

			/******VERIFICAR SI LA FECHA DE CIERRE YA PASO*****/

			$fechaActual =	date('Y-m-d');
			$fechaCierre =   $oportunidades[$i]["cierreEstimado"];

			if ($fechaActual < $fechaCierre) {
				$cierreEstimado = "<strong>".$oportunidades[$i]["cierreEstimado"]."</strong>";
			}else{
				$cierreEstimado = "<strong style='color:red'>".$oportunidades[$i]["cierreEstimado"]."</strong>";
			}
		
		
			$item = "idProspecto";
	 		$valor = $oportunidades[$i]["idProspecto"];
	 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

	 		$seguimiento = $obtenerUltimoSeguimiento["titulo"];

	 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			$fecha = new DateTime("now");
			$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
			$diferencia = $fechaOperacion -> diff($fecha);
	
			$transcurrido = ControladorGeneral::formatearFecha($diferencia);

			if ($oportunidades[$i]["productos"] != "") {
				$productos = "<button type='button' class='btn btn-success btn-sm btnVisualizarProductos' data-toggle='modal' data-target='#visualizarProductos' idOportunidad='".$oportunidades[$i]["id"]."'>Visualizar</button>";
			}else{
				$productos = "<button type='button' class='btn btn-danger btn-sm'>Sin Productos</button>";
			}

			$datosJson	 .= '[
				      "'.($i+1).'",
				      "<strong>'.$oportunidades[$i]["nombre"].'</strong><br><em>'.$oportunidades[$i]["taller"].'</em>",
				      "<strong>'.$oportunidades[$i]["correo"].'</strong><br><em>'.$oportunidades[$i]["telefono"].'</em>",
				      "<strong>'.$oportunidades[$i]["concepto"].'</strong>",
				      "<strong>'.$oportunidades[$i]["fase"].'</strong><br><em>'.$oportunidades[$i]["origen"].'</em>",
				      "<strong>$'.number_format($oportunidades[$i]["monto"],2).'</strong>",
				      "<strong>$'.number_format($comision,2).'</strong>",
				      "'.$oportunidades[$i]["porcentaje"].'<br>'.$indicador.'",
				      "'.$cierreEstimado.'",
				      "<strong>'.$transcurrido.'</strong>'.$seguimiento.'",
				      "'.$productos.'",
				      "'.$oportunidades[$i]["agente"].'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaOportunidades();
$activar -> mostrarTablas();
