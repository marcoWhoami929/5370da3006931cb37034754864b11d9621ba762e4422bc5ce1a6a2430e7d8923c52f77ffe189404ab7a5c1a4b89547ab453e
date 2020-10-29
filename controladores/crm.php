<?php

error_reporting(E_ALL);
class ControladorGeneral{

	/**
	 * MOSTAR PROSPECTOS
	 */
	static public function ctrMostrarProspectos(){
		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarProspectos($tabla);

		return $respuesta;
	}

	/**
	 * MOSTRAR OPORTUNIDADES
	 */
	static public function ctrMostrarOportunidades(){
		$tabla = "oportunidades";

		$respuesta = ModeloGeneral::mdlMostrarOportunidades($tabla);

		return $respuesta;
	}
	/**
	 * MOSTRAR CLIENTES
	 */
	static public function ctrMostrarClientes(){
		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarClientes($tabla);

		return $respuesta;
	}
	/**
	 * MOSTRAR VENTAS
	 */
	static public function ctrMostrarVentas(){
		$tabla = "ventas";

		$respuesta = ModeloGeneral::mdlMostrarVentas($tabla);

		return $respuesta;
	}

	/**
	 * MOSTRAR CARTERA DE CLIENTES
	 */
	static public function ctrMostrarCarteraClientes(){
		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarCarteraClientes($tabla);

		return $respuesta;
	}

	/**
	 * MOSTRAR SEGUIMIENTOS
	 */
	static public function ctrMostrarSeguimientos($item,$valor){
		$tabla = "seguimientos";

		$respuesta = ModeloGeneral::mdlMostrarSeguimientos($tabla,$item,$valor);

		return $respuesta;
	}
	/* OBTENER LOS DATOS DE LOS INDICADORES */
	static public function ctrObtenerIndicadores($table,$campos,$parametros){

		$tabla = $table;

		$respuesta = ModeloGeneral::mdlObtenerIndicadores($table,$campos,$parametros);

		return $respuesta;
	}
	/***FORMATEAR LAS FECHAS***/
	static public function formatearFecha($diferencia) {

    $str = '';
    $str .= ($diferencia->invert == 1) ? ' - ' : '';
    if ($diferencia->y > 0) {
        // years
        $str .= ($diferencia->y > 1) ? $diferencia->y . ' Años ' : $diferencia->y . ' Año ';
    } if ($diferencia->m > 0) {
        // month
        $str .= ($diferencia->m > 1) ? $diferencia->m . ' Meses ' : $diferencia->m . ' Mes ';
    } if ($diferencia->d > 0) {
        // days
        $str .= ($diferencia->d > 1) ? $diferencia->d . ' Dias ' : $diferencia->d . ' Dia ';
    } if ($diferencia->h > 0) {
        // hours
        $str .= ($diferencia->h > 1) ? $diferencia->h . ' Horas ' : $diferencia->h . ' Hora ';
    } if ($diferencia->i > 0) {
        // minutes
        $str .= ($diferencia->i > 1) ? $diferencia->i . ' Minutos ' : $diferencia->i . ' Minuto ';
    } if ($diferencia->s > 0) {
        // seconds
        $str .= ($diferencia->s > 1) ? $diferencia->s . ' Segundos ' : $diferencia->s . ' Segundo ';
    }

    return $str;
	}
	/****FORMATEAR LAS FECHAS****/
	/* OBTENER TOTALES CERTEZAS*/
	static public function ctrObtenerTotalCertezas($table,$campos,$parametros){

		$tabla = $table;

		$respuesta = ModeloGeneral::mdlObtenerTotalCertezas($table,$campos,$parametros);

		return $respuesta;
	}
	/* MOSTRAR VENTAS TOTALES*/
	static public function ctrMostrarVentasTotales(){

		$tabla = "ventas";

		$respuesta = ModeloGeneral::mdlMostrarVentasTotales($tabla);

		return $respuesta;
	}
	/***DESGLOSE PRODUCTOS COTIZACIONES Y VENTAS******/
	static public function ctrVisualizarDesgloseProductos($tabla,$item,$valor){

		$respuesta = ModeloGeneral::mdlVisualizarDesgloseProductos($tabla,$item,$valor);

		return $respuesta;
	}
	/**
	 * MOSTRAR EVENTOS PENDIENTES
	 */
	static public function ctrMostrarEventosPendientes(){

		$respuesta = ModeloGeneral::mdlMostrarEventosPendientes();

		return $respuesta;
	}
	/**
	 * MOSTRAR EVENTOS GENERALES
	 */
	static public function ctrMostrarEventosGenerales(){

		$respuesta = ModeloGeneral::mdlMostrarEventosGenerales();

		return $respuesta;
	}
	/**
	 * MOSTRAR LISTA EVENTOS
	 */
	static public function ctrMostrarListaEventos($agente){

		$respuesta = ModeloGeneral::mdlMostrarListaEventos($agente);

		return $respuesta;
	}
	/*
	MOSTRAR EVENTOS DE CALENDARIO
	 */
	static public function ctrMostrarEventosCalendario($tabla,$campos,$alias,$referencia){

		$respuesta = ModeloGeneral::mdlMostrarEventosCalendario($tabla,$campos,$alias,$referencia);

		return $respuesta;

	}
	/*
	OBTENER DETALLES DE EVENTO
	 */
	static public function ctrObtenerDetallesEvento($tabla,$item,$valor,$campos){

		$respuesta = ModeloGeneral::mdlObtenerDetallesEvento($tabla,$item,$valor,$campos);

		return $respuesta;

	}
	/*
	OBTENER DETALLES DE EVENTO FINALIZADO
	 */
	static public function ctrObtenerDetallesEventoFinalizado($tabla,$item,$valor){

		$respuesta = ModeloGeneral::mdlObtenerDetallesEventoFinalizado($tabla,$item,$valor);

		return $respuesta;

	}
	/*
	MOSTRAR PROSPECTOS DESCARTADOS
	 */
	static public function ctrMostrarDescartados(){

		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarDescartados($tabla);

		return $respuesta;

	}
	/*
	MOSTRAR BITACORA
	 */
	static public function ctrMostrarBitacora(){

		$tabla = "bitacora";

		$respuesta = ModeloGeneral::mdlMostrarBitacora($tabla);

		return $respuesta;

	}
	/*
	MOSTRAR SEGUIMIENTOS
	 */
	static public function ctrMostrarHistorialSeguimientos(){

		$tabla = "seguimientos";

		$respuesta = ModeloGeneral::mdlMostrarHistorialSeguimientos($tabla);

		return $respuesta;

	}
	/*
	MOSTRAR DIRECTORIO
	 */
	static public function ctrMostrarDirectorio(){

		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarDirectorio($tabla);

		return $respuesta;

	}
	/*
	MOSTRAR PROSPECTOS CON SEGUIMIENTOS
	 */
	static public function ctrMostrarProspectosConSeguimientos(){

		$tabla = "prospectos";

		$respuesta = ModeloGeneral::mdlMostrarProspectosConSeguimientos($tabla);

		return $respuesta;

	}
	/*
	OBTENER LOS SEGUIMIENTOS DE CADA PROSPECTO
	 */
	static public function ctrObtenerListadoSeguimientos($item,$valor){

		$tabla = "seguimientos";

		$respuesta = ModeloGeneral::mdlObtenerListadoSeguimientos($tabla,$item,$valor);

		return $respuesta;

	}
	/** CAMBIOS 18/09/2020*/
	static public function ctrShowViews($table){
		
		$tabla = $table;

		$respuesta = ModeloGeneral::mdlShowViews($tabla);

		return $respuesta;
	}
	
}