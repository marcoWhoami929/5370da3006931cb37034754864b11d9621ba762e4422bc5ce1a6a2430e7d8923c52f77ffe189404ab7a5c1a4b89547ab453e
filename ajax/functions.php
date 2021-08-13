<?php
include('../classes/data.php');
require_once "../controladores/crm.php";
require_once "../modelos/crm.php";
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'cartera') {
    $database = new data();
    $query = strip_tags($_REQUEST['query']);
    $idAgente = strip_tags($_REQUEST['idAgente']);
    $clasificacion = strip_tags($_REQUEST['clasificacion']);
    $fase = strip_tags($_REQUEST['fase']);
    $tipo = strip_tags($_REQUEST['tipo']);
    $per_page = intval($_REQUEST['per_page']);
    $tabla = "prospectos";
    $campos = "p.id,p.nombreCompleto,p.taller,p.estatus,p.clasificacion,p.oportunidad,p.cliente,av.nombre as agente,cf.clasificacion as nombreClasificacion";
    $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $adjacents = 4;
    $offset = ($page - 1) * $per_page;

    $search = array("query" => $query, "idAgente" => $idAgente,"clasificacion" => $clasificacion,"fase" => $fase,"tipo" => $tipo, "per_page" => $per_page, "offset" => $offset);

    $datos = $database->getCartera($tabla, $campos, $search);

    $countAll = $database->getCounter();
    $row = $countAll;

    if ($row > 0) {
        $numrows = $countAll;;
    } else {
        $numrows = 0;
    }
    $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

    if ($numrows > 0) {
        ?>
        <div class="table-responsive">

            <table class="table  table-hover  table-striped dt-responsive tablaCartera tableColor">
              <thead class="headColor">

                 <tr>
                   <th style="border:none">#</th>
                   <th style="border:none">Nombre/Taller</th>
                   <th style="border:none">Clasificación</th>
                   <th style="border:none">Fase</th>
                   <th style="border:none">Ultimo Contacto</th>
                   <th style="border:none"># Opor</th>
                   <th style="border:none">$ Opor</th>
                   <th style="border:none"># Ventas</th>
                   <th style="border:none">$ Ventas</th>
                   <th style="border:none">Grafico</th>
                   <th style="border:none">Ultima Venta</th>
                   <th style="border:none">Ejecutivo</th>

                   <th style="border:none">Estatus</th>
               </tr>

           </thead>
           <tbody>
            <?php
            $finales = 0;
            foreach ($datos as $key => $row) {
                if ($row["estatus"] == 1) {
                    $estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
                }else{
                    $estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
                }

                /***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
                $item = "idProspecto";
                $valor = $row["id"];
                $obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

                if ($obtenerUltimoSeguimiento["titulo"] == "" and $row["clasificacion"] = 1) {
                    $seguimiento = "Nuevo prospecto creado apartir de encuesta blitz";
                }
                if($obtenerUltimoSeguimiento["titulo"] == "" and $row["clasificacion"] = 2){
                    $seguimiento = "Sin seguimiento";
                }
                if($obtenerUltimoSeguimiento["titulo"] == "" and $row["clasificacion"] = 3){
                    $seguimiento = "Sin seguimiento";
                }
                if($obtenerUltimoSeguimiento["titulo"] == "" and $row["clasificacion"] = 4){
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
                $valor = $row["id"];
                $obtenerOportunidadesCreadas = ControladorGeneral::ctrObtenerOportunidadesCreadas($item,$valor);

                $cantidadOportunidades = $obtenerOportunidadesCreadas["cantidad"];
                $montoOportunidades = $obtenerOportunidadesCreadas["monto"];

                /*OBTENER LAS VENTAS CREADAS*/
                $item = "idOportunidad";
                $valor = $row["id"];
                $obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

                $cantidadVentas = $obtenerVentasCreadas["cantidad"];
                $montoVentas = $obtenerVentasCreadas["monto"];

                $item = "idOportunidad";
                $valor = $row["id"];
                $fechaUltimaVenta = ControladorGeneral::ctrUltimaVentaGenerada($item,$valor);

                if ($fechaUltimaVenta["fecha"] == "") {
                    $fecha = "Sin venta";
                }else{
                    $fecha = $fechaUltimaVenta["fecha"];
                }

                if ($row["oportunidad"] == 0 and $row["cliente"] == 0 ) {
                    $fase = "Prospecto";
                }
                if ($row["oportunidad"] == 1 and $row["cliente"] == 0 ) {
                    $fase = "Oportunidad";
                }
                if ($row["oportunidad"] == 1 and $row["cliente"] == 1 ) {
                    $fase = "Cliente";
                }


                $contarVentas = ControladorGeneral::ctrContarVentas($item,$valor);
                if ($contarVentas["contado"] == 0) {
                    $grafico = "";
                }else{

                  $grafico = "<button type='button' class='btn btn-secondary btn-sm'  onclick='verGraficoVentas(".$row['id'].");'  data-toggle='modal' data-target='#modalVentasProspectos'><i class='fa fa-eye'></i></button>";
              }


              ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= '<strong>'.$row["nombreCompleto"].'</strong><br>'.$row["taller"].'' ?></td>

                <td><?= $row['nombreClasificacion'] ?></td>
                <td><?= $fase ?></td>
                <td><?= '<strong>'.$transcurrido.'</strong>'.$seguimiento ?></td>
                <td><?= $cantidadOportunidades ?></td>
                <td><?= "$".number_format($montoOportunidades,2) ?></td>
                <td><?= $cantidadVentas ?></td>
                <td><?= "$".number_format($montoVentas,2) ?></td>
                <td><?= $grafico ?></td>
                <td><?= $fecha ?></td>
                <td><?= $row["agente"] ?></td>
                <td><?= $estado ?></td>
            </tr>
            <?php
            $finales++;
        }
        ?>

    </tbody>
</table>

<div class="clearfix">
    <?php
    $inicios = $offset + 1;
    $finales += $inicios - 1;
    echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateCartera();

                ?>
            </div>
            <?php  
        }
    }
    ?>
    <!---->
    <?php
    if ($action == 'prospectos') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $comentarios = strip_tags($_REQUEST['comentarios']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "prospectos";
        $campos = "p.*,av.nombre as agente";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"comentarios" => $comentarios,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getProspectos($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaProspectos tableColor">
                  <thead class="headColor">

                     <tr>
                         <th style="border:none">#</th>
                         <th style="border:none">Nombre/Taller</th>
                         <th style="border:none">Comentarios</th>
                         <th style="border:none">Ultimo Contacto</th>
                         <th style="border:none">Ejecutivo</th>
                         <th style="border:none">Habilitado</th>
                         <th style="border:none">Estatus</th>
                     </tr>

                 </thead>
                 <tbody>
                    <?php
                    $finales = 0;
                    foreach ($datos as $key => $row) {

                        if ($row["estatus"] == 1) {
                            $estado = "<button type='button' class='btn btn-success btn-sm'>Activo</button>";
                        }else{
                            $estado = "<button type='button' class='btn btn-danger btn-sm'>Inactivo</button>";
                        }




                        $item = "idProspecto";
                        $valor = $row["id"];
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

                        if ($row["habilitado"] != 0) {
                            $habilitado = "<button type='button' class='btn btn-success btn-sm' onclick='habilitarProspecto(".$row['id'].",0);'><i class='fa fa-power-off'></i>Habilitado</button>";
                        }else{

                            $habilitado = "<button type='button' class='btn btn-danger btn-sm' onclick='habilitarProspecto(".$row['id'].",1);'><i class='fa fa-power-off'></i>Deshabilitado</button>";
                        }




                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= '<strong>'.$row["nombreCompleto"].'</strong><br>'.$row["taller"].'' ?></td>

                            <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["comentario"]).'</strong>' ?></td>
                            <td><?= '<strong>'.$transcurrido.'</strong>'.$seguimiento ?></td>
                            <td><?= $row["agente"] ?></td>
                            <td><?= $habilitado ?></td>
                            <td><?= $estado ?></td>
                        </tr>
                        <?php
                        $finales++;
                    }
                    ?>

                </tbody>
            </table>

            <div class="clearfix">
                <?php
                $inicios = $offset + 1;
                $finales += $inicios - 1;
                echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateProspectos();

                ?>
            </div>
            <?php 
        }
    }
    ?>
    <!---->
    <?php
    if ($action == 'oportunidades') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "oportunidades";
        $campos = "o.id,o.idProspecto,p.nombreCompleto as nombre,p.taller,o.concepto,o.monto,o.comision,c.porcentaje,o.cierreEstimado,f.faseOportunidad as fase,av.nombre as agente,o.fecha,o.productos";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getOportunidades($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaOportunidades tableColor">
                  <thead class="headColor">
                   <tr>
                     <th style="border:none">#</th>
                     <th style="border:none">Nombre<br>/Taller</th>
                     <th style="border:none">Concepto</th>
                     <th style="border:none">Fecha</th>
                     <th style="border:none">Monto</th>
                     <th style="border:none">Certeza</th>
                     <th style="border:none">Cierre Estimado</th>
                     <th style="border:none">Ultimo Contacto</th>
                     <th style="border:none">Productos</th>
                     <th style="border:none">Ejecutivo</th>

                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {

              
                if (str_replace('%','',$row["porcentaje"]) <= 39) {
                    $indicador =  "<button type='button' class='btn btn-danger btn-sm'></button>";
                }else if(str_replace('%','',$row["porcentaje"]) >= 40 and str_replace('%','',$row["porcentaje"]) <= 69){
                    $indicador =  "<button type='button' class='btn btn-warning btn-sm'></button>";
                }else if(str_replace('%','',$row["porcentaje"]) >= 70){
                    $indicador =  "<button type='button' class='btn btn-success btn-sm'></button>";
                }

                /******VERIFICAR SI LA FECHA DE CIERRE YA PASO*****/

                $fechaActual =  date('Y-m-d');
                $fechaCierre =   $row["cierreEstimado"];

                if ($fechaActual < $fechaCierre) {
                    $cierreEstimado = "<strong>".$row["cierreEstimado"]."</strong>";
                }else{
                    $cierreEstimado = "<strong style='color:red'>".$row["cierreEstimado"]."</strong>";
                }


                $item = "idProspecto";
                $valor = $row["idProspecto"];
                $obtenerUltimoSeguimiento = ControladorGeneral::ctrMostrarSeguimientos($item,$valor);

                $seguimiento = $obtenerUltimoSeguimiento["titulo"];

                /***********VERIFICAR EL TIEMPO TRANSCURRIDO*****/
                $fecha = new DateTime("now");
                $fechaOperacion = new DateTime($obtenerUltimoSeguimiento["fecha"]);
                $diferencia = $fechaOperacion -> diff($fecha);

                $transcurrido = ControladorGeneral::formatearFecha($diferencia);

                if ($row["productos"] != "") {
                    $productos = "<button type='button' class='btn btn-success btn-sm btnVisualizarProductos' data-toggle='modal' data-target='#visualizarProductos' onclick='visualizarProductos(".$row["id"].");'>Visualizar</button>";
                }else{
                    $productos = "<button type='button' class='btn btn-danger btn-sm'>Sin Productos</button>";
                }  

                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= '<strong>'.$row["nombre"].'</strong><br>'.$row["taller"].'' ?></td>

                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["concepto"]).'</strong>' ?></td>
                    
                    <td><?= '<strong>'.$row["fecha"].'</strong>' ?></td>
                    <td><?= '<strong>$ '.number_format($row["monto"],2).'</strong>' ?></td>
                    <td><?= '<strong>'.$row["porcentaje"].'</strong><br>'.$indicador.'' ?></td>
                    <td><?= $cierreEstimado ?></td>
                    <td><?= '<strong>'.$transcurrido.'</strong>'.$seguimiento.'' ?></td>
                    <td><?= $productos ?></td>
                    <td><?= $row["agente"] ?></td>
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateOportunidades();

                ?>
            </div>
            <?php 
        }
    }
?>
<!---->
    <?php
    if ($action == 'clientes') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "prospectos";
        $campos = "p.id,p.nombreCompleto,p.taller, av.nombre as agente";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getClientes($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaClientes tableColor">
                  <thead class="headColor">
                   <tr>
                      <th style="border:none">#</th>
                      <th style="border:none">Nombre/Taller</th>
                      <th style="border:none">Ticket Promedio</th>
                      <th style="border:none">Ultimo Contacto</th>
                      <th style="border:none">Ejecutivo</th>

                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {
      
                    $item = "idProspecto";
                    $valor = $row["id"];
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
                    $valor = $row["id"];
                    $obtenerOportunidadesCreadas = ControladorGeneral::ctrObtenerOportunidadesCreadas($item,$valor);

                    $cantidadOportunidades = $obtenerOportunidadesCreadas["cantidad"];
                    $montoOportunidades = $obtenerOportunidadesCreadas["monto"];

                    /*OBTENER LAS VENTAS CREADAS*/
                    $item = "idOportunidad";
                    $valor = $row["id"];
                    $obtenerVentasCreadas = ControladorGeneral::ctrObtenerVentasCreadas($item,$valor);

                    $cantidadVentas = $obtenerVentasCreadas["cantidad"];
                    $montoVentas = $obtenerVentasCreadas["monto"];

                    if ($cantidadVentas == 0) {
                        $ticketPromedio = 0;
                    }else{
                        $ticketPromedio = $montoVentas/$cantidadVentas;
                    } 

                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= '<strong>'.$row["nombreCompleto"].'</strong><br>'.$row["taller"].'' ?></td>
                    <td><?= '<strong>$ '.number_format($ticketPromedio,2).'</strong>' ?></td>
                    <td><?= $ultimaCompra ?></td>
                    <td><?= $row["agente"] ?></td>
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateClientes();

                ?>
            </div>
            <?php 
        }
    }
?>
<!---->
    <?php
    if ($action == 'ventasPeriodo') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "ventas";
        $campos = "vt.id idVenta ,p.nombreCompleto,p.taller,vt.concepto,vt.fechaVenta,vt.observaciones,vt.montoTotal,vt.cerradoDia,av.nombre as agente,vt.estatusVenta,o.id as idOportunidadVenta,o.productos,vt.serie,vt.folio";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getVentasPeriodo($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaVentas tableColor">
                  <thead class="headColor">
                   <tr>
                      <th style="border:none">#</th>
                      <th style="border:none">Nombre / Taller</th>
                      <th style="border:none">Concepto</th>
                      <th style="border:none">Serie / Folio</th>
                      <th style="border:none">Fecha</th>
                      <th style="border:none">Observaciones</th>
                      <th style="border:none">Total</th>
                      <th style="border:none">Cerrado El Día</th>
                      <th style="border:none">Ejecutivo</th>
                      <th style="border:none">Productos</th>
                      <th style="border:none">Estatus</th>


                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {
      
                  if ($row["estatusVenta"] == 1) {
                        $estatus = "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-money-bill-wave'></i>Vigente</button>";

                    }else{
                        $estatus = "<button type='button' class='btn btn-danger btn-sm'><i class='fas fa-money-bill-wave'></i>Cancelada</button>";
                    }

                    if ($row["productos"] != "") {
                        $productos = "<button type='button' class='btn btn-success btn-sm btnVisualizarProductos' data-toggle='modal' data-target='#visualizarProductos' onclick='visualizarProductos(".$row["idOportunidadVenta"].");' >Visualizar</button>";
                    }else{
                        $productos = "<button type='button' class='btn btn-danger btn-sm'>Sin Productos</button>";
                    }

                ?>
                <tr>
                    <td><?= $row['idVenta'] ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["nombreCompleto"]).'</strong><br>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["taller"]).'' ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["concepto"]).'</strong>' ?></td>
                    <td><?= '<strong>'.$row["serie"].'</strong><br>'.$row["folio"].'' ?></td>
                    <td><?= $row["fechaVenta"] ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["observaciones"]).'</strong>' ?></td>
                    <td><?= '<strong>$ '.number_format($row["montoTotal"],2).'</strong>' ?></td>
                    <td><?= $row["cerradoDia"] ?></td>
                    <td><?= $row["agente"] ?></td>
                    <td><?= $productos ?></td>
                    <td><?= $estatus ?></td>
                    
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateVentasPeriodo();

                ?>
            </div>
            <?php 
        }
    }
?>
<!---->
    <?php
    if ($action == 'eventos') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $eventos = strip_tags($_REQUEST['evento']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "eventoscalendario";
        $campos = "*";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal,"eventos" => $eventos, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getEventos($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaVentas tableColor">
                  <thead class="headColor">
                   <tr>
                      <th style="border:none">Evento</th>
                      <th style="border:none">Folio Evento</th>
                      <th style="border:none">Contacto</th>
                      <th style="border:none">Asunto</th>
                      <th style="border:none">Descripción</th>
                      <th style="border:none">Fecha</th>
                      <th style="border:none">Hora</th>
                      <th style="border:none">Estatus</th>
                      <th style="border:none">Agente</th>

                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {
      
                    $evento = $row["evento"];
                    switch ($evento) {
                        case 'citas':
                            $evento =  "<button type='button' class='btn btn-primary btn-sm'><i class='fa fa-calendar'></i></button>";
                            break;
                        case 'llamada':
                            $evento =  "<button type='button' class='btn btn-success btn-sm'><i class='fa fa-phone-volume'></i></button>";
                            break;
                        case 'visitas':
                            $evento =  "<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-map-marked-alt'></i></button>";
                            break;
                        case 'demostraciones':
                            $evento =  "<button type='button' class='btn btn-warning btn-sm'><i class='fa fa-fill-drip'></i></button>";
                            
                            break;
                        case 'recordatorios':
                            $evento =  "<button type='button' class='btn btn-info btn-sm'><i class='fa fa-stopwatch'></i></button>";
                            break;

                    }

                    if ($row["estatus"] == 1) {
                        $estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:green'></i>";
                    }else{
                        $estatus = "<i class='fa fa-flag-checkered fa-2x' style='color:red'></i>";
                    }

                ?>
                <tr>
                    <td><?= $evento ?></td>
                    <td><?= $row["id"] ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["prospecto"]).'</strong>' ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["asunto"]).'</strong>' ?></td>
                    <td><?= '<strong>'.preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $row["descripcion"]).'</strong>' ?></td>
                    <td><?= $row["fecha"] ?></td>
                    <td><?= $row["hora"] ?></td>
                    <td><?= $estatus ?></td>
                    <td><?= $row["agente"] ?></td>
                    
                    
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateEventos();

                ?>
            </div>
            <?php 
        }
    }
?>
<!---->
    <?php
    if ($action == 'bitacora') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "bitacora";
        $campos = "b.*,av.nombre as agente,p.nombreCompleto as prospecto";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getBitacora($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaBitacora tableColor">
                  <thead class="headColor">
                   <tr>
                      <th style="border:none">#</th>
                      <th style="border:none">Acción</th>
                      <th style="border:none">Fecha</th>
                      <th style="border:none">Agente</th>
                      <th style="border:none">Prospecto</th>

                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {
      
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= '<strong>'.$row["accion"].'</strong>' ?></td>
                    <td><?= $row["fecha"] ?></td>
                    <td><?= $row["agente"] ?></td>
                    <td><?= $row["prospecto"] ?></td>
                    
                    
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateBitacora();

                ?>
            </div>
            <?php 
        }
    }
?>
<!---->
    <?php
    if ($action == 'seguimientos') {
        $database = new data();
        $query = strip_tags($_REQUEST['query']);
        $idAgente = strip_tags($_REQUEST['idAgente']);
        $fechaInicial = strip_tags($_REQUEST['fechaInicial']);
        $fechaFinal = strip_tags($_REQUEST['fechaFinal']);
        $accion = strip_tags($_REQUEST['accion']);
        $per_page = intval($_REQUEST['per_page']);
        $tabla = "seguimientos";
        $campos = "s.*,av.nombre as agente,p.nombreCompleto as prospecto,asg.accion";
        $page = (isset($_REQUEST["page"]) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $adjacents = 4;
        $offset = ($page - 1) * $per_page;

        $search = array("query" => $query, "idAgente" => $idAgente,"fechaInicial" => $fechaInicial,"fechaFinal" => $fechaFinal,"accion" => $accion, "per_page" => $per_page, "offset" => $offset);

        $datos = $database->getSeguimientos($tabla, $campos, $search);

        $countAll = $database->getCounter();
        $row = $countAll;

        if ($row > 0) {
            $numrows = $countAll;;
        } else {
            $numrows = 0;
        }
        $total_pages = ceil($numrows / $per_page);


    //Recorrer los datos recuperados

        if ($numrows > 0) {
            ?>
            <div class="table-responsive">

                <table class="table  table-hover  table-striped dt-responsive tablaSeguimientos tableColor">
                  <thead class="headColor">
                   <tr>
                       <th style="border:none">#</th>
                       <th style="border:none">Titulo</th>
                       <th style="border:none">Fecha</th>
                       <th style="border:none">Agente</th>
                       <th style="border:none">Prospecto</th>
                       <th style="border:none">Acción</th>

                 </tr>
             </thead>
             <tbody>
                <?php
                $finales = 0;
                foreach ($datos as $key => $row) {
      
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= '<strong>'.$row["titulo"].'</strong>' ?></td>
                    <td><?= $row["fecha"] ?></td>
                    <td><?= $row["agente"] ?></td>
                    <td><?= $row["prospecto"] ?></td>
                    <td><?= $row["accion"] ?></td>
                    
                    
                </tr>
                <?php
                $finales++;
            }
            ?>

        </tbody>
    </table>

    <div class="clearfix">
        <?php
        $inicios = $offset + 1;
        $finales += $inicios - 1;
        echo '<div class="hint-text">Mostrando ' . $inicios . ' al ' . $finales . ' de ' . $numrows . ' registros</div>';


                include '../classes/pagination.php'; //include pagination class
                $pagination = new Pagination($page, $total_pages, $adjacents);
                echo $pagination->paginateSeguimientos();

                ?>
            </div>
            <?php 
        }
    }
?>