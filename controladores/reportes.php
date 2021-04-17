<?php 
class ControladorReportes{


	public function ctrReporteSeguimientos(){

		if(isset($_GET["reporte"])){
			
			$tabla = $_GET["reporte"];

			$reporte = ModeloReportes::mdlReporteSeguimientos($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Seguimientos Prospectos";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["reporte"] == "seguimientos"){	

				$camposTabla = ['Seguimiento','Fecha','Prospecto','Agente','Comentarios'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; S E G U I M I E N T O S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					echo utf8_decode("<tr>
										<td style='color:black;'>".$value["titulo"]."</td>
										<td style='color:black;'>".$value["fecha"]."</td>
										<td style='color:black;'>".$value["prospecto"]."</td>
										<td style='color:black;'>".$value["agente"]."</td>
										<td style='color:black;'>".$value["comentario"]."</td>
										
							
										</tr>");

									
	
	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}

	public function ctrDescargarReporteTimeline(){

		if(isset($_GET["reporteTimeline"])){
			
			$tabla = $_GET["reporteTimeline"];

			$idProspecto = $_GET["idProspecto"];

			$reporte = ModeloReportes::mdlReporteTimeline($tabla,$idProspecto);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Seguimientos";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["reporteTimeline"] == "seguimientos"){	

				$camposTabla = ['Seguimiento','Fecha','Prospecto','Agente','Comentarios','Tiempo Transcurrido'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; S E G U I M I E N T O S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
					$fecha = new DateTime("2020-07-24 09:00:00");
					$fechaOperacion = new DateTime($value["fecha"]);
					$diferencia = $fecha -> diff($fechaOperacion);
			
					$transcurrido = ControladorGeneral::formatearFecha($diferencia);

					echo utf8_decode("<tr>
										<td style='color:black;'>".$value["titulo"]."</td>
										<td style='color:black;'>".$value["fecha"]."</td>
										<td style='color:black;'>".$value["prospecto"]."</td>
										<td style='color:black;'>".$value["agente"]."</td>
										<td style='color:black;'>".$value["comentario"]."</td>
										<td style='color:black;'>".$transcurrido."</td>
										
							
										</tr>");

									
	
	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/*******************************************************************************************************/
	/**
	 * REPORTE DE TABLA PROSPECTOS
	 */
	public function ctrReporteProspectos(){

		if(isset($_GET["prospecto"])){
			
			$tabla = $_GET["prospecto"];

			$idAgente = $_GET["agente"];
			
			if ($idAgente != 0 ) {
			$parametros = "WHERE p.idAgente= ".$idAgente." AND p.origenProspecto = op.id AND p.faseProspecto = fp.id and oportunidad = 0 and cliente = 0 and descartado = 0" ;
			}else{
				$parametros = "WHERE p.origenProspecto = op.id AND p.faseProspecto = fp.id and oportunidad = 0 and cliente = 0 and descartado = 0";
			}

			$reporte = ModeloReportes::mdlReporteProspectos($tabla,$parametros);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Prospectos";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["prospecto"] == "prospectos"){	

				$camposTabla = ['#','Nombre/Taller','Comentarios','Fase','Origen','Ultimo Contacto','Ejecutivo','Habilitado','Estatus'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; P R O S P E C T O S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					$item = "idProspecto";
			 		$valor = $value["id"];
			 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

			 		if ($obtenerUltimoSeguimiento["titulo"] == "") {
			 			$seguimiento = "Sin Contacto";
			 		}else{
			 			$seguimiento = $obtenerUltimoSeguimiento["titulo"];
			 		}
					/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
					$fecha = new DateTime("now");
					$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
					$diferencia = $fecha -> diff($fechaOperacion);
			
					$transcurrido = ControladorGeneral::formatearFecha($diferencia);

					if ($value["habilitado"] != 0) {
						$habilitado = "Habilitado";
					}else{
						$habilitado = "Deshabilitado";
					}
					if ($value["estatus"] == 1) {
						$estado = "Activo";
					}else{
						$estado = "Inactivo";
					}

					echo utf8_decode("<tr>
						<td style='color:black;text-align:center;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;text-align:justify;'><strong>".$value["comentario"]."</strong></td>
						<td style='color:black;'>".$value["fase"]."</td>
						<td style='color:black;'>".$value["origen"]."</td>
						<td style='color:black;'><strong>".$transcurrido."</strong>".$seguimiento."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$habilitado."</td>
						<td style='color:black;'>".$estado."</td>
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA OPORTUNIDADES
	 */
	public function ctrReporteOportunidades(){

		if(isset($_GET["oportunidades"])){
			
			$tabla = $_GET["oportunidades"];
			$idAgente = $_GET["agente"];
			$fechaInicial = $_GET["fechaInicial"];
			$fechaFinal = $_GET["fechaFin"];

			if ($idAgente != 0 && $fechaInicial != "" && $fechaFinal != "") {
				$parametros = "WHERE av.id = ".$idAgente." AND o.fecha BETWEEN '".$fechaInicial."%' AND '".$fechaFinal."%' AND p.id = o.idProspecto and p.descartado = 0 " ;
			}else if ($idAgente == 0 && $fechaInicial != "" && $fechaFinal != "") {
				$parametros = "WHERE o.fecha BETWEEN '".$fechaInicial."%' AND '".$fechaFinal."%' AND p.id = o.idProspecto and p.descartado = 0";
			}else if ($idAgente != 0) {
				$parametros = "WHERE av.id = ".$idAgente;
			}else{
				$parametros = "WHERE p.id = o.idProspecto and p.descartado = 0";
			}

			$reporte = ModeloReportes::mdlReporteOportunidades($tabla,$parametros);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Oportunidades";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["oportunidades"] == "oportunidades"){	

				$camposTabla = ['#','Nombre/Taller','Concepto','Fecha','Monto','Comision','Certeza','Cierre Estimado','Ultimo Contacto','Productos','Ejecutivo'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; O P O R T U N I D A D E S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {
					$item = "idProspecto";
			 		$valor = $value["idProspecto"];
			 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);


					/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
					$fecha = new DateTime("now");
					$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
					$diferencia = $fechaOperacion -> diff($fecha);
			
					$transcurrido = ControladorGeneral::formatearFecha($diferencia);

					$seguimiento = $obtenerUltimoSeguimiento["titulo"];

					if ($value["comision"] != 0) {

						$comision = ($value["comision"] * $value["monto"])/100;
					}else{
						$comision = $value["comision"];
					}

					$fechaActual =	date('Y-m-d');
					$fechaCierre =   $value["cierreEstimado"];

					if ($fechaActual < $fechaCierre) {
						$cierreEstimado = "<strong>".$value["cierreEstimado"]."</strong>";
					}else{
						$cierreEstimado = "<strong style='color:red'>".$value["cierreEstimado"]."</strong>";
					}

					$i = 0;
					$id = $i+1;

					if ($value["productos"] != "") {
						$productos = $value["productos"];
					}else{
						$productos = "Sin Productos";
					}
					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombre"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'>".$value["concepto"]."</td>
						<td style='color:black;'><strong>".$value["fecha"]."</strong></td>
						<td style='color:black;'>".number_format($value["monto"],2)."</td>
						<td style='color:black;'>".number_format($comision,2)."</td>
						<td style='color:black;'>".$value["porcentaje"]."</td>
						<td style='color:black;'>".$cierreEstimado."</td>
						<td style='color:black;'><strong>".$transcurrido."</strong>".$seguimiento."</td>
						
						<td style='color:black;'>".$productos."</td>
						<td style='color:black;'>".$value["agente"]."</td>
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/
		}
	}
	/**
	 * REPORTE DE TABLA CLIENTES
	 */
	public function ctrReporteClientes(){

		if(isset($_GET["clientes"])){
			
			$tabla = $_GET["clientes"];
			$idAgente = $_GET["agente"];
			
			if ($idAgente != 0 ) {
				$parametros = "WHERE av.id= ".$idAgente." AND p.cliente = 1  and p.descartado != 1";
			}else{
				$parametros = "WHERE p.cliente = 1  and p.descartado != 1";
			}

			$reporte = ModeloReportes::mdlReporteClientes($tabla,$parametros);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Clientes";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["clientes"] == "prospectos"){	

				$camposTabla = ['#','Nombre/Taller','Tiket Promedio','Ultimo Contacto','Ejecutivo'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; C L I E N T E S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {
					$item = "idProspecto";
			 		$valor = $value["id"];
			 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);


					/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
					$fecha = new DateTime("now");
					$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
					$diferencia = $fechaOperacion -> diff($fecha);
			
					$transcurrido = ControladorGeneral::formatearFecha($diferencia);

					$ultimaCompra = "<strong>Ultima Compra ".$obtenerUltimoSeguimiento["fecha"]."</strong> <em>(Hace ".$transcurrido.")</em>";

					/*OBTENER LAS VENTAS CREADAS*/
					$item = "idOportunidad";
					$valor = $value["id"];
					$obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

					$cantidadVentas = $obtenerVentasCreadas["cantidad"];
					$montoVentas = $obtenerVentasCreadas["monto"];

					if ($cantidadVentas == 0) {
						$ticketPromedio = 0;
					}else{
						$ticketPromedio = $montoVentas/$cantidadVentas;
					}
					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'>".number_format($ticketPromedio,2)."</td>
						<td style='color:black;'>".$ultimaCompra."</td>
						<td style='color:black;'>".$value["agente"] ."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA VENTAS POR PERIODO
	 */
	public function ctrReporteVentasPorPeriodo(){

		if(isset($_GET["ventasPorPeriodo"])){
			
			$tabla = $_GET["ventasPorPeriodo"];
			$idAgente = $_GET["agente"];
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

			$reporte = ModeloReportes::mdlReporteVentasPorPeriodo($tabla,$parametros);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Ventas";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["ventasPorPeriodo"] == "ventas"){	

				$camposTabla = ['#','Nombre/Taller','Concepto','Serie/Folio','Fecha','Observaciones','Total','Cerrado el Día','Ejecutivo','Productos','Estatus'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; V E N T A S &nbsp; P O R &nbsp; P E R I O D O &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					if ($value["estatusVenta"] == 1) {
						$estatus = "Vigente";
					}else{
						$estatus = "Cancelada";
					}
					
					if ($value["productos"] != "") {
						$productos = $value["productos"];
					}else{
						$productos = "Sin Datos";
					}
					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["idVenta"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'><strong>".$value["concepto"]."</strong></em></td>
						<td style='color:black;'><strong>".$value["serie"]."</strong>&nbsp;<em>".$value["folio"]."</em></td>
						<td style='color:black;'>".$value["fechaVenta"]."</td>
						<td style='color:black;'>".$value["observaciones"]."</td>
						<td style='color:black;'>".number_format($value["montoTotal"],2)."</td>
						<td style='color:black;'>".$value["cerradoDia"]."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$productos."</td>
						<td style='color:black;'>".$estatus."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA EVENTOS CALENDARIO
	 */
	public function ctrReporteEventosCalendario(){

		if(isset($_GET["eventosCalendario"])){
			
			$tabla = $_GET["eventosCalendario"];

			$reporte = ModeloReportes::mdlReporteEventosCalendario($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Eventos";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["eventosCalendario"] == "citas"){	

				$camposTabla = ['Evento','Folio Evento','Contacto','Asunto','Descripción','Fecha','Hora','Estatus','Agente'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; C A L E N D A R I O &nbsp; D E &nbsp; E V E N T O S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					$evento = $value["evento"];
					switch ($evento) {
						case 'citas':
							$evento =  "Cita";
							break;
						case 'llamada':
							$evento =  "Llamada";
							break;
						case 'visitas':
							$evento =  "Visita";
							break;
						case 'demostraciones':
							$evento =  "Demostración";
							
							break;
						case 'recordatorios':
							$evento =  "Recordatorio";
							break;
					}
					if ($value["estatus"] == 1) {
						$estatus = "<strong style='color:green;'>Realizado</strong>";
					}else{
						$estatus = "<strong style='color:red;'>Pendiente</strong>";
					}

					echo utf8_decode("<tr>
						<td style='color:black;'>".$evento."</td>
						<td style='color:black;text-align:center'>".$value["id"]."</td>
						<td style='color:black;'>".$value["prospecto"]."</td>
						<td style='color:black;'>".$value["asunto"]."</td>
						<td style='color:black;text-align:justify;'>".$value["descripcion"]."</td>
						<td style='color:black;'>".$value["fecha"]."</td>
						<td style='color:black;'>".$value["hora"]."</td>
						<td style='color:black;'>".$estatus."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA EVENTOS PENDIENTES
	 */
	public function ctrReporteEventosPendientes(){

		if(isset($_GET["pendientes"])){
			
			$tabla = $_GET["pendientes"];

			$reporte = ModeloReportes::mdlReporteEventosPendientes($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Eventos Pendientes";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["pendientes"] == "citas"){	

				$camposTabla = ['Evento','Folio Evento','Contacto','Asunto','Descripción','Fecha','Hora','Estatus','Agente'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; E V E N T O S &nbsp; P E N D I E N T E S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					$evento = $value["evento"];
					switch ($evento) {
						case 'citas':
							$evento =  "Cita";
							break;
						case 'llamada':
							$evento =  "Llamada";
							break;
						case 'visitas':
							$evento =  "Visita";
							break;
						case 'demostraciones':
							$evento =  "Demostración";
							
							break;
						case 'recordatorios':
							$evento =  "Recordatorio";
							break;
					}
					if ($value["estatus"] == 1) {
						$estatus = "<strong style='color:green;'>Realizado</strong>";
					}else{
						$estatus = "<strong style='color:red;'>Pendiente</strong>";
					}

					echo utf8_decode("<tr>
						<td style='color:black;'>".$evento."</td>
						<td style='color:black;text-align:center'>".$value["id"]."</td>
						<td style='color:black;'>".$value["prospecto"]."</td>
						<td style='color:black;'>".$value["asunto"]."</td>
						<td style='color:black;text-align:justify;'>".$value["descripcion"]."</td>
						<td style='color:black;'>".$value["fecha"]."</td>
						<td style='color:black;'>".$value["hora"]."</td>
						<td style='color:black;'>".$estatus."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA LISTA EVENTOS
	 */
	public function ctrReporteListaEventos(){

		if(isset($_GET["listaEventos"])){
			
			$tabla = $_GET["listaEventos"];

			switch ($tabla) {
				case 'citas':
					$campos = "c.id,c.asunto,c.descripcion,c.fecha,c.hora,p.nombreCompleto as contacto,a.nombre as agente,c.finalizada, c.detalle, c.ubicacion, c.latitud, c.longitud";
					$alias = "c";
					$name = "Citas";
					$tipo = "C I T A S";
					break;
				case 'llamada':
					$campos = "ll.id,ll.titulo as asunto,ll.descripcion,ll.fecha,ll.hora,p.nombreCompleto as contacto,a.nombre as agente,ll.finalizada, ll.detalle";
					$alias = "ll";
					$name = "Llamada";
					$tipo = "L L A M A D A S";
					break;
				case 'visitas':
					$campos = "v.id,v.asunto,v.descripcion,v.fecha,v.hora,p.nombreCompleto as contacto,a.nombre as agente,v.finalizada, v.detalle, v.ubicacion, v.latitud, v.longitud";
					$alias = "v";
					$name = "Visitas";
					$tipo = "V I S I T A S";
					break;
				case 'recordatorios':
					$campos = "r.id,r.asunto,r.descripcion,r.fecha,r.hora,p.nombreCompleto as contacto,a.nombre as agente,r.finalizada, r.detalle";
					$alias = "r";
					$name = "Recordatorios";
					$tipo = "R E C O R D A T O R I O S";
					break;
				case 'demostraciones':
					$campos = "d.id,d.asunto,d.descripcion,d.fecha,d.hora,p.nombreCompleto as contacto,a.nombre as agente,d.finalizada, d.detalle, d.ubicacion, d.latitud, d.longitud";
					$alias = "d";
					$name = "Demostraciones";
					$tipo = "D E M O S T R A C I O N E S";
					break;
			}
			$referencia = "INNER JOIN prospectos as p ON ".$alias.".idProspecto = p.id INNER JOIN agentesventas as a ON ".$alias.".idAgente = a.id";
			$reporte = ModeloReportes::mdlReporteListaEventos($tabla,$campos,$alias,$referencia);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte ".$name;
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["listaEventos"] == $tabla){

				if ($tabla == "llamada" || $tabla == "recordatorios") {
					$camposTabla = ['Folio Evento','Contacto','Asunto','Descripción','Fecha','Hora','Observaciones','Estatus','Agente'];
					$col = "colspan='9'";
				}else{

					$camposTabla = ['Folio Evento','Contacto','Asunto','Descripción','Fecha','Hora','Observaciones','Estatus','Agente','Dirección','Latitud','Longitud'];
					$col = "colspan='12'";
				}

				echo utf8_decode("<table>");
				echo "<tr>
					<th ".$col." style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th ".$col." style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; ".$tipo." &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					
					if ($value["finalizada"] != 1) {
						$observaciones =  "";
						$estatus = "<strong style='color:red;'>Pendiente</strong>";
					}else{
						$observaciones =  $value["detalle"];
						$estatus = "<strong style='color:green;'>Realizado</strong>";
					}

					if ($tabla == "llamada" || $tabla == "recordatorios") {
						echo utf8_decode("<tr>
							<td style='color:black;text-align:center'>".$value["id"]."</td>
							<td style='color:black;'><strong>".$value["contacto"]."</strong></td>
							<td style='color:black;'><strong>".$value["asunto"]."</strong></td>
							<td style='color:black;text-align:justify;'>".$value["descripcion"]."</td>
							<td style='color:black;'>".$value["fecha"]."</td>
							<td style='color:black;'>".$value["hora"]."</td>
							<td style='color:black;text-align:justify;'>".$observaciones."</td>
							<td style='color:black;'>".$estatus."</td>
							<td style='color:black;'>".$value["agente"]."</td>
							
						</tr>");
					}else{
						echo utf8_decode("<tr>
							<td style='color:black;text-align:center'>".$value["id"]."</td>
							<td style='color:black;'><strong>".$value["contacto"]."</strong></td>
							<td style='color:black;'><strong>".$value["asunto"]."</strong></td>
							<td style='color:black;text-align:justify;'>".$value["descripcion"]."</td>
							<td style='color:black;'>".$value["fecha"]."</td>
							<td style='color:black;'>".$value["hora"]."</td>
							<td style='color:black;text-align:justify;'>".$observaciones."</td>
							<td style='color:black;'>".$estatus."</td>
							<td style='color:black;'>".$value["agente"]."</td>
							<td style='color:black;'>".$value["ubicacion"]."</td>
							<td style='color:black;'>".$value["latitud"]."</td>
							<td style='color:black;'>".$value["longitud"]."</td>
							
						</tr>");

					}
					

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA DESCARTADOS
	 */
	public function ctrReporteDescartados(){

		if(isset($_GET["descartados"])){
			
			$tabla = $_GET["descartados"];

			$reporte = ModeloReportes::mdlReporteDescartados($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Descartados";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["descartados"] == "prospectos"){	

				$camposTabla = ['#','Nombre/Taller','Correo/Telefono','Motivo','Origen','Ultimo Contacto','Ejecutivo','Estatus'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='8' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='8' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E S C A R T A D O S &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					if ($value["estatus"] == 0 && $value["descartado"] == 1) {
			 			$estado = "<strong style='color:orange;'>Descartado</strong>";
			 		}else if ($value["estatus"] == 0 && value["descartado"] == 0){
			 			$estado = "<strong style='color:red;'>Inactivo</strong>";
			 		}else{
			 			$estado = "<strong style='color:green;'>Activo</strong>";
			 		}

			 		$item = "idProspecto";
			 		$valor = $value["id"];
			 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

			 		if ($obtenerUltimoSeguimiento["titulo"] == "") {
			 			$seguimiento = "Nuevo prospecto creado apartir de encuesta blitz";
			 		}else{
			 			$seguimiento = $obtenerUltimoSeguimiento["titulo"];
			 		}

			 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			 		$fecha = new DateTime("now");
					$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
					$diferencia = $fechaOperacion -> diff($fecha);
			
					$transcurrido = ControladorGeneral::formatearFecha($diferencia);

					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'><strong>".$value["correo"]."</strong><br><em>".$value["telefono"]."</em></td>
						<td style='color:black;'>".$value["motivo"]."</td>
						<td style='color:black;'>".$value["origen"]."</td>
						<td style='color:black;'><strong>".$transcurrido."</strong>".$seguimiento."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$estado."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA BITACORA
	 */
	public function ctrReporteBitacora(){

		if(isset($_GET["bitacora"])){
			
			$tabla = $_GET["bitacora"];

			$reporte = ModeloReportes::mdlReporteBitacora($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Bitacora";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["bitacora"] == "bitacora"){	

				$camposTabla = ['#','Acción','Fecha','Agenda','Prospecto'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; B I T A C O R A &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["accion"]."</strong></td>
						<td style='color:black;'>".$value["fecha"]."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$value["prospecto"]."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA DIRECTORIO
	 */
	public function ctrReporteDirectorio(){

		if(isset($_GET["directorio"])){
			
			$tabla = $_GET["directorio"];

			$reporte = ModeloReportes::mdlReporteDirectorio($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Directorio";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["directorio"] == "prospectos"){	

				$camposTabla = ['#','Nombre/Taller','Correo','Telefono/Celular','Domicilio','Ejecutivo','Estatus'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D I R E C T O R I O &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					if ($value["estatus"] == 0 && $value["descartado"] == 1) {
				        $estado = "<strong style='color:orange;'>Descartado</strong>";
				    }else if ($value["estatus"] == 0 && $value["descartado"] == 0){
				        $estado = "<strong style='color:red;'>Inactivo</strong>";
				    }else{
				        $estado = "<strong style='color:green;'>Activo</strong>";
				    }

					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'><strong>".$value["correo"]."</strong></td>
						<td style='color:black;'><strong>".$value["telefono"]."</strong><br><em>".$value["celular"]."</em></td>
						<td style='color:black;'>".$value["domicilio"]."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$estado."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}
	/**
	 * REPORTE DE TABLA HISTORIAL
	 */
	public function ctrReporteHistorial(){

		if(isset($_GET["historial"])){
			
			$tabla = $_GET["historial"];

			$reporte = ModeloReportes::mdlReporteHistorial($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombreArchivo = "Reporte Historial";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");
			

			/*=============================================
		
			=============================================*/

			if($_GET["historial"] == "seguimientos"){	

				$camposTabla = ['#','Titulo','Fecha','Agente','Prospecto','Acción'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; H I S T O R I A L &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["titulo"]."</strong></td>
						<td style='color:black;'>".$value["fecha"]."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$value["prospecto"]."</td>
						<td style='color:black;'>".$value["accion"]."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}

	/**
	 * REPORTE DE TABLA CARTERA
	 */
	public function ctrReporteCartera(){

		if(isset($_GET["cartera"])){
			
			$tabla = $_GET["cartera"];

			$idAgente = $_GET["agenteElegido"];

			if ($idAgente != 0) {
				$parametros = "descartado = 0 AND p.idAgente = ".$idAgente;
			}else{
				$parametros = "descartado = 0";
			}

			$reporte = ModeloReportes::mdlReporteCartera($tabla,$parametros);

			$nombreArchivo = "Reporte Cartera";
			$nombre = $nombreArchivo.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");


			if($_GET["cartera"] == "prospectos"){	

				$camposTabla = ['#','Nombre/Taller','Clasificación','Fase','Ultimo Contacto','Opor','$ Opor','Ventas','$ Ventas','Ejecutivo','Estatus'];

				echo utf8_decode("<table>");
				echo "<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='11' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; C A R T E R A &nbsp</th>
					</tr>";
				echo utf8_decode("<tr>");
				for ($i=0; $i < count($camposTabla); $i++) { 
					echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
					
				}
				echo utf8_decode("</tr>");
				echo utf8_decode("<tr>");

				foreach ($camposTabla as $key => $value) {
						
						echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>".$value."</td>");
	
				}
				echo utf8_decode("</tr>");

				foreach ($reporte as $key => $value) {

					if ($value["estatus"] == 1) {
						$estado = "<strong style='color:green;'>Activo</strong>";
					}else{
						$estado = "<strong style='color:red;'>Activo</strong>";
					}

					/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			 		$item = "idProspecto";
			 		$valor = $value["id"];
			 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

		 			if ($obtenerUltimoSeguimiento["titulo"] == "" and $value["clasificacion"] = 1) {
		 			$seguimiento = "Nuevo prospecto creado apartir de encuesta blitz";
		 			}
				    if($obtenerUltimoSeguimiento["titulo"] == "" and $value["clasificacion"] = 2){
				        $seguimiento = "Sin seguimiento";
				    }
				    if($obtenerUltimoSeguimiento["titulo"] == "" and $value["clasificacion"] = 3){
				        $seguimiento = "Sin seguimiento";
				    }
				    if($obtenerUltimoSeguimiento["titulo"] == "" and $value["clasificacion"] = 4){
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
					$valor = $value["id"];
					$obtenerOportunidadesCreadas = ControladorGeneral::ctrObtenerOportunidadesCreadas($item,$valor);

				    $cantidadOportunidades = $obtenerOportunidadesCreadas["cantidad"];
				    $montoOportunidades = $obtenerOportunidadesCreadas["monto"];

				      /*OBTENER LAS VENTAS CREADAS*/
				    $item = "idOportunidad";
				    $valor = $value["id"];
				    $obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

				    $cantidadVentas = $obtenerVentasCreadas["cantidad"];
				    $montoVentas = $obtenerVentasCreadas["monto"];


				    if ($value["oportunidad"] == 0 and $value["cliente"] == 0 ) {
				        $fase = "Prospecto";
				    }
				    if ($value["oportunidad"] == 1 and $value["cliente"] == 0 ) {
				        $fase = "Oportunidad";
				    }
				    if ($value["oportunidad"] == 1 and $value["cliente"] == 1 ) {
				        $fase = "Cliente";
				    }

					echo utf8_decode("<tr>
						<td style='color:black;'>".$value["id"]."</td>
						<td style='color:black;'><strong>".$value["nombreCompleto"]."</strong><br><em>".$value["taller"]."</em></td>
						<td style='color:black;'><strong>".$value["nombreClasificacion"]."</strong></td>
						<td style='color:black;'>".$fase."</td>
						<td style='color:black;'><strong>".$transcurrido."</strong>".$seguimiento."</td>
						<td style='color:black;'>".$cantidadVentas."</td>
						<td style='color:black;'>".number_format($montoOportunidades,2)."</td>
						<td style='color:black;'>".$cantidadVentas."</td>
						<td style='color:black;'>".number_format($montoVentas,2)."</td>
						<td style='color:black;'>".$value["agente"]."</td>
						<td style='color:black;'>".$estado."</td>
						
					</tr>");

	
				}



			echo "</table>";

			}

		}

	}

}


 ?>