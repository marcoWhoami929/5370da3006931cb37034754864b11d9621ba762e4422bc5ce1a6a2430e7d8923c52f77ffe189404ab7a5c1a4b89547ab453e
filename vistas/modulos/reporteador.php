<?php 
require_once "../../controladores/crm.php";
require_once "../../controladores/reporteador.php";
require_once "../../modelos/crm.php";
require_once "../../modelos/conexion.php";
require_once "../../classes/data.php";
class LoadReports{

	public $idAgente;
	public $clasificacion;
	public $fase;
	public $tipo;
	public function reporteCartera(){

		$idAgente = $this->idAgente;
		$clasificacion = $this->clasificacion;
		$fase = $this->fase;
		$tipo = $this->tipo;

		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteCartera($idAgente,$clasificacion,$fase,$tipo);
	}

	public $comentarios;
	public $fechaInicial;
	public $fechaFinal;
	public function reporteProspectos(){

		$idAgente = $this->idAgente;
		$comentarios = $this->comentarios;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteProspectos($idAgente,$comentarios,$fechaInicial,$fechaFinal);
	}

	public function reporteOportunidades(){

		$idAgente = $this->idAgente;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteOportunidades($idAgente,$fechaInicial,$fechaFinal);
	}

	public function reporteClientes(){

		$idAgente = $this->idAgente;
	
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteClientes($idAgente);
	}
	public function reporteVentasPeriodo(){

		$idAgente = $this->idAgente;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteVentasPeriodo($idAgente,$fechaInicial,$fechaFinal);
	}
	public $evento;
	public $nombre;
	public function reporteEventos(){

		$idAgente = $this->idAgente;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		$evento = $this->evento;
		$nombre = $this->nombre;
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteEventos($idAgente,$fechaInicial,$fechaFinal,$evento,$nombre);
	}
	public function reporteBitacora(){

		$idAgente = $this->idAgente;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		$nombre = $this->nombre;
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteBitacora($idAgente,$fechaInicial,$fechaFinal,$nombre);
	}
	public $accion;
	public function reporteSeguimientos(){

		$idAgente = $this->idAgente;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		$nombre = $this->nombre;
		$accion = $this->accion;
		$obtenerReporte = new ControllerReports();
		$obtenerReporte -> ctrDescargarReporteSeguimientos($idAgente,$fechaInicial,$fechaFinal,$nombre,$accion);
	}


}
if (isset($_GET["reporteCartera"])) {
		
		$cartera = new LoadReports();
		$cartera -> idAgente = $_GET["idAgente"];
		$cartera -> clasificacion = $_GET["clasificacion"];
		$cartera -> fase = $_GET["fase"];
		$cartera -> tipo = $_GET["tipo"];
		$cartera->reporteCartera();
}
if (isset($_GET["reporteProspectos"])) {
		
		$prospectos = new LoadReports();
		$prospectos -> idAgente = $_GET["idAgente"];
		$prospectos -> comentarios = $_GET["comentarios"];
		$prospectos -> fechaInicial = $_GET["fechaInicial"];
		$prospectos -> fechaFinal = $_GET["fechaFinal"];
		$prospectos->reporteProspectos();
}
if (isset($_GET["reporteOportunidades"])) {
		
		$oportunidades = new LoadReports();
		$oportunidades -> idAgente = $_GET["idAgente"];
		$oportunidades -> fechaInicial = $_GET["fechaInicial"];
		$oportunidades -> fechaFinal = $_GET["fechaFinal"];
		$oportunidades->reporteOportunidades();
}
if (isset($_GET["reporteClientes"])) {
		
		$clientes = new LoadReports();
		$clientes -> idAgente = $_GET["idAgente"];
		$clientes->reporteClientes();
}
if (isset($_GET["reporteVentasPeriodo"])) {
		
		$ventas = new LoadReports();
		$ventas -> idAgente = $_GET["idAgente"];
		$ventas -> fechaInicial = $_GET["fechaInicial"];
		$ventas -> fechaFinal = $_GET["fechaFinal"];
		$ventas->reporteVentasPeriodo();
}
if (isset($_GET["reporteEventos"])) {
		
		$eventos = new LoadReports();
		$eventos -> idAgente = $_GET["idAgente"];
		$eventos -> fechaInicial = $_GET["fechaInicial"];
		$eventos -> fechaFinal = $_GET["fechaFinal"];
		$eventos -> evento = $_GET["evento"];
		$eventos -> nombre = $_GET["nombre"];
		$eventos->reporteEventos();
}
if (isset($_GET["reporteBitacora"])) {
		
		$bitacora = new LoadReports();
		$bitacora -> idAgente = $_GET["idAgente"];
		$bitacora -> fechaInicial = $_GET["fechaInicial"];
		$bitacora -> fechaFinal = $_GET["fechaFinal"];
		$bitacora -> nombre = $_GET["nombre"];
		$bitacora->reporteBitacora();
}
if (isset($_GET["reporteSeguimientos"])) {
		
		$seguimientos = new LoadReports();
		$seguimientos -> idAgente = $_GET["idAgente"];
		$seguimientos -> fechaInicial = $_GET["fechaInicial"];
		$seguimientos -> fechaFinal = $_GET["fechaFinal"];
		$seguimientos -> nombre = $_GET["nombre"];
		$seguimientos -> accion = $_GET["accion"];
		$seguimientos->reporteSeguimientos();
}
 ?>