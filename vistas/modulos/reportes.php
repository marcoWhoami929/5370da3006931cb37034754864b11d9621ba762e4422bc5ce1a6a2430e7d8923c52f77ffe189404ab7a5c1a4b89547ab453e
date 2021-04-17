<?php

require_once "../../controladores/reportes.php";
require_once "../../modelos/reportes.php";

require_once "../../controladores/crm.php";
require_once "../../modelos/crm.php";

if (isset($_GET["reporte"])) {
	$reporteSeguimientos = new ControladorReportes();
	$reporteSeguimientos -> ctrReporteSeguimientos();
}
if (isset($_GET["reporteTimeline"])) {
	$reporteTimeline = new ControladorReportes();
	$reporteTimeline -> ctrDescargarReporteTimeline();
}
/****************************************************/ 
if (isset($_GET["prospecto"])) {
	$reporteProspecto = new ControladorReportes();
	$reporteProspecto -> ctrReporteProspectos();
}
if (isset($_GET["oportunidades"])) {
	$reporteOportunidades = new ControladorReportes();
	$reporteOportunidades -> ctrReporteOportunidades();
}
if (isset($_GET["clientes"])) {
	$reporteClientes = new ControladorReportes();
	$reporteClientes -> ctrReporteClientes();
}
if (isset($_GET["ventasPorPeriodo"])) {
	$reporteVentasPeriodo = new ControladorReportes();
	$reporteVentasPeriodo -> ctrReporteVentasPorPeriodo();
}
if (isset($_GET["eventosCalendario"])) {
	$reporteEventosCalendario = new ControladorReportes();
	$reporteEventosCalendario -> ctrReporteEventosCalendario();
}
if (isset($_GET["pendientes"])){
	$reporteEventosPendientes = new ControladorReportes();
	$reporteEventosPendientes -> ctrReporteEventosPendientes();
}
if (isset($_GET["listaEventos"])) {
	$reporteListaEventos = new ControladorReportes();
	$reporteListaEventos -> ctrReporteListaEventos();
}
if (isset($_GET["descartados"])) {
	$reporteDescartados = new ControladorReportes();
	$reporteDescartados -> ctrReporteDescartados();
}
if (isset($_GET["bitacora"])) {
	$reporteBitacora = new ControladorReportes();
	$reporteBitacora -> ctrReporteBitacora();
}
if (isset($_GET["directorio"])) {
	$reporteDirectorio = new ControladorReportes();
	$reporteDirectorio -> ctrReporteDirectorio();
}
if (isset($_GET["historial"])) {
	$reporteHistorial = new ControladorReportes();
	$reporteHistorial ->ctrReporteHistorial();
}

if (isset($_GET["cartera"])) {
	$reporteCartera = new ControladorReportes();
	$reporteCartera -> ctrReporteCartera();
}



?>