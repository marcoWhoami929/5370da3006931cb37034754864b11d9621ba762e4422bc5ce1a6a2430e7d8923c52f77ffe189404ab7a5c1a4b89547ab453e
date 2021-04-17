<?php
header("Access-Control-Allow-Origin: *");
include "encriptador.php";

/*
//Conexión a la base de datos
$conn = mysqli_connect("localhost","root","") or die("could not connect server");
mysqli_set_charset($conn, 'utf8');
mysqli_select_db($conn,"encuesta") or die("could not connect database");
*/
//Conexión a la base de datos
$conn = mysqli_connect("localhost","sanfranc_matriz","rootWhoami929") or die("could not connect server");
mysqli_set_charset($conn, 'utf8');
mysqli_select_db($conn,"sanfranc_crm") or die("could not connect database");


//LOGIN
if(isset($_POST['login']))
{
	$email=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['email'])));
	$password=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['password'])));
	$passwordEncrypt = $encriptar($password);
	$datos = mysqli_query($conn,"select * from `agentesventas` where `correo`='$email' and `password`='$passwordEncrypt'");
	$login=mysqli_num_rows(mysqli_query($conn,"select * from `agentesventas` where `correo`='$email' and `password`='$passwordEncrypt'"));
	if($login!=0)
	{

		while($fila=mysqli_fetch_array($datos)) {
			    
			    $datosUsuario = array('idUsuario'=> $fila["id"],'correo' => $fila["correo"],'nombre' => $fila["nombre"],'area' => $fila["area"]);
			    echo json_encode($datosUsuario);
			    
			}
		
	}
	else
	{
		echo "fail";
	}
}
/**********OBTENER SLIDER*************/
if(isset($_POST['cargarSlider']))
{

	$slider = mysqli_query($conn,"SELECT descripcion,imagen FROM slider WHERE activa = 1");

	if(mysqli_num_rows($slider) != 0)
	{
			$data = array();
			while($r = $slider->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/**********OBTENER SLIDER*************/
//LISTAR PROSPECTOS
if(isset($_POST['listarProspectos']))
{
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {
		
		$listarProspectos = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$idAgente' and oportunidad = 0 and cliente = 0 and descartado = 0 and estatus = 1 ORDER by habilitado desc");

	}else{

		$listarProspectos = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE oportunidad = 0 and cliente = 0 and descartado = 0 and estatus = 1 and clasificacion IN (1,2,3,4) ORDER by habilitado desc");


	}

	
	if(mysqli_num_rows($listarProspectos) != 0)
	{
			$data = array();
			while($r = $listarProspectos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
//LISTAR PROSPECTOS
////LISTAR OPORTUNIDADES
if(isset($_POST['listarOportunidades']))
{
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {
		
		$listarProspectos = mysqli_query($conn,"SELECT prosp.id,prosp.nombreCompleto,prosp.taller,prosp.celular,prosp.telefono,prosp.idAgente FROM oportunidades as opor INNER JOIN prospectos as prosp ON opor.idProspecto = prosp.id WHERE opor.idAgente = '$idAgente' and prosp.cliente != 1  and prosp.descartado = 0 and prosp.oportunidadesCreadas != 0 and opor.ventaCerrada = 0 GROUP by id");

	}else{

		$listarProspectos = mysqli_query($conn,"SELECT prosp.id,prosp.nombreCompleto,prosp.taller,prosp.celular,prosp.telefono,prosp.idAgente FROM oportunidades as opor INNER JOIN prospectos as prosp ON opor.idProspecto = prosp.id WHERE prosp.cliente != 1  and prosp.descartado = 0 and prosp.oportunidadesCreadas != 0 and opor.ventaCerrada = 0  and prosp.clasificacion IN (1,2,3,4) GROUP by id");
	}

	

	if(mysqli_num_rows($listarProspectos) != 0)
	{
			$data = array();
			while($r = $listarProspectos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
//LISTAR OPORTUNIDADES
/*****BUSCADOR DE PROSPECTOS********/
if(isset($_POST['listarResultadosBusqueda']))
{
	$search=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['search'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$idAgente' and oportunidad = '0' and cliente = '0' and descartado = '0' and estatus = '1' and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}else{

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE oportunidad = '0' and cliente = '0' and descartado = '0' and estatus = '1' and clasificacion IN (1,2,3,4) and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}

	

	if(mysqli_num_rows($listarResultadosBusqueda) != 0){
			$data = array();
			while($r = $listarResultadosBusqueda->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****BUSCADOR DE PROSPECTOS*********/
/*****BUSCADOR DE CLIENTES********/
if(isset($_POST['listarResultadosBusquedaClientes']))
{
	$search=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['search'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$idAgente' and cliente = '1' and descartado = '0' and estatus = '1' and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}else{

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE  cliente = '1' and descartado = '0' and estatus = '1' and clasificacion IN (1,2,3,4) and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}

	

	if(mysqli_num_rows($listarResultadosBusqueda) != 0){
			$data = array();
			while($r = $listarResultadosBusqueda->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****BUSCADOR DE CLIENTES*********/
/*****BUSCADOR DE CLIENTES EVENTOS********/
if(isset($_POST['listarResultadosBusquedaClientesEventos']))
{
	$search=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['search'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$idAgente'  and descartado = '0' and estatus = '1' and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}else{

		$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE   descartado = '0' and estatus = '1' and clasificacion IN (1,2,3,4) and nombreCompleto LIKE '%$search%' || taller LIKE '%$search%' ");
	}

	

	if(mysqli_num_rows($listarResultadosBusqueda) != 0){
			$data = array();
			while($r = $listarResultadosBusqueda->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****BUSCADOR DE CLIENTES*********/
/*****FILTRO DE PROSPECTOS********/
if(isset($_POST['listarResultadosFiltro']))
{
	$filtro=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['filtro'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

		$listarResultadosFiltro=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$filtro'  and descartado = '0' and estatus = '1' and cliente = '0' and oportunidad = '0'");
	 
	if(mysqli_num_rows($listarResultadosFiltro) != 0){
			$data = array();
			while($r = $listarResultadosFiltro->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****FILTRO DE PROSPECTOS*********/
/*****FILTRO DE CLIENTES POR AGENTE********/
if(isset($_POST['mostrarResultados']))
{
	$filtroClientes=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['filtroClientes'])));


		$mostrarResultados=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,idAgente FROM prospectos WHERE cliente = 1 and descartado != 1 and idAgente = '$filtroClientes'");
	 
	if(mysqli_num_rows($mostrarResultados) != 0){
			$data = array();
			while($r = $mostrarResultados->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****FILTRO DE CLIENTES POR AGENTE*********/

/*******DETALLE PROSPECTO***********/
if(isset($_POST['detalleProspecto']))
{
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));

	$detalleProspecto = mysqli_query($conn,"SELECT * FROM prospectos WHERE id = '$idProspecto'");

	if(mysqli_num_rows($detalleProspecto) != 0)
	{
			$data = array();
			while($r = $detalleProspecto->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******DETALLE PROSPECTO**********/
/*******LISTA TITULOS PROSPECTOS****/
if(isset($_POST['listaTitulosProspectos']))
{
	$tituloProspectos = mysqli_query($conn,"SELECT id,titulo FROM  tituloprospectos");

	if(mysqli_num_rows($tituloProspectos) != 0)
	{
			$data = array();
			while($r = $tituloProspectos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******LISTA TITULOS PROSPECTOS****/
/*******LISTA FASES PROSPECTOS****/
if(isset($_POST['listaFaseProspectos']))
{
	$faseProspecto = mysqli_query($conn,"SELECT id,fase FROM faseprospecto");

	if(mysqli_num_rows($faseProspecto) != 0)
	{
			$data = array();
			while($r = $faseProspecto->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******LISTA FASES PROSPECTOS****/
/*******LISTA ORIGEN PROSPECTOS****/
if(isset($_POST['listaOrigenProspectos']))
{
	$origenProspecto = mysqli_query($conn,"SELECT id,origen FROM origenprospectos");

	if(mysqli_num_rows($origenProspecto) != 0)
	{
			$data = array();
			while($r = $origenProspecto->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******LISTA ORIGEN PROSPECTOS****/
/*******EDITAR PROSPECTO****/
if(isset($_POST['editarProspecto']))
{	
	

	  	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
        $idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
        $nombrePerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombrePerfil'])));
        $correoPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['correoPerfil'])));
        $tallerPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['tallerPerfil'])));
        $telefonoPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['telefonoPerfil'])));
        $celularPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['celularPerfil'])));
        $direccionPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['direccionPerfil'])));
        $latitud = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['latitud'])));
        $longitud = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['longitud'])));
        $tituloProspectoPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['tituloProspectoPerfil'])));
        $faseProspectoPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['faseProspectoPerfil'])));
        $origenProspectoPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['origenProspectoPerfil'])));
        $comentariosPerfil = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['comentariosPerfil'])));

        $accion = "Ha sido actualizado";


        $notificacion =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

	$q = mysqli_query($conn,"UPDATE `prospectos` SET `nombreCompleto` = '$nombrePerfil',`correo` = '$correoPerfil',`taller` = '$tallerPerfil',`telefono` = '$telefonoPerfil',`celular` = '$celularPerfil', `domicilio` = '$direccionPerfil',`latitud` = '$latitud',`longitud` = '$longitud', `tituloProspecto` = '$tituloProspectoPerfil',`faseProspecto` = '$faseProspectoPerfil',`origenProspecto` = '$origenProspectoPerfil',`comentario` = '$comentariosPerfil'  WHERE  `id` = '$idProspecto'");

		
		if($q){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}
/*******EDITAR PROSPECTO****/
/*******REASIGNAR AGENTE****/
if(isset($_POST['reasignarAgente']))
{	
	

	  	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	  	$nombreProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
        $idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
        $nombreAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreAgente'])));
        $nuevoAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nuevoAgenteAsignado'])));
        $nombreAgenteAsignado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreAgenteAsignado'])));
        $comentarios = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['comentariosAsignacion'])));

        $accion = "".$nombreAgente." ha reasignado a ".$nombreProspecto." con ".$nombreAgenteAsignado."";
        $idAccion = 15; 

        $notificacion =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

		$q = mysqli_query($conn,"UPDATE `prospectos` SET `idAgente` = '$nuevoAgente',`comentarioReasignacion` = '$comentarios',`reasignado` = '1'  WHERE  `id` = '$idProspecto'");

		
		if($q){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}
/*******REASIGNAR AGENTE****/
/*******BUSCAR SEGUIMIENTOS PROSPECTOS****/
if(isset($_POST['buscarSeguimientosProspecto']))
{	

	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$busqueda = mysqli_query($conn,"SELECT COUNT(id) as seguimientos FROM `seguimientos` WHERE `idProspecto` = '$idProspecto'");

	if(mysqli_num_rows($busqueda) != 0)
	{			
			$seguimientos = $busqueda->fetch_array(MYSQLI_NUM);
	
			echo json_encode($seguimientos[0]);

	}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******BUSCAR SEGUIMIENTOS PROSPECTOS****/
/*******LISTA FASE OPORTUNIDADES****/
if(isset($_POST['listarFaseOportunidades']))
{
	$faseOportunidades = mysqli_query($conn,"SELECT id,faseOportunidad FROM faseoportunidades");

	if(mysqli_num_rows($faseOportunidades) != 0)
	{
			$data = array();
			while($r = $faseOportunidades->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

	}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******LISTA FASE OPORTUNIDADES****/
/*******LISTAR CERTEZAS****/
if(isset($_POST['listarCertezas']))
{
	$certezas = mysqli_query($conn,"SELECT id,porcentaje FROM certezas");

	if(mysqli_num_rows($certezas) != 0)
	{
			$data = array();
			while($r = $certezas->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******LISTAR CERTEZAS****/
/********GENERAR NUEVA OPORTUNIDAD****/
if(isset($_POST['generarOportunidad']))
{	
	

	  	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
        $idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
        $conceptoOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['conceptoOportunidad'])));
        $faseOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['faseOportunidad'])));
        $montoOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['montoOportunidad'])));
        $montoOportunidad = str_replace(',', '', $montoOportunidad);
        $cierreEstimado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['cierreEstimado'])));
        $certezaOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['certezaOportunidad'])));
        $productosOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productosOportunidad'])));
        $codigosOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['codigosOportunidad'])));
        $cantidadesOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['cantidadesOportunidad'])));
        $preciosOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['preciosOportunidad'])));
        $comentariosOportunidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['comentariosOportunidad'])));
        
        switch ($certezaOportunidad) {
        	case '1':
        		$certeza = "10%";
        		break;
        	case '2':
        		$certeza = "20%";
        		break;
        	case '3':
        		$certeza = "30%";
        		break;
        	case '4':
        		$certeza = "40%";
        		break;
        	case '5':
        		$certeza = "50%";
        		break;
        	case '6':
        		$certeza = "60%";
        		break;
        	case '7':
        		$certeza = "70%";
        		break;
        	case '8':
        		$certeza = "80%";
        		break;
        	case '9':
        		$certeza = "90%";
        		break;
        	case '10':
        		$certeza = "100%";
        		break;

        }

        $accion = "Convertido en oportunidad con el ".$certeza." en certeza.";
        $idAccion = 7;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

        $obtenerTotalOportunidades = mysqli_query($conn,"SELECT COUNT(id) as total FROM oportunidades WHERE idProspecto = '$idProspecto' and ventaCerrada = 0");

         while ($fila = mysqli_fetch_row($obtenerTotalOportunidades)) {
         	$totalOportunidades = $fila[0]+1;
	       
	    }

        $prospecto = mysqli_query($conn,"UPDATE `prospectos` SET `oportunidad` = '1',`oportunidadesCreadas` = '$totalOportunidades' WHERE `id` = '$idProspecto'");

		$oportunidad = mysqli_query($conn,"INSERT INTO `oportunidades` (`idProspecto`,`concepto`,`idFaseOportunidad`,`monto`,`productos`,`codigos`,`precios`,`cantidades`,`comision`,`porcentajeComision`,`cierreEstimado`,`idCerteza`,`observaciones`,`idAgente`,`ventaCerrada`) values ('$idProspecto','$conceptoOportunidad','$faseOportunidad','$montoOportunidad','$productosOportunidad','$codigosOportunidad','$preciosOportunidad','$cantidadesOportunidad','0.00','0','$cierreEstimado','$certezaOportunidad','$comentariosOportunidad','$idAgente','0')");

		
		if($oportunidad){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}
/********GENERAR NUEVA OPORTUNIDAD****/
/********LISTAR CLIENTES****/
if(isset($_POST['listarClientes']))
{
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {
		
		$listarClientes = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,idAgente FROM prospectos WHERE cliente = 1 and descartado != 1 and idAgente = '$idAgente'");

	}else{


		$listarClientes = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,idAgente FROM prospectos WHERE cliente = 1 and descartado != 1 and clasificacion IN (1,2,3,4)");

	}

	

	if(mysqli_num_rows($listarClientes) != 0)
	{
			$data = array();
			while($r = $listarClientes->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/********LISTAR CLIENTES****/
/********LISTAR OPORTUNIDADES DE VENTA****/
if(isset($_POST['listarOportunidadesVenta']))
{
	$idOportunidad =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idOportunidad'])));

	$listarOportunidadesVenta = mysqli_query($conn,"SELECT opor.id as idOportunidadVenta,opor.fecha,opor.monto,opor.concepto FROM oportunidades as opor INNER JOIN prospectos as prosp ON opor.idProspecto = prosp.id WHERE opor.idProspecto = '$idOportunidad' and ventaCerrada = 0");

	if(mysqli_num_rows($listarOportunidadesVenta) != 0)
	{
			$data = array();
			while($r = $listarOportunidadesVenta->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/********LISTAR OPORTUNIDADES DE VENTA****/
/********OBTENER DATOS DE OPORTUNIDAD****/
if(isset($_POST['obtenerDatosOportunidad']))
{
	$idOportunidadVenta =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idOportunidadVenta'])));

	$detalleOportunidad = mysqli_query($conn,"SELECT id,concepto,monto,porcentajeComision,comision FROM `oportunidades` WHERE id =  '$idOportunidadVenta'");

	if(mysqli_num_rows($detalleOportunidad) != 0)
	{
			$data = array();
			while($r = $detalleOportunidad->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/********OBTENER DATOS DE OPORTUNIDAD****/
/********GENERAR NUEVA VENTA****/
if(isset($_POST['cerrarVenta']))
{	
	

	  	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idOportunidad'])));
	  	$idOportunidadVenta= mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idOportunidadVenta'])));
        $idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
        $conceptoVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['conceptoVenta'])));
        $montoVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['montoVenta'])));
        $fechaVenta = date('Y-m-d');
        $comisionVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['comisionVenta'])));
        $serieVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['serieVenta'])));
        $folioVenta  = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['folioVenta'])));
        $observacionesVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['observacionesVenta'])));

        $accion = "Nueva Venta Realizada";
        $idAccion = 8;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

        $obtenerTotalOportunidades = mysqli_query($conn,"SELECT oportunidadesCreadas FROM prospectos WHERE id = '$idProspecto'");

         while ($fila = mysqli_fetch_row($obtenerTotalOportunidades)) {
         	$totalOportunidades = $fila[0]-1;
	       
	    }

        $prospecto = mysqli_query($conn,"UPDATE `prospectos` SET `cliente` = '1',`oportunidadesCreadas` = '$totalOportunidades' WHERE `id` = '$idProspecto'");
        $oportunidad = mysqli_query($conn,"UPDATE `oportunidades` SET `ventaCerrada` = '1' WHERE `id` = '$idOportunidadVenta'");

		$venta = mysqli_query($conn,"INSERT INTO `ventas` (`idOportunidad`,`concepto`,`cerradoDia`,`montoTotal`,`observaciones`,`noPagos`,`periodicidad`,`comisiones`,`porcentajeComision`,`estatusPagos`,`idAgente`,`idOportunidadVenta`,`estatusVenta`,`serie`,`folio`,`estatus`) values ('$idProspecto','$conceptoVenta','$fechaVenta','$montoVenta','$observacionesVenta','1','Actual','$comisionVenta','0','Pagado','$idAgente','$idOportunidadVenta','1','$serieVenta','$folioVenta','Vigente')");

		
		if($venta){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}
/********GENERAR NUEVA VENTA****/
/********LISTA GENERAL PROSPECTOS****/
if(isset($_POST['listaGeneralProspectos']))
{
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {

		$listaGeneral = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,correo,idAgente FROM prospectos WHERE idAgente = '$idAgente' and descartado = 0");
	}else{

		$listaGeneral = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,correo,idAgente FROM prospectos WHERE clasificacion IN (1,2,3,4) and idAgente = '$idAgente' and descartado = 0 order by nombreCompleto asc");
	}

	

	if(mysqli_num_rows($listaGeneral) != 0)
	{
			$data = array();
			while($r = $listaGeneral->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}

/********LISTA GENERAL PROSPECTOS****/
/********VENTAS REALIZADAS****/
if(isset($_POST['ventasRealizadas']))
{
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	if ($idAgente != 11 && $idAgente != 15) {
		
		$ventas = mysqli_query($conn,"SELECT id,concepto,cerradoDia,montoTotal,estatusPagos,idAgente FROM `ventas` WHERE idAgente = '$idAgente'");

	}else{

		$ventas = mysqli_query($conn,"SELECT id,concepto,cerradoDia,montoTotal,estatusPagos,idAgente FROM `ventas`");
	}

	

	if(mysqli_num_rows($ventas) != 0)
	{
			$data = array();
			while($r = $ventas->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}

/********VENTAS REALIZADAS****/
/********LISTA DE SEGUIMIENTOS****/
if(isset($_POST['detalleSeguimientos']))
{
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));

	$seguimientos = mysqli_query($conn,"SELECT titulo,fecha FROM `seguimientos` WHERE idProspecto = '$idProspecto'");

	if(mysqli_num_rows($seguimientos) != 0)
	{
			$data = array();
			while($r = $seguimientos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}

/********LISTA DE SEGUIMIENTOS****/
/********DATOS PROSPECTO****/
if(isset($_POST['datosProspectoDetalle']))
{
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));

	$datos = mysqli_query($conn,"SELECT id,nombreCompleto,domicilio,latitud,longitud FROM prospectos WHERE id = '$idProspecto'");

	if(mysqli_num_rows($datos) != 0)
	{
			$data = array();
			while($r = $datos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}

/********DATOS PROSPECTO****/
/*******AGENDAR NUEVA LLAMADA****/
if(isset($_POST['agendarNuevaLlamada']))
{	
	$tipoLlamada =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['tipoLlamada'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));

	$idAccion = 1;

	if ($tipoLlamada == "directa") {
		$accion = "Nueva Llamada Realizada a: ".$nombreProspecto;
	}else{
		$accion = "Nueva Llamada Agendada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";	
	}
	//$accion = "Nueva Llamada Agendada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";

    $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");
    $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

	$llamada = mysqli_query($conn,"INSERT INTO `llamada` (`titulo`,`descripcion`,`fecha`,`hora`,`idProspecto`,`idAgente`,`finalizada`,`detalle`) values ('$titulo','$descripcion','$fecha','$hora','$idProspecto','$idAgente','0','')");

		
		if($llamada){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********AGENDAR NUEVA LLAMADA****/
/*******AGENDAR NUEVA CITA****/
if(isset($_POST['agendarNuevaCita']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));

	$accion = "Nueva Cita Agendada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 2;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

		$cita = mysqli_query($conn,"INSERT INTO `citas` (`asunto`,`descripcion`,`fecha`,`hora`,`invitados`,`ubicacion`,`latitud`,`longitud`,`idProspecto`,`idAgente`,`finalizada`,`detalle`) values ('$titulo','$descripcion','$fecha','$hora','$nombreProspecto','$lugar','$lat','$long','$idProspecto','$idAgente','0','')");

		
		if($cita){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********AGENDAR NUEVA CITA****/
/*******AGENDAR NUEVA VISITA****/
if(isset($_POST['agendarNuevaVisita']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));

	$accion = "Nueva Visita Agendada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 3;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

		$visita = mysqli_query($conn,"INSERT INTO `visitas` (`asunto`,`descripcion`,`fecha`,`hora`,`contacto`,`ubicacion`,`latitud`,`longitud`,`idProspecto`,`idAgente`,`finalizada`,`detalle`) values ('$titulo','$descripcion','$fecha','$hora','$nombreProspecto','$lugar','$lat','$long','$idProspecto','$idAgente','0','')");

		
		if($visita){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********AGENDAR NUEVA VISITA****/
/*******AGENDAR NUEVO RECORDATORIO****/
if(isset($_POST['agendarNuevoRecordatorio']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));

	$accion = "Nuevo Recordatorio con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 4;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

		$recordatorio = mysqli_query($conn,"INSERT INTO `recordatorios` (`asunto`,`descripcion`,`fecha`,`hora`,`idProspecto`,`idAgente`,`finalizada`,`detalle`) values ('$titulo','$descripcion','$fecha','$hora','$idProspecto','$idAgente','0','')");

		
		if($recordatorio){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********AGENDAR NUEVO RECORDATORIO****/
/*******AGENDAR NUEVA DEMOSTRACION****/
if(isset($_POST['agendarNuevaDemostracion']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));
	$productos = mysqli_real_escape_string($conn,htmlspecialchars($_POST['productos']));

	$accion = "Nueva Demostración Agendada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 5;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

		$demostracion = mysqli_query($conn,"INSERT INTO `demostraciones` (`asunto`,`descripcion`,`fecha`,`hora`,`contacto`,`ubicacion`,`latitud`,`longitud`,`idProspecto`,`idAgente`,`productos`,`finalizada`,`detalle`) values ('$titulo','$descripcion','$fecha','$hora','$nombreProspecto','$lugar','$lat','$long','$idProspecto','$idAgente','$productos','0','')");

		
		if($demostracion){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********AGENDAR NUEVA DEMOSTRACION****/
/*******DESCARTAR PROSPECTO****/
if(isset($_POST['descartarProspecto']))
{	
		

	  	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
        $idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
        $nombreAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreAgente'])));
        $nombreDescartado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreDescartado'])));
        $motivoDescartado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['motivoDescartado'])));

        $accion = "".$nombreAgente." ha descartado a ".$nombreDescartado."";
        $idAccion = 14;

        $notificacion =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");
        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");

        $descartar =  mysqli_query($conn,"INSERT INTO `descartados` (`razonDescartado`,`idAgente`,`idProspecto`) values ('$motivoDescartado','$idAgente','$idProspecto') ");

		$descartado = mysqli_query($conn,"UPDATE `prospectos` SET `descartado` = '1',`estatus` = '0'  WHERE  `id` = '$idProspecto'");

		
		if($descartado){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}
/*******DESCARTAR PROSPECTO****/
/*******MOSTRAR MI CALENDARIO****/
if(isset($_POST['listarCalendario']))
{
	$idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$fechaEvento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fechaEvento'])));

	if ($fechaEvento != "") {

		$fecha = $fechaEvento;
		
	}else{

		$fecha = date('Y-m-d');;
	}

	
	$calendario = mysqli_query($conn,"SELECT id,asunto,descripcion,fecha,hora,'citas' as evento,finalizada FROM `citas` WHERE  fecha = '$fecha' and idAgente = '$idAgente' UNION SELECT id,titulo as asunto,descripcion,fecha,hora,'llamada' as evento,finalizada FROM `llamada` WHERE  fecha = '$fecha' and idAgente = '$idAgente' UNION SELECT id,asunto,descripcion,fecha,hora,'visitas' as evento,finalizada FROM `visitas` WHERE  fecha = '$fecha' and idAgente = '$idAgente' UNION SELECT id,asunto,descripcion,fecha,hora,'recordatorios' as evento,finalizada FROM `recordatorios` WHERE  fecha = '$fecha' and idAgente = '$idAgente' UNION SELECT id,asunto,descripcion,fecha,hora,'demostraciones' as evento,finalizada FROM `demostraciones` WHERE  fecha = '$fecha' and idAgente = '$idAgente'");

	if(mysqli_num_rows($calendario) != 0)
	{
			$data = array();
			while($r = $calendario->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******MOSTRAR MI CALENDARIO****/
/*******MOSTRAR PENDIENTES****/
if(isset($_POST['listarPendientes']))
{
	$idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	

	$pendientes = mysqli_query($conn,"SELECT id,asunto,descripcion,fecha,hora,'citas' as evento,finalizada FROM `citas` WHERE  finalizada != 1 and idAgente = '$idAgente'  UNION SELECT id,titulo as asunto,descripcion,fecha,hora,'llamada' as evento,finalizada FROM `llamada` WHERE  finalizada != 1 and idAgente = '$idAgente'  UNION SELECT id,asunto,descripcion,fecha,hora,'visitas' as evento,finalizada FROM `visitas` WHERE  finalizada != 1 and idAgente = '$idAgente'  UNION SELECT id,asunto,descripcion,fecha,hora,'recordatorios' as evento,finalizada FROM `recordatorios` WHERE  finalizada != 1 and idAgente = '$idAgente'  UNION SELECT id,asunto,descripcion,fecha,hora,'demostraciones' as evento,finalizada FROM `demostraciones` WHERE  finalizada != 1 and idAgente = '$idAgente' ");

	if(mysqli_num_rows($pendientes) != 0)
	{
			$data = array();
			while($r = $pendientes->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******MOSTRAR PENDIENTES****/
/*******MOSTRAR DETALLE EVENTO****/
if(isset($_POST['detalleEvento']))
{
	$idEvento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$evento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['evento'])));


	$detalle = mysqli_query($conn,"SELECT even.*,prosp.nombreCompleto FROM $evento as even INNER JOIN prospectos as prosp ON even.idProspecto = prosp.id WHERE  even.id = '$idEvento'");

	if(mysqli_num_rows($detalle) != 0)
	{
			$data = array();
			while($r = $detalle->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******MOSTRAR DETALLE EVENTO****/
/*******EDITAR VISITA****/
if(isset($_POST['editarVisita']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));

	$accion = "Se ha actualizado la visita con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 10;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $visita = mysqli_query($conn,"UPDATE `visitas` SET `asunto` = '$titulo',`descripcion` = '$descripcion',`fecha` = '$fecha',`hora` = '$hora',`contacto` = '$nombreProspecto',`ubicacion` = '$lugar',`latitud` = '$lat',`longitud` = '$long',`idAgente` = '$idAgente' WHERE  `id` = '$idEvento'");

		
		if($visita){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********EDITAR VISITA****/
/*******EDITAR CITA****/
if(isset($_POST['editarCita']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));

	$accion = "Se ha actualizado la cita con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 6;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $cita = mysqli_query($conn,"UPDATE `citas` SET `asunto` = '$titulo',`descripcion` = '$descripcion',`fecha` = '$fecha',`hora` = '$hora',`invitados` = '$nombreProspecto',`ubicacion` = '$lugar',`latitud` = '$lat',`longitud` = '$long',`idAgente` = '$idAgente' WHERE  `id` = '$idEvento'");

		
		if($cita){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********EDITAR CITA****/

/*******EDITAR LLAMADA****/
if(isset($_POST['editarLlamada']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));

	$accion = "Se ha actualizado la llamada con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 9;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $llamada = mysqli_query($conn,"UPDATE `llamada` SET `titulo` = '$titulo',`descripcion` = '$descripcion',`fecha` = '$fecha',`hora` = '$hora',`idAgente` = '$idAgente' WHERE  `id` = '$idEvento'");

		
		if($llamada){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********EDITAR LLAMADA****/
/*******EDITAR RECORDATORIO****/
if(isset($_POST['editarRecordatorio']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));

	$accion = "Se ha actualizado el recordatorio con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 11;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $recordatorio = mysqli_query($conn,"UPDATE `recordatorios` SET `asunto` = '$titulo',`descripcion` = '$descripcion',`fecha` = '$fecha',`hora` = '$hora',`idAgente` = '$idAgente' WHERE  `id` = '$idEvento'");

		
		if($recordatorio){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********EDITAR RECORDATORIO****/
/*******EDITAR DEMOSTRACION****/
if(isset($_POST['editarDemostracion']))
{	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$titulo =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['titulo'])));
	$fecha =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['fecha'])));
	$hora =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['hora'])));
	$descripcion =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['descripcion'])));
	$nombreProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));
	$lugar =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lugar'])));
	$lat =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['lat'])));
	$long =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['long'])));
	$productos =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productos'])));

	$accion = "Se ha actualizado la demostracion con ".$nombreProspecto." para el dia ".$fecha." a las ".$hora."";
        $idAccion = 12;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $demostracion = mysqli_query($conn,"UPDATE `demostraciones` SET `asunto` = '$titulo',`descripcion` = '$descripcion',`fecha` = '$fecha',`hora` = '$hora',`contacto` = '$nombreProspecto',`ubicacion` = '$lugar',`latitud` = '$lat',`productos` = '$productos',`longitud` = '$long',`idAgente` = '$idAgente' WHERE  `id` = '$idEvento'");

		
		if($demostracion){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********EDITAR DEMOSTRACION****/
/*******FINALIZAR EVENTO****/
if(isset($_POST['finalizarEvento']))
{	
	$idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idEvento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idEvento'])));
	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$detalle = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['detalleEvento'])));
	$nombreEvento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreEvento'])));
	$evento = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['evento'])));
	$nombreAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreAgente'])));
	$nombreProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['nombreProspecto'])));

	if ($nombreEvento != "Recordatorio" ) {
			
		$adjetivo = "La";
	}else{

		$adjetivo = "El";
	}

	$accion = "".$nombreAgente." ha finalizado ".$adjetivo." ".$nombreEvento." con ".$nombreProspecto."";
        $idAccion = 13;

        $bitacora =  mysqli_query($conn,"INSERT INTO `bitacora` (`accion`,`idAgente`,`idProspecto`) values ('$accion','$idAgente','$idProspecto') ");

        $seguimiento =  mysqli_query($conn,"INSERT INTO `seguimientos` (`titulo`,`idAgente`,`idProspecto`,`idAccion`) values ('$accion','$idAgente','$idProspecto','$idAccion') ");


        $finalizar = mysqli_query($conn,"UPDATE $evento SET `finalizada` = 1,`detalle` = '$detalle' WHERE  `id` = '$idEvento'");

		
		if($finalizar){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********FINALIZAR EVENTO****/
/*******OBTENER DETALLE VENTA****/
if(isset($_POST['obtenerDetalleVenta']))
{
	$idVenta = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idVenta'])));
	

	$detalle = mysqli_query($conn,"SELECT vent.id,vent.concepto,vent.cerradoDia,vent.montoTotal,vent.observaciones,vent.serie,vent.folio,vent.cancelado,vent.estatus,vent.fechaCancelacion,vent.motivoCancelacion,opor.productos,opor.codigos,opor.cantidades,opor.precios,prosp.nombreCompleto,prosp.domicilio,prosp.celular,prosp.taller,vent.idOportunidad as prospectoId,vent.idAgente FROM `ventas` as vent INNER JOIN oportunidades as opor ON vent.idOportunidadVenta= opor.id INNER JOIN prospectos as prosp ON vent.idOportunidad = prosp.id WHERE vent.id = '$idVenta'");

	if(mysqli_num_rows($detalle) != 0)
	{
			$data = array();
			while($r = $detalle->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/*******OBTENER DETALLE VENTA****/
/********OBTENER LISTA DE PRECIOS ESPECIALES****/
if(isset($_POST['obtenerListaPrecios']))
{

	$listaPrecios = mysqli_query($conn,"SELECT * FROM `listaPrecios`");

	if(mysqli_num_rows($listaPrecios) != 0)
	{
			$data = array();
			while($r = $listaPrecios->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}
	else
	{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/********OBTENER LISTA DE PRECIOS ESPECIALES****/
/*****BUSCADOR DE PRECIOS********/
if(isset($_POST['listarResultadosBusquedaPrecios']))
{
	$search=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['search'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

	$listarResultadosBusqueda=mysqli_query($conn,"SELECT id,codigo,producto,precioPublico,precioEspecial,descuento FROM listaPrecios WHERE  producto LIKE '%$search%' || codigo LIKE '%$search%' ");

	if(mysqli_num_rows($listarResultadosBusqueda) != 0){
			$data = array();
			while($r = $listarResultadosBusqueda->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****BUSCADOR DE PRECIOS*********/
/*****obtenerSpeech********/
if(isset($_POST['obtenerSpeech']))
{
	
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));

	$listarSpeech=mysqli_query($conn,"SELECT * FROM speech WHERE idAgente = '$idAgente' and idProspecto = '$idProspecto'  ");

	if(mysqli_num_rows($listarSpeech) != 0){
			$data = array();
			while($r = $listarSpeech->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****obtenerSpeech*********/
/*******GENERAR SPEECH****/
if(isset($_POST['generarSpeech']))
{	
	$idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$productosCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productosCalidad'])));
	$problemasCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['problemasCalidad'])));
	$asesoramientoCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['asesoramientoCalidad'])));
	$entregasServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['entregasServicio'])));
	$igualadoServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['igualadoServicio'])));
	$atencionServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['atencionServicio'])));
	$productosFueraPrecio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productosFueraPrecio'])));
	$preciosFueraPrecio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['preciosFueraPrecio'])));
	$canalizado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['canalizado'])));
	$canalizadoCon = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['canalizadoCon'])));

        $speech =  mysqli_query($conn,"INSERT INTO `speech` (`idAgente`,`idProspecto`,`productos`,`problemas`,`asesoramiento`,`entregas`,`igualado`,`atencion`,`productosPrecios`,`preciosProductos`,`canalizado`,`canalizadoCon`) values ('$idAgente','$idProspecto','$productosCalidad','$problemasCalidad','$asesoramientoCalidad','$entregasServicio','$igualadoServicio','$atencionServicio','$productosFueraPrecio','$preciosFueraPrecio','$canalizado','$canalizadoCon') ");


		if($speech){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}
if(isset($_POST['actualizarSpeech']))
{	
	$idSpeech = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idSpeech'])));
	$idAgente = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));
	$idProspecto = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idProspecto'])));
	$productosCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productosCalidad'])));
	$problemasCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['problemasCalidad'])));
	$asesoramientoCalidad = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['asesoramientoCalidad'])));
	$entregasServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['entregasServicio'])));
	$igualadoServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['igualadoServicio'])));
	$atencionServicio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['atencionServicio'])));
	$productosFueraPrecio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['productosFueraPrecio'])));
	$preciosFueraPrecio = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['preciosFueraPrecio'])));
	$canalizado = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['canalizado'])));
	$canalizadoCon = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['canalizadoCon'])));

        $speech = mysqli_query($conn,"UPDATE `speech` SET `productos` = '$productosCalidad',`problemas` = '$problemasCalidad',`asesoramiento` = '$asesoramientoCalidad',`entregas` = '$entregasServicio',`igualado` = '$igualadoServicio',`atencion` = '$atencionServicio',`productosPrecios` = '$productosFueraPrecio',`preciosProductos` = '$preciosFueraPrecio',`canalizado` = '$canalizado',`canalizadoCon` = '$canalizadoCon' WHERE  `id` = '$idSpeech'");
		if($speech){

			echo "success";

		}else{

			echo "failed";
		}
	echo mysqli_error($conn);
}

/********GENERAR SPEECH****/
/*****FILTRO DE USUARIOS EVENTOS********/
if(isset($_POST['listarResultadosFiltroEventos']))
{
	$filtro=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['filtro'])));
	$idAgente =mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['idAgente'])));

		$listarResultadosFiltroEventos=mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,habilitado,idAgente FROM prospectos WHERE idAgente = '$filtro'  and descartado = '0' and estatus = '1'");
	 
	if(mysqli_num_rows($listarResultadosFiltroEventos) != 0){
			$data = array();
			while($r = $listarResultadosFiltroEventos->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****FILTRO DE USUARIOS EVENTOS*********/
/*****FILTRO DE CLIENTES EN LLAMADA********/
if(isset($_POST['mostrarFiltroClientesLlamada']))
{
	$filtroLlamadas=mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['filtroLlamadas'])));

	if ($filtroLlamadas != 11) {

		$mostrarFiltroClientesLlamada = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,correo,idAgente FROM prospectos WHERE idAgente = '$filtroLlamadas' and descartado = 0");
	}else{

		$mostrarFiltroClientesLlamada = mysqli_query($conn,"SELECT id,nombreCompleto,taller,celular,telefono,correo,idAgente FROM prospectos WHERE clasificacion IN (1,2,3,4) and idAgente = '$filtroLlamadas' and descartado = 0 order by nombreCompleto asc");
	}

	if(mysqli_num_rows($mostrarFiltroClientesLlamada) != 0){
			$data = array();
			while($r = $mostrarFiltroClientesLlamada->fetch_assoc()){
				$data[] = $r;
			}
			echo json_encode($data);

			}else{
		echo 'failed';
	}
	echo mysqli_error($conn);
}
/****FILTRO DE CLIENTES EN LLAMADA*********/
?>