<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaClientes{


	public function mostrarTablas(){	

 		$clientes = ControladorGeneral::ctrMostrarClientes();

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($clientes); $i++){

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/
			$item = "idProspecto";
	 		$valor = $clientes[$i]["id"];
	 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

	 		$seguimiento = $obtenerUltimoSeguimiento["titulo"];

	 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			$fecha = new DateTime("now");
			$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
			$diferencia = $fechaOperacion -> diff($fecha);
	
			$transcurrido = ControladorGeneral::formatearFecha($diferencia);

			$ultimaCompra = "<strong>Ultima Compra ".$obtenerUltimoSeguimiento["fecha"]."</strong> <em>(Hace ".$transcurrido.")</em>";

			

			$datosJson	 .= '[
				      "'.$clientes[$i]["id"].'",
				      "<strong>'.$clientes[$i]["nombreCompleto"].'</strong><br><em>'.$clientes[$i]["taller"].'</em>",
				      "<strong>'.$clientes[$i]["correo"].'</strong><br><em>'.$clientes[$i]["celular"].'</em>",
				      "<strong>'.$clientes[$i]["fase"].'</strong><br><em>'.$clientes[$i]["origen"].'</em>",
				      "<strong>$'.number_format($clientes[$i]["monto"],2).'</strong>",
				      "<strong>$'.number_format($clientes[$i]["ventaPromedio"],2).'</strong>",
				      "'.$ultimaCompra.'",
				      "'.$clientes[$i]["agente"].'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

$activar = new TablaClientes();
$activar -> mostrarTablas();



