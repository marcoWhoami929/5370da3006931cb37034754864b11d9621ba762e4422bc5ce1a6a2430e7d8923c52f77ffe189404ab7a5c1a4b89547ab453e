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
										<td style='color:black;'>".$value["nombreCompleto"]."</td>
										<td style='color:black;'>".$value["nombre"]."</td>
										<td style='color:black;'>".$value["comentario"]."</td>
										
							
										</tr>");

									
	
	
				}



			echo "</table>";

			}
			/****FIN DE LA TABLA***/

		}

	}

}


 ?>