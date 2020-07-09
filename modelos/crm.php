<?php
require_once("conexion.php");

class ModeloGeneral{

	/*=============================================
	MOSTRAR PROSPECTOS
	=============================================*/

	static public function mdlMostrarProspectos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.*,fp.fase, op.origen,av.nombre as agente FROM $tabla as p INNER JOIN faseprospecto AS fp ON p.faseProspecto = fp.id INNER JOIN origenprospectos AS op ON p.origenProspecto = op.id INNER JOIN agentesventas AS av ON p.idAgente = av.id WHERE p.origenProspecto = op.id AND p.faseProspecto = fp.id and oportunidad = 0 and cliente = 0 and descartado = 0");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/**
	 * MOSTRAR PROSPECTOS
	 */
	
	static public function mdlMostrarOportunidades($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT o.id,o.idProspecto,p.nombreCompleto as nombre,p.taller,p.correo,p.telefono,o.concepto,o.monto,o.comision,c.porcentaje,o.cierreEstimado,f.faseOportunidad as fase,op.origen,av.nombre as agente,o.fecha,o.productos FROM $tabla as o INNER JOIN prospectos AS p ON o.idProspecto = p.id INNER JOIN certezas AS c ON o.idCerteza = c.id INNER JOIN faseoportunidades as f ON o.idFaseOportunidad = f.id INNER JOIN origenprospectos as op ON op.id = p.origenProspecto INNER JOIN agentesventas as av ON o.idAgente = av.id WHERE p.id = o.idProspecto and p.descartado = 0 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0");



		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/**
	 * MOSTRAR CLIENTES
	 */
	
	static public function mdlMostrarClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.correo,p.celular,fp.fase,op.origen,sum(vt.montoTotal) AS monto,count(vt.id) as ventasRealizadas,(sum(vt.montoTotal)/count(vt.id)) as ventaPromedio, av.nombre as agente,o.productos from $tabla as p INNER JOIN faseprospecto as fp ON p.faseProspecto = fp.id  INNER JOIN origenprospectos AS op ON p.origenProspecto = op.id INNER JOIN ventas AS vt ON p.id = vt.idOportunidad INNER JOIN agentesventas AS av ON p.idAgente = av.id INNER JOIN oportunidades AS o ON vt.idOportunidadVenta = o.id WHERE p.cliente = 1  and p.descartado != 1 and p.oportunidadesCreadas != 0 GROUP by p.id");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/**
	 * MOSTRAR VENTAS
	 */
	
	static public function mdlMostrarVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT vt.id idVenta ,p.nombreCompleto,p.taller,vt.concepto,vt.fechaVenta,vt.observaciones,vt.montoTotal,vt.cerradoDia,av.nombre as agente,vt.estatusVenta,o.id as idOportunidadVenta,o.productos FROM ventas as vt INNER JOIN agentesventas as av ON vt.idAgente = av.id INNER JOIN prospectos as p ON vt.idOportunidad = p.id INNER JOIN oportunidades as o ON vt.idOportunidadVenta = o.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/**
	 * MOSTRAR CARTERA DE CLIENTES
	 */
	
	static public function mdlMostrarCarteraClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.*,fp.fase, op.origen FROM $tabla as p LEFT OUTER JOIN faseprospecto AS fp ON p.faseProspecto = fp.id RIGHT OUTER JOIN origenprospectos AS op ON p.origenProspecto = op.id WHERE p.origenProspecto = op.id AND p.faseProspecto = fp.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/**
	 * MOSTRAR SEGUIMIENTOS
	 */
	
	static public function mdlMostrarSeguimientos($tabla,$item,$valor){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT titulo,fecha FROM $tabla WHERE $item = :$item order by id desc limit 1");

			$stmt -> bindParam(":".$item,$valor,PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt-> close();

			$stmt = null;

			
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT s.*, a.nombre as agente, p.nombreCompleto as prospecto, u.accion FROM $tabla AS s RIGHT OUTER JOIN agentesventas AS a ON s.idAgente = a.id LEFT OUTER JOIN prospectos AS p ON s.idProspecto = p.id LEFT OUTER JOIN ultimocontacto AS u ON s.idAccion = u.id WHERE s.idAgente = a.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

			$stmt-> close();

			$stmt = null;

		}

	}
	/* OBTENER LOS INDICADORES */
	static public function mdlObtenerIndicadores($table,$campos,$parametros){

		$stmt = Conexion::conectar()->prepare("SELECT $campos as total FROM $table $parametros");

		$stmt-> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


	}
	/* OBTENER TOTALES CERTEZAS */
	static public function mdlObtenerTotalCertezas($table,$campos,$parametros){

		$stmt = Conexion::conectar()->prepare("SELECT $campos  FROM $table $parametros");

		$stmt-> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


	}
	/* OBTENER TOTALES VENTAS */
	static public function mdlMostrarVentasTotales($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT vt.montoTotal,TIMESTAMPDIFF(DAY, date_format(op.fecha, '%Y-%m-%d') , date_format(vt.fechaVenta, '%Y-%m-%d')) as dias FROM $tabla as vt INNER JOIN oportunidades as op ON vt.idOportunidadVenta = op.id");

		$stmt-> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/********DESGLOSE PRODUCTOS DE OPORTUNIDADES Y VENTAS*******/
	static public function mdlVisualizarDesgloseProductos($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT monto,productos,codigos,cantidades,precios FROM $tabla where $item = :$item");

		$stmt -> bindParam(":".$item,$valor,PDO::PARAM_INT);

		$stmt->execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt =  null;

	}
	/**
	 * MOSTRAR EVENTOS PENDIENTES
	 */
	
	static public function mdlMostrarEventosPendientes(){

		$stmt = Conexion::conectar()->prepare("SELECT citas.id,citas.asunto,citas.descripcion,citas.fecha,citas.hora,'citas' as evento,citas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `citas` as citas INNER JOIN agentesventas as ag ON citas.idAgente = ag.id INNER JOIN prospectos as p ON citas.idProspecto = p.id where finalizada != 1 UNION SELECT llamada.id,llamada.titulo as asunto,llamada.descripcion,llamada.fecha,llamada.hora,'llamada' as evento,llamada.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `llamada` as llamada INNER JOIN agentesventas as ag ON llamada.idAgente = ag.id INNER JOIN prospectos as p ON llamada.idProspecto = p.id  where finalizada != 1 UNION SELECT visitas.id,visitas.asunto,visitas.descripcion,visitas.fecha,visitas.hora,'visitas' as evento,visitas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `visitas` as visitas INNER JOIN agentesventas as ag ON visitas.idAgente = ag.id INNER JOIN prospectos as p ON visitas.idProspecto = p.id where finalizada != 1 UNION SELECT record.id,record.asunto,record.descripcion,record.fecha,record.hora,'recordatorios' as evento,record.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `recordatorios` as record INNER JOIN agentesventas as ag ON record.idAgente = ag.id  INNER JOIN prospectos as p ON record.idProspecto = p.id  where finalizada != 1  UNION SELECT demo.id,demo.asunto,demo.descripcion,demo.fecha,demo.hora,'demostraciones' as evento,demo.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `demostraciones` as demo INNER JOIN agentesventas as ag ON demo.idAgente = ag.id INNER JOIN prospectos as p ON demo.idProspecto = p.id where finalizada != 1");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	/**
	 * MOSTRAR EVENTOS GENERALES
	 */
	
	static public function mdlMostrarEventosGenerales(){

		$stmt = Conexion::conectar()->prepare("SELECT citas.id,citas.asunto,citas.descripcion,citas.fecha,citas.hora,'citas' as evento,citas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `citas` as citas INNER JOIN agentesventas as ag ON citas.idAgente = ag.id INNER JOIN prospectos as p ON citas.idProspecto = p.id  UNION SELECT llamada.id,llamada.titulo as asunto,llamada.descripcion,llamada.fecha,llamada.hora,'llamada' as evento,llamada.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `llamada` as llamada INNER JOIN agentesventas as ag ON llamada.idAgente = ag.id INNER JOIN prospectos as p ON llamada.idProspecto = p.id   UNION SELECT visitas.id,visitas.asunto,visitas.descripcion,visitas.fecha,visitas.hora,'visitas' as evento,visitas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `visitas` as visitas INNER JOIN agentesventas as ag ON visitas.idAgente = ag.id INNER JOIN prospectos as p ON visitas.idProspecto = p.id  UNION SELECT record.id,record.asunto,record.descripcion,record.fecha,record.hora,'recordatorios' as evento,record.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `recordatorios` as record INNER JOIN agentesventas as ag ON record.idAgente = ag.id  INNER JOIN prospectos as p ON record.idProspecto = p.id    UNION SELECT demo.id,demo.asunto,demo.descripcion,demo.fecha,demo.hora,'demostraciones' as evento,demo.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `demostraciones` as demo INNER JOIN agentesventas as ag ON demo.idAgente = ag.id INNER JOIN prospectos as p ON demo.idProspecto = p.id ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	/**
	 * MOSTRAR LISTA DE EVENTOS
	 */
	
	static public function mdlMostrarListaEventos(){

		$stmt = Conexion::conectar()->prepare("SELECT citas.id,citas.asunto,citas.descripcion,citas.fecha,citas.hora,'citas' as evento,citas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `citas` as citas INNER JOIN agentesventas as ag ON citas.idAgente = ag.id INNER JOIN prospectos as p ON citas.idProspecto = p.id UNION SELECT llamada.id,llamada.titulo as asunto,llamada.descripcion,llamada.fecha,llamada.hora,'llamada' as evento,llamada.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `llamada` as llamada INNER JOIN agentesventas as ag ON llamada.idAgente = ag.id INNER JOIN prospectos as p ON llamada.idProspecto = p.id   UNION SELECT visitas.id,visitas.asunto,visitas.descripcion,visitas.fecha,visitas.hora,'visitas' as evento,visitas.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `visitas` as visitas INNER JOIN agentesventas as ag ON visitas.idAgente = ag.id INNER JOIN prospectos as p ON visitas.idProspecto = p.id  UNION SELECT record.id,record.asunto,record.descripcion,record.fecha,record.hora,'recordatorios' as evento,record.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `recordatorios` as record INNER JOIN agentesventas as ag ON record.idAgente = ag.id  INNER JOIN prospectos as p ON record.idProspecto = p.id    UNION SELECT demo.id,demo.asunto,demo.descripcion,demo.fecha,demo.hora,'demostraciones' as evento,demo.finalizada as estatus,ag.nombre as agente,p.nombreCompleto as prospecto FROM `demostraciones` as demo INNER JOIN agentesventas as ag ON demo.idAgente = ag.id INNER JOIN prospectos as p ON demo.idProspecto = p.id ");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*
	MOSTRAR EVENTOS DEL CALENDARIO
	 */
	static public function mdlMostrarEventosCalendario($tabla,$campos,$alias,$referencia){

		$stmt = Conexion::conectar()->prepare("SELECT $campos FROM $tabla as $alias $referencia");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}

	/*
	OBTENER DETALLES DE EVENTO
	 */
	static public function mdlObtenerDetallesEvento($tabla,$item,$valor,$campos){

		$stmt = Conexion::conectar()->prepare("SELECT $campos FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item,$valor,PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*
	OBTENER DETALLES DE EVENTO FINALIZADO
	 */
	static public function mdlObtenerDetallesEventoFinalizado($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT detalle FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item,$valor,PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


	}
	/*
	MOSTRAR DESCARTADOS
	 */
	static public function mdlMostrarDescartados($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.correo,p.celular,p.telefono,p.estatus,p.descartado,op.origen,av.nombre as agente,dc.razonDescartado as motivo FROM $tabla as p INNER JOIN descartados AS dc ON p.id = dc.idProspecto INNER JOIN origenprospectos AS op ON p.origenProspecto = op.id INNER JOIN agentesventas AS av ON p.idAgente = av.id WHERE  p.descartado = 1");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*
	MOSTRAR BITACORA
	 */
	static public function mdlMostrarBitacora($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT b.*,av.nombre as agente,p.nombreCompleto as prospecto FROM $tabla as b  INNER JOIN agentesventas AS av ON b.idAgente = av.id INNER JOIN prospectos AS p ON b.idProspecto = p.id");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*
	MOSTRAR HISTORIAL SEGUIMIENTOS
	 */
	static public function mdlMostrarHistorialSeguimientos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT s.*,av.nombre as agente,p.nombreCompleto as prospecto,asg.accion FROM $tabla as s  INNER JOIN agentesventas AS av ON s.idAgente = av.id INNER JOIN prospectos AS p ON s.idProspecto = p.id INNER JOIN accionesseguimientos AS asg ON s.idAccion = asg.id");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*
	MOSTRAR DIRECTORIO
	 */
	static public function mdlMostrarDirectorio($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,p.taller,p.correo,p.celular,p.telefono,p.estatus,p.descartado,p.domicilio,av.nombre as agente FROM $tabla as p   INNER JOIN agentesventas AS av ON p.idAgente = av.id WHERE p.telefono != '' || p.celular != '' ");


		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}

		/*
	MOSTRAR PROSPECTOS CON SEGUIMIENTOS
	 */
	static public function mdlMostrarProspectosConSeguimientos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT p.id,p.nombreCompleto,COUNT(sg.id) FROM $tabla as p INNER JOIN seguimientos as sg ON p.id = sg.idProspecto GROUP by p.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*
	OBTENER LISTADO SEGUIMIENTOS
	 */
	static public function mdlObtenerListadoSeguimientos($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT titulo,fecha,@numero:=@numero+1 AS `posicion` FROM seguimientos WHERE $item = :$item");

		$stmt -> bindParam(":".$item,$valor,PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


	}
	/*=============================================
    HABILITAR PROSPECTO
	=============================================*/

	static public function mdlHabilitarProspecto($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}