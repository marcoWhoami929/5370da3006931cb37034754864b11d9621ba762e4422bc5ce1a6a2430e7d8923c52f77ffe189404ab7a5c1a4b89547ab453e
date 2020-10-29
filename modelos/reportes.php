<?php
require_once "conexion.php";


class ModeloReportes{

	static public function  mdlReporteSeguimientos($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT s.titulo,s.fecha,p.nombreCompleto,p.comentario,a.nombre FROM $tabla as s INNER JOIN prospectos as p ON s.idProspecto = p.id INNER JOIN agentesventas as a ON s.idAgente = a.id order by idProspecto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	

}


?>