<?php
error_reporting(0);
include("../modelos/conexion.php");
class data extends Conexion
{
    public $mysqli;
    public $counter;
    function __construct()
    {
        $this->mysqli = $this->conectar();
    }

    public function countAll($sql)
    {
        $query = $this->mysqli->query($sql);
        $query = $query->fetchAll();
        return count($query);
    }

    public function getCartera($tabla, $campos, $search)
    {
        $offset = $search['offset'];
        $per_page  = $search['per_page'];


        $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%'";

        if ($search['idAgente'] != "") {

            $sWhere .= "and p.idAgente = ".$search['idAgente']." ";
        }
        if ($search['clasificacion'] != "") {

            $sWhere .= "and p.clasificacion = ".$search['clasificacion']." ";
        }

        if ($search['tipo'] != "") {
           $sWhere .= "and p.tipoCliente = ".$search['tipo']." ";

       }
       if ($search['fase'] != "") {
        switch ($search['fase']) {
            case '1':
            $sWhere .= "and p.oportunidad = 0 and p.cliente = 0 ";
            break;
            case '2':
            $sWhere .= "and p.oportunidad = 1 and p.cliente = 0 ";
            break;
            case '3':
            $sWhere .= "and p.oportunidad = 1 and p.cliente = 1 ";
            break;

        }

    }

    $sWhere .= "and p.descartado = 0 ORDER BY p.id DESC";

    $sql = "SELECT $campos FROM $tabla as p INNER JOIN agentesventas AS av ON p.idAgente = av.id INNER JOIN clasificacion AS cf ON p.clasificacion = cf.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM  $tabla as p INNER JOIN agentesventas AS av ON p.idAgente = av.id INNER JOIN clasificacion AS cf ON p.clasificacion = cf.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getCarteraReporte($idAgente,$clasificacion,$fase,$tipo){

    $sWhere = " p.nombreCompleto" . " LIKE '%%'";

    if ($idAgente != "") {

        $sWhere .= "and p.idAgente = ".$idAgente." ";
    }
    if ($clasificacion != "") {

        $sWhere .= "and p.clasificacion = ".$clasificacion." ";
    }

    if ($tipo != "") {
       $sWhere .= "and p.tipoCliente = ".$tipo." ";

   }
   if ($fase != "") {
    switch ($fase) {
        case '1':
        $sWhere .= "and p.oportunidad = 0 and p.cliente = 0 ";
        break;
        case '2':
        $sWhere .= "and p.oportunidad = 1 and p.cliente = 0 ";
        break;
        case '3':
        $sWhere .= "and p.oportunidad = 1 and p.cliente = 1 ";
        break;

    }

}

$sWhere .= "and p.descartado = 0 ORDER BY p.id DESC";

$sql = "SELECT p.id,p.nombreCompleto,p.taller,p.estatus,p.clasificacion,p.oportunidad,p.cliente,av.nombre as agente,cf.clasificacion as nombreClasificacion FROM prospectos as p INNER JOIN agentesventas AS av ON p.idAgente = av.id INNER JOIN clasificacion AS cf ON p.clasificacion = cf.id where $sWhere";

$query = $this->mysqli->query($sql);
$query = $query->fetchAll();
return $query;

}
public function getProspectos($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%'";

    if ($search['idAgente'] != "") {

        $sWhere .= "and p.idAgente = ".$search['idAgente']." ";
    }

    if ($search['comentarios'] != "") {

        if ($search['comentarios'] == 0) {
            $sWhere .= "and p.comentario != '' ";
        }else{
            $sWhere .= "and p.comentario = '' ";
        }
    }

    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and DATE(p.fechaAlta) BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= "and oportunidad = 0 and cliente = 0 and descartado = 0 ORDER BY p.id DESC";

    $sql = "SELECT $campos FROM $tabla as p INNER JOIN agentesventas AS av ON p.idAgente = av.id  where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM  $tabla as p INNER JOIN agentesventas AS av ON p.idAgente = av.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getProspectosReporte($idAgente,$comentarios,$fechaInicial,$fechaFinal){

  $sWhere = " p.nombreCompleto" . " LIKE '%%'";

  if ($idAgente != "") {

    $sWhere .= "and p.idAgente = ".$idAgente." ";
}

if ($comentarios != "") {

    if ($comentarios == 0) {
        $sWhere .= "and p.comentario != '' ";
    }else{
        $sWhere .= "and p.comentario = '' ";
    }
}
 if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and DATE(p.fechaAlta) BETWEEN '".$fechaInicial."' and '".$fechaFinal."' ";
    }
$sWhere .= "and oportunidad = 0 and cliente = 0 and descartado = 0 ORDER BY p.id DESC";


$sql = "SELECT p.*,av.nombre as agente FROM prospectos as p INNER JOIN agentesventas AS av ON p.idAgente = av.id  where $sWhere";

$query = $this->mysqli->query($sql);
$query = $query->fetchAll();
return $query;

}
public function getOportunidades($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and p.idAgente = ".$search['idAgente']." ";
    }
    
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and o.fecha BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= "and p.id = o.idProspecto and p.descartado = 0 ORDER BY p.id DESC";

    $sql = "SELECT $campos FROM $tabla as o INNER JOIN prospectos AS p ON o.idProspecto = p.id INNER JOIN certezas AS c ON o.idCerteza = c.id INNER JOIN faseoportunidades as f ON o.idFaseOportunidad = f.id  INNER JOIN agentesventas as av ON o.idAgente = av.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM  $tabla as o INNER JOIN prospectos AS p ON o.idProspecto = p.id INNER JOIN certezas AS c ON o.idCerteza = c.id INNER JOIN faseoportunidades as f ON o.idFaseOportunidad = f.id  INNER JOIN agentesventas as av ON o.idAgente = av.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getOportunidadesReporte($idAgente,$fechaInicial,$fechaFinal)
{
   
    $sWhere = " p.nombreCompleto" . " LIKE '%%'";

    if ($idAgente != "") {

        $sWhere .= "and p.idAgente = ".$idAgente." ";
    }
    
    if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and o.fecha BETWEEN '".$fechaInicial."%' and '".$fechaFinal."%' ";
    }

    $sWhere .= "and p.id = o.idProspecto and p.descartado = 0 ORDER BY p.id DESC";

    $sql = "SELECT o.id,o.idProspecto,p.nombreCompleto as nombre,p.taller,o.concepto,o.monto,o.comision,c.porcentaje,o.cierreEstimado,f.faseOportunidad as fase,av.nombre as agente,o.fecha,o.productos FROM oportunidades as o INNER JOIN prospectos AS p ON o.idProspecto = p.id INNER JOIN certezas AS c ON o.idCerteza = c.id INNER JOIN faseoportunidades as f ON o.idFaseOportunidad = f.id  INNER JOIN agentesventas as av ON o.idAgente = av.id  where $sWhere";

    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;
}
public function getClientes($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and av.id = ".$search['idAgente']." ";
    }
    
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and DATE(p.fechaAlta) BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= "and p.cliente = 1  and p.descartado != 1 ORDER BY p.id DESC";

    $sql = "SELECT $campos FROM $tabla as p  INNER JOIN agentesventas AS av ON p.idAgente = av.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM  $tabla as p  INNER JOIN agentesventas AS av ON p.idAgente = av.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getClientesReporte($idAgente)
{
    

    $sWhere = " p.nombreCompleto" . " LIKE '%%'";

    if ($idAgente != "") {

        $sWhere .= "and av.id  = ".$idAgente." ";
    }
    
    $sWhere .= "and p.cliente = 1  and p.descartado != 1 ORDER BY p.id DESC";

    $sql = "SELECT p.id,p.nombreCompleto,p.taller, av.nombre as agente FROM prospectos as p  INNER JOIN agentesventas AS av ON p.idAgente = av.id where $sWhere";

   
    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;

}
public function getVentasPeriodo($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and av.id = ".$search['idAgente']." ";
    }
    
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and DATE(vt.fechaVenta) BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= " ORDER BY vt.id DESC";

    $sql = "SELECT $campos FROM $tabla  as vt INNER JOIN agentesventas as av ON vt.idAgente = av.id INNER JOIN prospectos as p ON vt.idOportunidad = p.id INNER JOIN oportunidades as o ON vt.idOportunidadVenta = o.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM  $tabla  as vt INNER JOIN agentesventas as av ON vt.idAgente = av.id INNER JOIN prospectos as p ON vt.idOportunidad = p.id INNER JOIN oportunidades as o ON vt.idOportunidadVenta = o.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getVentasPeriodoReporte($idAgente,$fechaInicial,$fechaFinal)
{
    

    $sWhere = " p.nombreCompleto" . " LIKE '%%'";

    if ($idAgente != "") {

        $sWhere .= "and av.id = ".$idAgente." ";
    }
    
    if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and DATE(vt.fechaVenta) BETWEEN '".$fechaInicial."%' and '".$fechaFinal."%' ";
    }

    $sWhere .= " ORDER BY vt.id DESC";
    

    $sql = "SELECT vt.id idVenta ,p.nombreCompleto,p.taller,vt.concepto,vt.fechaVenta,vt.observaciones,vt.montoTotal,vt.cerradoDia,av.nombre as agente,vt.estatusVenta,o.id as idOportunidadVenta,o.productos,vt.serie,vt.folio FROM ventas as vt INNER JOIN agentesventas as av ON vt.idAgente = av.id INNER JOIN prospectos as p ON vt.idOportunidad = p.id INNER JOIN oportunidades as o ON vt.idOportunidadVenta = o.id where $sWhere";

   
    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;

}
public function getEventos($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " prospecto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and idAgente = ".$search['idAgente']." ";
    }
    if ($search['eventos'] != "") {

        $sWhere .= "and evento = '".$search['eventos']."' ";
    }
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and fecha BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= " ORDER BY fecha DESC";

    $sql = "SELECT $campos FROM $tabla where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM $tabla where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getEventosReporte($idAgente,$fechaInicial,$fechaFinal,$evento,$nombre)
{
    if ($nombre != "") {
        $sWhere = " prospecto" . " LIKE '%" . $nombre . "%' ";
    }else{
        $sWhere = " prospecto" . " LIKE '%%' ";
    }
    
    if ($idAgente != "") {

        $sWhere .= "and idAgente = ".$idAgente." ";
    }
    if ($evento != "") {

        $sWhere .= "and evento = '".$evento."' ";
    }
    if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and fecha BETWEEN '".$fechaInicial."%' and '".$fechaFinal."%' ";
    }

    $sWhere .= " ORDER BY fecha DESC";

    $sql = "SELECT * FROM eventoscalendario where $sWhere";

   
    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;

}
public function getBitacora($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and b.idAgente = ".$search['idAgente']." ";
    }
    
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and DATE(b.fecha) BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= " ORDER BY b.fecha DESC";

    $sql = "SELECT $campos FROM $tabla as b  INNER JOIN agentesventas AS av ON b.idAgente = av.id INNER JOIN prospectos AS p ON b.idProspecto = p.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM $tabla as b  INNER JOIN agentesventas AS av ON b.idAgente = av.id INNER JOIN prospectos AS p ON b.idProspecto = p.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getBitacoraReporte($idAgente,$fechaInicial,$fechaFinal,$nombre)
{
    if ($nombre != "") {
        $sWhere = " p.nombreCompleto" . " LIKE '%" . $nombre . "%' ";
    }else{
        $sWhere = " p.nombreCompleto" . " LIKE '%%' ";
    }


    if ($idAgente != "") {

        $sWhere .= "and b.idAgente = ".$idAgente." ";
    }
    
    if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and DATE(b.fecha) BETWEEN '".$fechaInicial."%' and '".$fechaFinal."%' ";
    }

    $sWhere .= " ORDER BY b.fecha DESC";

    $sql = "SELECT b.*,av.nombre as agente,p.nombreCompleto as prospecto FROM bitacora as b  INNER JOIN agentesventas AS av ON b.idAgente = av.id INNER JOIN prospectos AS p ON b.idProspecto = p.id where $sWhere";

   
    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;

}
public function getSeguimientos($tabla, $campos, $search)
{
    $offset = $search['offset'];
    $per_page  = $search['per_page'];


    $sWhere = " p.nombreCompleto" . " LIKE '%" . $search['query'] . "%' ";

    if ($search['idAgente'] != "") {

        $sWhere .= "and s.idAgente = ".$search['idAgente']." ";
    }
    if ($search['accion'] != "") {

        $sWhere .= "and s.idAccion = ".$search['accion']." ";
    }
    
    if ($search['fechaInicial'] != "" and $search['fechaFinal'] != "") {
        
        $sWhere .= "and DATE(s.fecha) BETWEEN '".$search['fechaInicial']."' and '".$search['fechaFinal']."' ";
    }

    $sWhere .= " ORDER BY s.fecha DESC";

    $sql = "SELECT $campos FROM $tabla as s INNER JOIN agentesventas AS av ON s.idAgente = av.id INNER JOIN prospectos AS p ON s.idProspecto = p.id INNER JOIN accionesseguimientos AS asg ON s.idAccion = asg.id where $sWhere LIMIT $offset,$per_page";

    $query = $this->mysqli->query($sql);

    $sql1 = "SELECT $campos FROM $tabla as s INNER JOIN agentesventas AS av ON s.idAgente = av.id INNER JOIN prospectos AS p ON s.idProspecto = p.id INNER JOIN accionesseguimientos AS asg ON s.idAccion = asg.id where $sWhere";

    $nums_row = $this->countAll($sql1);

        //Set counter
    $this->setCounter($nums_row);
    return $query;
}
public function getSeguimientosReporte($idAgente,$fechaInicial,$fechaFinal,$nombre,$accion)
{
    if ($nombre != "") {
        $sWhere = " p.nombreCompleto" . " LIKE '%" . $nombre . "%' ";
    }else{
        $sWhere = " p.nombreCompleto" . " LIKE '%%' ";
    }


    if ($idAgente != "") {

        $sWhere .= "and s.idAgente = ".$idAgente." ";
    }

    if ($accion != "") {

        $sWhere .= "and s.idAccion = ".$accion." ";
    }
    
    
    if ($fechaInicial != "" and $fechaFinal != "") {
        
        $sWhere .= "and DATE(s.fecha) BETWEEN '".$fechaInicial."%' and '".$fechaFinal."%' ";
    }

    $sWhere .= " ORDER BY s.fecha DESC";

    $sql = "SELECT s.*,av.nombre as agente,p.nombreCompleto as prospecto,asg.accion FROM seguimientos as s INNER JOIN agentesventas AS av ON s.idAgente = av.id INNER JOIN prospectos AS p ON s.idProspecto = p.id INNER JOIN accionesseguimientos AS asg ON s.idAccion = asg.id where $sWhere";

   
    $query = $this->mysqli->query($sql);
    $query = $query->fetchAll();
    return $query;

}
function setCounter($counter)
{
    $this->counter = $counter;
}
function getCounter()
{
    return $this->counter;
}
public function seg_a_dhms($seg)
{
    $dias = floor($seg / 86400);
    $horas = floor(($seg - ($dias * 86400)) / 3600);
    $minutos = floor(($seg - ($dias * 86400) - ($horas * 3600)) / 60);
    $segundos = $seg % 60;
    return "$dias dias, $horas horas, $minutos minutos, $segundos segundos";
}
}
