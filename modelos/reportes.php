<?php
require_once "conexion.php";


class ModeloReportes{

	static public function  mdlReporteSeguimientos($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT s.titulo,s.fecha,p.nombreCompleto as prospecto,p.comentario,a.nombre as agente FROM $tabla as s INNER JOIN prospectos as p ON s.idProspecto = p.id INNER JOIN agentesventas as a ON s.idAgente = a.id order by idProspecto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function mdlReporteTimeline($tabla,$idProspecto){

		$stmt = Conexion::conectar()->prepare("SELECT s.titulo,s.fecha,p.nombreCompleto as prospecto,p.comentario,a.nombre as agente FROM $tabla as s INNER JOIN prospectos as p ON s.idProspecto = p.id INNER JOIN agentesventas as a ON s.idAgente =  a.id WHERE p.id = $idProspecto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt  = null;

	}
	static public function  mdlReporteProspectos($tabla,$parametros){
		$stmt = Conexion::conectar()->prepare("SELECT p.*,fp.fase, op.origen,av.nombre as agente FROM $tabla as p INNER JOIN faseprospecto AS fp ON p.faseProspecto = fp.id INNER JOIN origenprospectos AS op ON p.origenProspecto = op.id INNER JOIN agentesventas AS av ON p.idAgente = av.id $parametros");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function  mdlReporteOportunidades($tabla,$parametros){
		$stmt = Conexion::conectar()->prepare("SELECT o.id,o.idProspecto,p.nombreCompleto as nombre,p.taller,o.concepto,o.monto,o.comision,c.porcentaje,o.cierreEstimado,f.faseOportunidad as fase,av.nombre as agente,o.fecha,o.productos FROM $tabla as o INNER JOIN prospectos AS p ON o.idProspecto = p.id INNER JOIN certezas AS c ON o.idCerteza = c.id INNER JOIN faseoportunidades as f ON o.idFaseOportunidad = f.id  INNER JOIN agentesventas as av ON o.idAgente = av.id $parametros");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteClientes($tabla,$parametros){
		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller, av.nombre as agente from prospectos as p INNER JOIN faseprospecto as fp ON p.faseProspecto = fp.id  INNER JOIN agentesventas AS av ON p.idAgente = av.id $parametros");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteVentasPorPeriodo($tabla,$parametros){
		$stmt = Conexion::conectar()->prepare("SELECT vt.id idVenta ,p.nombreCompleto,p.taller,vt.concepto,vt.fechaVenta,vt.observaciones,vt.montoTotal,vt.cerradoDia,av.nombre as agente,vt.estatusVenta,o.id as idOportunidadVenta,o.productos,vt.serie,vt.folio FROM ventas as vt INNER JOIN agentesventas as av ON vt.idAgente = av.id INNER JOIN prospectos as p ON vt.idOportunidad = p.id INNER JOIN oportunidades as o ON vt.idOportunidadVenta = o.id $parametros");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteEventosCalendario($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT ct.id,ct.asunto,ct.descripcion,ct.fecha,ct.hora,'citas' as evento,ct.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM $tabla as ct INNER JOIN agentesventas as ag ON ct.idAgente = ag.id INNER JOIN prospectos as p ON ct.idProspecto = p.id  UNION SELECT llamada.id,llamada.titulo as asunto,llamada.descripcion,llamada.fecha,llamada.hora,'llamada' as evento,llamada.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `llamada` as llamada INNER JOIN agentesventas as ag ON llamada.idAgente = ag.id INNER JOIN prospectos as p ON llamada.idProspecto = p.id   UNION SELECT visitas.id,visitas.asunto,visitas.descripcion,visitas.fecha,visitas.hora,'visitas' as evento,visitas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `visitas` as visitas INNER JOIN agentesventas as ag ON visitas.idAgente = ag.id INNER JOIN prospectos as p ON visitas.idProspecto = p.id  UNION SELECT record.id,record.asunto,record.descripcion,record.fecha,record.hora,'recordatorios' as evento,record.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `recordatorios` as record INNER JOIN agentesventas as ag ON record.idAgente = ag.id  INNER JOIN prospectos as p ON record.idProspecto = p.id    UNION SELECT demo.id,demo.asunto,demo.descripcion,demo.fecha,demo.hora,'demostraciones' as evento,demo.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `demostraciones` as demo INNER JOIN agentesventas as ag ON demo.idAgente = ag.id INNER JOIN prospectos as p ON demo.idProspecto = p.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteEventosPendientes($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT ct.id,ct.asunto,ct.descripcion,ct.fecha,ct.hora,'citas' as evento,ct.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM $tabla as ct INNER JOIN agentesventas as ag ON ct.idAgente = ag.id INNER JOIN prospectos as p ON ct.idProspecto = p.id where finalizada != 1 UNION SELECT llamada.id,llamada.titulo as asunto,llamada.descripcion,llamada.fecha,llamada.hora,'llamada' as evento,llamada.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `llamada` as llamada INNER JOIN agentesventas as ag ON llamada.idAgente = ag.id INNER JOIN prospectos as p ON llamada.idProspecto = p.id  where finalizada != 1 UNION SELECT visitas.id,visitas.asunto,visitas.descripcion,visitas.fecha,visitas.hora,'visitas' as evento,visitas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `visitas` as visitas INNER JOIN agentesventas as ag ON visitas.idAgente = ag.id INNER JOIN prospectos as p ON visitas.idProspecto = p.id where finalizada != 1 UNION SELECT record.id,record.asunto,record.descripcion,record.fecha,record.hora,'recordatorios' as evento,record.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `recordatorios` as record INNER JOIN agentesventas as ag ON record.idAgente = ag.id  INNER JOIN prospectos as p ON record.idProspecto = p.id  where finalizada != 1  UNION SELECT demo.id,demo.asunto,demo.descripcion,demo.fecha,demo.hora,'demostraciones' as evento,demo.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `demostraciones` as demo INNER JOIN agentesventas as ag ON demo.idAgente = ag.id INNER JOIN prospectos as p ON demo.idProspecto = p.id where finalizada != 1");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function mdlReporteListaEventos($tabla,$campos,$alias,$referencia){

		$stmt = Conexion::conectar()->prepare("SELECT $campos FROM $tabla as $alias $referencia");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	static public function  mdlReporteDescartados($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.correo,p.celular,p.telefono,p.estatus,p.descartado,op.origen,av.nombre as agente,dc.razonDescartado as motivo FROM $tabla as p INNER JOIN descartados AS dc ON p.id = dc.idProspecto INNER JOIN origenprospectos AS op ON p.origenProspecto = op.id INNER JOIN agentesventas AS av ON p.idAgente = av.id WHERE  p.descartado = 1");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteBitacora($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT b.*,av.nombre as agente,p.nombreCompleto as prospecto FROM $tabla as b  INNER JOIN agentesventas AS av ON b.idAgente = av.id INNER JOIN prospectos AS p ON b.idProspecto = p.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteDirectorio($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.correo,p.celular,p.telefono,p.estatus,p.descartado,p.domicilio,av.nombre as agente FROM $tabla as p   INNER JOIN agentesventas AS av ON p.idAgente = av.id WHERE p.telefono != '' || p.celular != '' ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteHistorial($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT s.*,av.nombre as agente,p.nombreCompleto as prospecto,asg.accion FROM $tabla as s  INNER JOIN agentesventas AS av ON s.idAgente = av.id INNER JOIN prospectos AS p ON s.idProspecto = p.id INNER JOIN accionesseguimientos AS asg ON s.idAccion = asg.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	static public function  mdlReporteCartera($tabla,$parametros){
		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.estatus,p.clasificacion,p.oportunidad,p.cliente,av.nombre as agente,cf.clasificacion as nombreClasificacion FROM $tabla as p  INNER JOIN agentesventas AS av ON p.idAgente = av.id INNER JOIN clasificacion AS cf ON p.clasificacion = cf.id WHERE $parametros");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
	

}


?>