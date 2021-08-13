<?php 

class ControllerReports{

	public function ctrDescargarReporteCartera($idAgente,$clasificacion,$fase,$tipo){

		$database = new data();

		$reporte = $database->getCarteraReporte($idAgente,$clasificacion,$fase,$tipo);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte Cartera" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Id','Nombre/Taller', 'Clasificacion', 'Fase', 'Ultimo Contacto', '# Opor', '$ Opor', '# Ventas', '$ Ventas', 'Ultima Venta', 'Ejecutivo','Estatus'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; C A R T E R A  &nbsp</th>
					</tr>

					<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

        	 if ($value["estatus"] == 1) {
                    $estado = "Activo";
                }else{
                    $estado = "Inactivo";
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

                $item = "idOportunidad";
                $valor = $value["id"];
                $fechaUltimaVenta = ControladorGeneral::ctrUltimaVentaGenerada($item,$valor);

                if ($fechaUltimaVenta["fecha"] == "") {
                    $fecha = "Sin venta";
                }else{
                    $fecha = $fechaUltimaVenta["fecha"];
                }

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
										<td style='color:black;'>" . $value["id"] . "</td>
				 						<td style='color:black;'>" . '<strong>'.$value["nombreCompleto"].'</strong><br>'.$value["taller"].'' . "</td>
										<td style='color:black;'>" . $value["nombreClasificacion"] . "</td>
										<td style='color:black;'>" . $fase . "</td>
										<td style='color:black;'>" . '<strong>'.$transcurrido.'</strong>'.$seguimiento."</td>
										 <td style='color:black;'>" . $cantidadOportunidades . "</td>
										 <td style='color:black;'>" . "$".number_format($montoOportunidades,2) . "</td>
										 <td style='color:black;'>" . $cantidadVentas . "</td>
										 <td style='color:black;'>" . "$".number_format($montoVentas,2) . "</td>
									     <td style='color:black;'>" . $fecha . "</td>
									     <td style='color:black;'>" . $value["agente"] . "</td>
									     <td style='color:black;'>" . $estado . "</td>

										</tr>");
        }


        echo "</table>";
	}

	/**PROSPECTOS****/
	public function ctrDescargarReporteProspectos($idAgente,$comentarios,$fechaInicial,$fechaFinal){

		$database = new data();

		$reporte = $database->getProspectosReporte($idAgente,$comentarios,$fechaInicial,$fechaFinal);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte Prospectos" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Id','Nombre/Taller', 'Comentarios', 'Ultimo Contacto', 'Ejecutivo','Habilitado','Estatus'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; P R O S P E C T O S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='7' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

        	 if ($value["estatus"] == 1) {
                    $estado = "Activo";
                }else{
                    $estado = "Inactivo";
                }

                /***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
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
                $diferencia = $fechaOperacion -> diff($fecha);

                $transcurrido = ControladorGeneral::formatearFecha($diferencia);

               	if ($value["habilitado"] != 0) {

                    $habilitado = "Habilitado";

	            }else{

	                $habilitado = "Deshabilitado";
	            }

            echo utf8_decode("<tr>
										<td style='color:black;'>" . $value["id"] . "</td>
				 						<td style='color:black;'>" . '<strong>'.$value["nombreCompleto"].'</strong><br>'.$value["taller"].'' . "</td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["comentario"])."</strong></td>
										<td style='color:black;'>" . '<strong>'.$transcurrido.'</strong>'.$seguimiento."</td>
									     <td style='color:black;'>" . $value["agente"] . "</td>
									     <td style='color:black;'>" . $habilitado . "</td>
									     <td style='color:black;'>" . $estado . "</td>

										</tr>");
        }


        echo "</table>";
	}
	/**OPORTUNIDADES****/
	public function ctrDescargarReporteOportunidades($idAgente,$fechaInicial,$fechaFinal){

		$database = new data();

		$reporte = $database->getOportunidadesReporte($idAgente,$fechaInicial,$fechaFinal);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte Oportunidades" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Id','Nombre/Taller', 'Concepto', 'Fecha', 'Monto','Certeza','Cierre Estimado','Ultimo Contacto','Ejecutivo'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; O P O R T U N I D A D E S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='9' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

        	
			
			/******VERIFICAR SI LA FECHA DE CIERRE YA PASO*****/

			$fechaActual =	date('Y-m-d');
			$fechaCierre =   $value["cierreEstimado"];

			if ($fechaActual < $fechaCierre) {
				$cierreEstimado = "<strong>".$value["cierreEstimado"]."</strong>";
			}else{
				$cierreEstimado = "<strong style='color:red'>".$value["cierreEstimado"]."</strong>";
			}


			$item = "idProspecto";
	 		$valor = $value["idProspecto"];
	 		$obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

	 		$seguimiento = $obtenerUltimoSeguimiento["titulo"];

	 		/***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
			$fecha = new DateTime("now");
			$fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
			$diferencia = $fechaOperacion -> diff($fecha);

			$transcurrido = ControladorGeneral::formatearFecha($diferencia);

            echo utf8_decode("<tr>
										<td style='color:black;'>" . $value["id"] . "</td>
				 						<td style='color:black;'>" . '<strong>'.$value["nombre"].'</strong><br>'.$value["taller"].'' . "</td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["concepto"])."</strong></td>
										<td style='color:black;'>" . $value["fecha"] . "</td>
										<td style='color:black;'><strong>".number_format($value["monto"],2)."</strong></td>
										 <td style='color:black;'>" . $value["porcentaje"] . "</td>
										  <td style='color:black;'>" . $cierreEstimado . "</td>
										<td style='color:black;'>" . '<strong>'.$transcurrido.'</strong>'.$seguimiento."</td>
									     <td style='color:black;'>" . $value["agente"] . "</td>
										</tr>");
        }


        echo "</table>";
	}
	/**CLIENTES****/
	public function ctrDescargarReporteClientes($idAgente){

		$database = new data();

		$reporte = $database->getClientesReporte($idAgente);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte Clientes" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Id','Nombre/Taller', 'Ticket Promedio','Ultimo Contacto','Ejecutivo'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; C L I E N T E S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

        			$item = "idProspecto";
                    $valor = $value["id"];
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

                    if ($cantidadVentas == 0) {
                        $ticketPromedio = 0;
                    }else{
                        $ticketPromedio = $montoVentas/$cantidadVentas;
                    } 

            echo utf8_decode("<tr>
										<td style='color:black;'>" . $value["id"] . "</td>
				 						<td style='color:black;'>" . '<strong>'.$value["nombreCompleto"].'</strong><br>'.$value["taller"].'' . "</td>
										<td style='color:black;'><strong>".number_format($ticketPromedio,2)."</strong></td>
										
										<td style='color:black;'>" . '<strong>'.$transcurrido.'</strong>'.$seguimiento."</td>
									     <td style='color:black;'>" . $value["agente"] . "</td>
										</tr>");
        }


        echo "</table>";
	}
	/***VENTAS****/
	public function ctrDescargarReporteVentasPeriodo($idAgente,$fechaInicial,$fechaFinal){

		$database = new data();

		$reporte = $database->getVentasPeriodoReporte($idAgente,$fechaInicial,$fechaFinal);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte Ventas" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Id','Nombre/Taller', 'Concepto', 'Serie/Folio', 'Fecha','Observaciones','Total','Cerrado El dia','Ejecutivo','Estatus'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='10' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='10' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; V E N T A S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='10' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

        	if ($value["estatusVenta"] == 1) {
                        $estatus = "Vigente";

                    }else{
                        $estatus = "Cancelada";
                    }

                   

            echo utf8_decode("<tr>
										<td style='color:black;'>" . $value["idVenta"] . "</td>
				 						<td style='color:black;'>" . '<strong>'.$value["nombreCompleto"].'</strong><br>'.$value["taller"].'' . "</td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["concepto"])."</strong></td>
										<td style='color:black;'>" . '<strong>'.$value["serie"].'</strong><br>'.$value["folio"].'' . "</td>
										<td style='color:black;'>" . $value["fechaVenta"] . "</td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["observaciones"])."</strong></td>
										<td style='color:black;'><strong>".number_format($value["montoTotal"],2)."</strong></td>
										 <td style='color:black;'>" . $value["cerradoDia"] . "</td>
										  <td style='color:black;'>" . $value["agente"] . "</td>
										
									     <td style='color:black;'>" . $estatus . "</td>
										</tr>");
        }


        echo "</table>";
	}
	/***EVENTOS****/
	public function ctrDescargarReporteEventos($idAgente,$fechaInicial,$fechaFinal,$evento,$nombre){

		$database = new data();

		$reporte = $database->getEventosReporte($idAgente,$fechaInicial,$fechaFinal,$evento,$nombre);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte De Eventos" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['Evento','Folio Evento', 'Contacto', 'Asunto', 'Descripcion','Fecha','Hora','Agente'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='8' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='8' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; E V E N T O S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='8' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
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
					$evento =  "Demostracion";
					
					break;
				case 'recordatorios':
					$evento =  "Recordatorio";
					break;

			}

	
            echo utf8_decode("<tr>
										<td style='color:black;'>" . $evento . "</td>
				 						<td style='color:black;'>" . $value["id"] . "</td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["prospecto"])."</strong></td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["asunto"])."</strong></td>
										<td style='color:black;'><strong>".preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $value["descripcion"])."</strong></td>
										
										<td style='color:black;'>" . $value["fecha"] . "</td>
										<td style='color:black;'>" . $value["hora"] . "</td>
										<td style='color:black;'>" . $value["agente"] . "</td>
										
										</tr>");
        }


        echo "</table>";
	}
	/***BITACORA****/
	public function ctrDescargarReporteBitacora($idAgente,$fechaInicial,$fechaFinal,$nombre){

		$database = new data();

		$reporte = $database->getBitacoraReporte($idAgente,$fechaInicial,$fechaFinal,$nombre);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte De Bitacora" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['#','Accion', 'Fecha', 'Agente', 'Prospecto'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; B I T A C O R A  &nbsp</th>
					</tr>

					<tr>
					<th colspan='5' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

            echo utf8_decode("<tr>
				 						<td style='color:black;'>" . $value["id"] . "</td>
										<td style='color:black;'><strong>".$value["accion"]."</strong></td>
										<td style='color:black;'>" . $value["fecha"] . "</td>
										<td style='color:black;'>" . $value["agente"] . "</td>
										<td style='color:black;'>" . $value["prospecto"] . "</td>
										
										</tr>");
        }


        echo "</table>";
	}
	/***SEGUIMIENTOS****/
	public function ctrDescargarReporteSeguimientos($idAgente,$fechaInicial,$fechaFinal,$nombre,$accion){

		$database = new data();

		$reporte = $database->getSeguimientosReporte($idAgente,$fechaInicial,$fechaFinal,$nombre,$accion);

		 /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $nombre = "Reporte De Seguimientos" . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $nombre . '"');
        header("Content-Transfer-Encoding: binary");

        $arregloHeaders = ['#','Titulo', 'Fecha', 'Agente', 'Prospecto','Accion'];


        echo utf8_decode("<table>");
        echo "<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>SAN FRANCISCO DEKKERLAB</th>
					</tr>

					<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'>R E P O R T E &nbsp; D E &nbsp; S E G U I M I E N T O S  &nbsp</th>
					</tr>

					<tr>
					<th colspan='6' style='font-weight:bold; background:#17202A; color:white;'></th>
					</tr>";
        echo utf8_decode("<tr>");
        for ($i = 0; $i < count($arregloHeaders); $i++) {
            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'></td>");
        }
        echo utf8_decode("</tr>");
        echo utf8_decode("<tr>");

        foreach ($arregloHeaders as $key => $value) {

            echo utf8_decode("<td style='font-weight:bold; background:#000000; color:white;'>" . $value . "</td>");
        }
        echo utf8_decode("</tr>");
        foreach ($reporte as $key => $value) {

            echo utf8_decode("<tr>
				 						<td style='color:black;'>" . $value["id"] . "</td>
										<td style='color:black;'><strong>".$value["titulo"]."</strong></td>
										<td style='color:black;'>" . $value["fecha"] . "</td>
										<td style='color:black;'>" . $value["agente"] . "</td>
										<td style='color:black;'>" . $value["prospecto"] . "</td>
										<td style='color:black;'>" . $value["accion"] . "</td>
										
										</tr>");
        }


        echo "</table>";
	}

}

 ?>