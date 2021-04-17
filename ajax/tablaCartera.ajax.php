<?php
error_reporting(0);
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";

class TablaCartera{


	public function mostrarTablas(){

		$idagente = $_GET["agenteElegido"];

        if ($idagente != 0) {
            $parametros = "descartado = 0 AND p.idAgente = ".$idagente;
        }else{
            $parametros = "descartado = 0";
        }

        $cartera = ControladorGeneral::ctrMostrarCartera($parametros);
 		

 		$datosJson = '{

	 	"data": [ ';

	 	for($i = 0; $i < count($cartera); $i++){

	 		if ($cartera[$i]["estatus"] == 1) {
	 			$estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
	 		}else{
	 			$estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
	 		}

      /***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
	 		$item = "idProspecto";
	 		$valor = $cartera[$i]["id"];
	 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

	 		if ($obtenerUltimoSeguimiento["titulo"] == "" and $cartera[$i]["clasificacion"] = 1) {
	 			$seguimiento = "Nuevo prospecto creado apartir de encuesta blitz";
	 		}
      if($obtenerUltimoSeguimiento["titulo"] == "" and $cartera[$i]["clasificacion"] = 2){
        $seguimiento = "Sin seguimiento";
      }
      if($obtenerUltimoSeguimiento["titulo"] == "" and $cartera[$i]["clasificacion"] = 3){
        $seguimiento = "Sin seguimiento";
      }
      if($obtenerUltimoSeguimiento["titulo"] == "" and $cartera[$i]["clasificacion"] = 4){
        $seguimiento = "Sin seguimiento";
      }else{
	 			$seguimiento = $obtenerUltimoSeguimiento["titulo"];
	 		}

	 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			$fecha = new DateTime("now");
			$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
			$diferencia = $fechaOperacion -> diff($fecha);

			$transcurrido = ControladorGeneral::formatearFecha($diferencia);

      /*OBTENER LAS OPORTUNIDADES CREADAS*/
      $item = "idProspecto";
	 		$valor = $cartera[$i]["id"];
	 		$obtenerOportunidadesCreadas = ControladorGeneral::ctrObtenerOportunidadesCreadas($item,$valor);

      $cantidadOportunidades = $obtenerOportunidadesCreadas["cantidad"];
      $montoOportunidades = $obtenerOportunidadesCreadas["monto"];

      /*OBTENER LAS VENTAS CREADAS*/
      $item = "idOportunidad";
      $valor = $cartera[$i]["id"];
      $obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

      $cantidadVentas = $obtenerVentasCreadas["cantidad"];
      $montoVentas = $obtenerVentasCreadas["monto"];

      $item = "idOportunidad";
      $valor = $cartera[$i]["id"];
      $fechaUltimaVenta = ControladorGeneral::ctrUltimaVentaGenerada($item,$valor);

      if ($fechaUltimaVenta["fecha"] == "") {
        $fecha = "Sin venta";
      }else{
        $fecha = $fechaUltimaVenta["fecha"];
      }

      if ($cartera[$i]["oportunidad"] == 0 and $cartera[$i]["cliente"] == 0 ) {
        $fase = "Prospecto";
      }
      if ($cartera[$i]["oportunidad"] == 1 and $cartera[$i]["cliente"] == 0 ) {
        $fase = "Oportunidad";
      }
      if ($cartera[$i]["oportunidad"] == 1 and $cartera[$i]["cliente"] == 1 ) {
        $fase = "Cliente";
      }


        $contarVentas = ControladorGeneral::ctrContarVentas($item,$valor);
		    if ($contarVentas["contado"] == 0) {
		    	$grafico = "";
		    }else{

		      $grafico = "<button type='button' class='btn btn-secondary btn-sm btnVerGraficoVentas' idCartera='".$cartera[$i]["id"]."'  data-toggle='modal' data-target='#modalVentasProspectos'><i class='fa fa-eye'></i></button>";
		    }

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$cartera[$i]["id"].'",
				      "<strong>'.$cartera[$i]["nombreCompleto"].'</strong><br>'.$cartera[$i]["taller"].'",
				      "<strong>'.$cartera[$i]["nombreClasificacion"].'</strong>",
				      "'.$fase.'",
				      "<strong>'.$transcurrido.'</strong>'.$seguimiento.'",
              "'.$cantidadOportunidades.'",
              "$'.number_format($montoOportunidades,2).'",
              "'.$cantidadVentas.'",
              "$'.number_format($montoVentas,2).'",
              "'.$grafico.'",
              "'.$fecha.'",
				      "'.$cartera[$i]["agente"].'",
				      "'.$estado.'"

				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

 	}

}

$activar = new TablaCartera();
$activar -> mostrarTablas();
