<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaClientes{


	public function mostrarTablas(){
		$idAgente = $_GET["agente"];
            
        if ($idAgente != 0 ) {
                $parametros = "WHERE av.id= ".$idAgente." AND p.cliente = 1  and p.descartado != 1";
            }else{
                $parametros = "WHERE p.cliente = 1  and p.descartado != 1";
            }

        $clientes = ControladorGeneral::ctrMostrarClientes($parametros);


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

			/*OBTENER LAS OPORTUNIDADES CREADAS*/
			$item = "idProspecto";
			$valor = $clientes[$i]["id"];
			$obtenerOportunidadesCreadas = ControladorGeneral::ctrObtenerOportunidadesCreadas($item,$valor);

			$cantidadOportunidades = $obtenerOportunidadesCreadas["cantidad"];
			$montoOportunidades = $obtenerOportunidadesCreadas["monto"];

			/*OBTENER LAS VENTAS CREADAS*/
			$item = "idOportunidad";
			$valor = $clientes[$i]["id"];
			$obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

			$cantidadVentas = $obtenerVentasCreadas["cantidad"];
			$montoVentas = $obtenerVentasCreadas["monto"];

			if ($cantidadVentas == 0) {
				$ticketPromedio = 0;
			}else{
				$ticketPromedio = $montoVentas/$cantidadVentas;
			}


			$datosJson	 .= '[
				      "'.$clientes[$i]["id"].'",
				      "<strong>'.$clientes[$i]["nombreCompleto"].'</strong><br><em>'.$clientes[$i]["taller"].'</em>",
							"<strong>$'.number_format($ticketPromedio,2).'</strong>",
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
