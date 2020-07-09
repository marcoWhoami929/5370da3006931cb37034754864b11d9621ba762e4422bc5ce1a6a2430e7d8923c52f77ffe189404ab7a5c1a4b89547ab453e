<?php

require_once("../controladores/crm.php");
require_once("../modelos/crm.php");
class AjaxFuncionesCrm{

	public $idOportunidad;
	public $tablaOportunidad;
	public function  visualizarDesgloseProductos(){

		$item = "id";
		$valor = $this->idOportunidad;
		$tabla = $this->tablaOportunidad;

		$respuesta = ControladorGeneral::ctrVisualizarDesgloseProductos($tabla,$item,$valor);

		echo json_encode($respuesta);

	}

	public $idEvento;
	public $tablaEvento;

	public function obtenerDetalleEvento(){

		$item = "id";
		$valor = $this->idEvento;
		$tabla = $this->tablaEvento;

		switch ($tabla) {
			case 'citas':
				$campos = "invitados,ubicacion,latitud,longitud";
				break;
			case 'visitas':
				$campos = "ubicacion,latitud,longitud";
				break;
			case 'demostraciones':
				$campos = "ubicacion,latitud,longitud,productos";
				break;
		}
		

		$respuesta =  ControladorGeneral::ctrObtenerDetallesEvento($tabla,$item,$valor,$campos);

		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

	}

	public $idEventoFinalizado;
	public $tablaEventoFinalizado;

	public function obtenerDetalleEventoFinalizado(){

		$item = "id";
		$valor = $this->idEventoFinalizado;
		$table = $this->tablaEventoFinalizado;

		if ($table == "Llamadas") {
			$tabla = "llamada";
		}else{
			$tabla = $table;
		}
		

		$respuesta = ControladorGeneral::ctrObtenerDetallesEventoFinalizado($tabla,$item,$valor);

		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

	}
	public $idProspectoTimeline;

	public function obtenerListadoSeguimientos(){

		$item = "idProspecto";
		$valor = $this->idProspectoTimeline;

		$respuesta = ControladorGeneral::ctrObtenerListadoSeguimientos($item,$valor);

		echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

	}
	/*=============================================
	HABILITAR PROSPECTO
	=============================================*/	

	public $idProspectoHabilitado;
	public $estadoProspecto;

	public function habilitarProspectoAgente(){

		$tabla = "prospectos";

		$item1 = "habilitado";
		$valor1 = $this->estadoProspecto;

		$item2 = "id";
		$valor2 = $this->idProspectoHabilitado;

		$respuesta = ModeloGeneral::mdlHabilitarProspecto($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

}

///////////////INSTANCIACIONES DE CLASES//////////////
if (isset($_POST["idOportunidad"])) {
	
	$desglose = new AjaxFuncionesCrm();
	$desglose -> idOportunidad = $_POST["idOportunidad"];
	$desglose -> tablaOportunidad = $_POST["tablaOportunidad"];
	$desglose -> VisualizarDesgloseProductos();

}
if (isset($_POST["idEvento"])) {
	$detalleEvento =  new AjaxFuncionesCrm();
	$detalleEvento -> idEvento = $_POST["idEvento"];
	$detalleEvento -> tablaEvento = $_POST["tablaEvento"];
	$detalleEvento -> obtenerDetalleEvento();
}
if (isset($_POST["idEventoFinalizado"])) {
	$detalleFinalizacion =  new AjaxFuncionesCrm();
	$detalleFinalizacion -> idEventoFinalizado = $_POST["idEventoFinalizado"];
	$detalleFinalizacion -> tablaEventoFinalizado = $_POST["tablaEventoFinalizado"];
	$detalleFinalizacion -> obtenerDetalleEventoFinalizado();
}
if (isset($_POST["idProspectoTimeline"])) {
	$listadoSeguimientos =  new AjaxFuncionesCrm();
	$listadoSeguimientos -> idProspectoTimeline = $_POST["idProspectoTimeline"];
	$listadoSeguimientos -> obtenerListadoSeguimientos();
}

if(isset($_POST["idProspectoHabilitado"])){

	$habilitarProspecto = new AjaxFuncionesCrm();
	$habilitarProspecto -> idProspectoHabilitado = $_POST["idProspectoHabilitado"];
	$habilitarProspecto -> estadoProspecto = $_POST["estadoProspecto"];
	$habilitarProspecto -> habilitarProspectoAgente();

}

?>
