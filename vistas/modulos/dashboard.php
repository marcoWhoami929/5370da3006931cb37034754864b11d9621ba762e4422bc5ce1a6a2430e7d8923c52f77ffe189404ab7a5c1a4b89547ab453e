<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

     $url =  'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

                $parametros = parse_url($url);


                if (isset($parametros['query'])) {
                     parse_str($parametros['query'], $parametro);
                     $idAgente = $parametro['agente'];
                     $canal = $parametro['canal'];
                     $inicial = $parametro['inicial'];
                     $final = $parametro['final'];
                     if ($idAgente == 0) {
                         $agente = null;
                         $valor = 0;
                  
                     }else{
                         $agente =  $idAgente;
                         $valor = $idAgente;
                     
                     }

                     if ($canal == 0) {

                         $valorCanal = 0;


                     }else{

                         $valorCanal = $canal;

                     }

                }else{
                     $valor = 0;
                     $agente = null;
                     $valorCanal = 0;
                     $inicial = "2020-07-24";
                     $date = date('Y-m-d');
                     $final = $date;

              


                }

?>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper">

    <div class="page-wrapper">

       <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Tablero</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tablero</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Panel de control</h4>

                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-sm-12">


                              <input type="hidden" id="agenteSeleccionado" value="<?php echo $valor ?>">
                              <input type="hidden" id="canalSeleccionado" value="<?php echo $valorCanal ?>">
                              
                              <form action="dashboard" method="GET" >
                                <div class="col-lg-12">
                                  <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                      <span>Agente</span>
                                       <select class="form-control" id="agente" name="agente" onchange="this.form.submit()">

                                          <option value="0">Todos los Agentes</option>
                                          <option value="1">Rocio Martinez Morales</option>
                                          <option value="2">Orlando Raúl Briones Aguirre</option>
                                          <option value="5">San Manuel</option>
                                          <option value="6">Reforma</option>
                                          <option value="7">Capu</option>
                                          <option value="8">Santiago</option>
                                          <option value="9">Las Torres</option>
                                          <option value="11">Ivan Herrera</option>
                                          <option value="12">Jesús García</option>
					  					  <option value="13">Mario Hernández</option>
					  					  <option value="17">Marcela Vega</option>

                                      </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <span>Canal</span>
                                      <select class="form-control" id="canal" name="canal" onchange="this.form.submit()">
                                         <option value="0">Todos</option>
                                         <option value="1">Conversion SWAM</option>
                                         <option value="2">Clientes Corporativos</option>
                                         <option value="3">Clientes Tiendas</option>
                                         <option value="4">Clientes Distribucion</option>


                                     </select>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-3">
                                        <span>Inicio</span>
                                       <input class="form-control" type="date" id="inicial" name="inicial"  >
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-3">
                                      <span>Final</span>
                                      <input class="form-control" type="date" id="final" name="final" >
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-2">
                                     <button class=" form-control btn btn-success" type="button" onclick="this.form.submit();setValue();">Buscar</button>
                                 </div>
                                  </div>
                                </div>

                              </form>

                          </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pillTablero" role="tabpanel">

                    <div class="container-fluid">
                        <div class="row" id="contenedorGeneralSemaforos">

                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-cyan text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="fas fa-user-plus"></i></h1>
                                            <h6 class="text-white">Prospectos</h6>
                                            <h5 class="text-white">
                                                <?php

                                                    $table = "prospectos";
                                                    $campos = "COUNT(id)";

                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                          
                                                           $parametros = "WHERE oportunidad = 0 and cliente = 0 and clasificacion IN (1,2,4,3) and descartado = 0 and habilitado = 1 ";
                                                         
                                                        }else{

                                                          $parametros = "WHERE oportunidad = 0 and cliente = 0 and clasificacion = ".$canal." and descartado = 0 and habilitado = 1 ";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {

                                                          $parametros = "WHERE oportunidad = 0 and cliente = 0 and clasificacion IN (1,2,4,3) and descartado = 0 and habilitado = 1 and idAgente = ".$idAgente."";
                                                         
                                                        }else{

                                                          $parametros = "WHERE oportunidad = 0 and cliente = 0 and clasificacion = ".$canal." and descartado = 0 and habilitado = 1 and idAgente = ".$idAgente."";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>

                                                 </h5>
                                        </a>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-info text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="fas fa-user-clock"></i></h1>
                                            <h6 class="text-white">Oportunidades</h6>
                                            <h5 class="text-white">
                                                <?php


                                                    $table = "prospectos";
                                                    $campos = "COUNT(p.id)";
                                                  
                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                          
                                                           $parametros = "as p INNER JOIN oportunidades as o ON o.idProspecto = p.id WHERE p.oportunidad = 1  and p.cliente = 0 and descartado = 0  and p.habilitado = 1 and p.clasificacion in (1,2,4,3) and ventaCerrada = 0";
                                                         
                                                        }else{


                                                            $parametros = "as p INNER JOIN oportunidades as o ON o.idProspecto = p.id WHERE p.oportunidad = 1 and p.clasificacion = ".$canal." and p.cliente = 0 and descartado = 0  and p.habilitado = 1  and ventaCerrada = 0";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {

                                                           $parametros = "as p INNER JOIN oportunidades as o ON o.idProspecto = p.id WHERE p.oportunidad = 1 and p.clasificacion in (1,2,4,3) and p.cliente = 0 and descartado = 0  and p.habilitado = 1 and p.idAgente = ".$idAgente."  and ventaCerrada = 0";
                                                         
                                                        }else{

                                                          $parametros = "as p INNER JOIN oportunidades as o ON o.idProspecto = p.id WHERE p.oportunidad = 1 and p.clasificacion = ".$canal." and p.cliente = 0 and descartado = 0  and p.habilitado = 1 and p.idAgente = ".$idAgente."  and ventaCerrada = 0";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-success text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="fas fa-user-check"></i></h1>
                                            <h6 class="text-white">Clientes</h6>
                                            <h5 class="text-white">
                                                  <?php


                                                    $table = "prospectos";
                                                    $campos = "COUNT(id)";


                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                            $parametros = "WHERE cliente = 1 and descartado != 1 and clasificacion in (1,2,4,3)";
                                                   
                                                         
                                                        }else{

                                                            $parametros = "WHERE cliente = 1 and descartado != 1 and clasificacion = ".$canal." ";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {

                                                            $parametros = "WHERE cliente = 1 and descartado != 1 and clasificacion in (1,2,4,3) and idAgente = ".$idAgente."";
                                                         
                                                        }else{

                                                             $parametros = "WHERE cliente = 1 and descartado != 1 and clasificacion = ".$canal." and idAgente = ".$idAgente."";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-warning text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                                            <h6 class="text-white">Directorio</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "prospectos";
                                                    $campos = "COUNT(id)";
                                                    if ($idAgente == 0) {

                                                        $parametros = "WHERE celular != ''";
                                                    }else{
                                                        $parametros = "WHERE celular != '' and idAgente = ".$idAgente."";


                                                    }


                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                            $parametros = "WHERE celular != '' and clasificacion in (1,2,4)";
                                                          
                                                         
                                                        }else{

                                                            $parametros = "WHERE celular != '' and  clasificacion = ".$canal."";
                                                         
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {

                                                            $parametros = "WHERE celular != '' and clasificacion in (1,2,4) and idAgente = ".$idAgente."";
                                                         
                                                        }else{

                                                            $parametros = "WHERE celular != '' and  clasificacion = ".$canal." and idAgente = ".$idAgente."";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-secondary text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="far fa-chart-bar"></i></h1>
                                            <h6 class="text-white">Oportunidades de Venta</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "oportunidades";
                                                    $campos = "count(o.id)";
                                                   
                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {


                                                           $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4,3) and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                            $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {


                                                           $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4,3)  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{

                                                            $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-secondary text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="far fa-chart-bar"></i></h1>
                                            <h6 class="text-white">Oportunidades de Venta</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "oportunidades";
                                                    $campos = "SUM(o.monto)";
                                                 

                                                    if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {


                                                           $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4,3) and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                            $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {


                                                           $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4,3)  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{

                                                            $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo "$".number_format($indicadores["total"],2);

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-danger text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="far fa-chart-bar"></i></h1>
                                            <h6 class="text-white">Ventas</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "ventas";
                                                    $campos = "COUNT(v.id)";


                                                     if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                      
                                                           $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion  in (1,2,4) and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                             $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {


                                                           $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion in (1,2,4) and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                          $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-danger text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="far fa-chart-bar"></i></h1>
                                            <h6 class="text-white">Ventas</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "ventas";
                                                    $campos = "SUM(v.montoTotal)";


                                                     if ($idAgente == 0) {
                                                      if ($valorCanal == 0) {

                                                      
                                                           $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion  in (1,2,4,3) and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                             $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                      }
                                                    }else{
                                                        if ($valorCanal == 0) {


                                                           $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion in (1,2,4,3) and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                                                         
                                                        }else{


                                                          $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

                                                        }
                                                        
                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo "$".number_format($indicadores["total"],2);

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-primary text-center">
                                        <a href="#">
                                            <h1 class="font-light text-white"><i class="fas fa-paste"></i></h1>
                                            <h6 class="text-white">Descartados</h6>
                                            <h5 class="text-white">
                                                 <?php


                                                    $table = "prospectos";
                                                    $campos = "COUNT(id)";
                                                    if ($idAgente == 0) {

                                                        $parametros = "WHERE descartado = 1";
                                                    }else{
                                                        $parametros = "WHERE descartado = 1 and idAgente = ".$idAgente."";


                                                    }

                                                    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                                                    echo $indicadores["total"];

                                                 ?>
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">

                <!--<div class='col-lg-6 col-md-6 col-sm-6'>-->
                <?php
                /*

                  if ($canal == 2  and $agente == 5 || $agente == 6 || $agente == 7 || $agente == 8 || $agente == 9 ) {
                     
                      include('vistas/modulos/graficos/graficoFunnelCorp.php');

                  }else if ($canal == 1 and $agente == 2 || $agente == 3 || $agente == 11 || $agente == 12 ) {
                     
                     include('vistas/modulos/graficos/graficoFunnelProsp.php');

                  }else if ($canal == 4 and $agente == 2 || $agente == 3) {
                     
                     include('vistas/modulos/graficos/graficoFunnelDist.php');

                  }else if($canal == 0 and $agente == 0){

                     include('vistas/modulos/graficos/graficoFunnelTodos.php');

                  }else if($canal == 1 and $agente == 0){

                    include('vistas/modulos/graficos/graficoFunnelProsp.php');

                  }else if($canal == 2 and $agente == 0){

                    include('vistas/modulos/graficos/graficoFunnelCorp.php');

                  }else if($canal == 4 and $agente == 0){

                    include('vistas/modulos/graficos/graficoFunnelDist.php');

                  }
                  */

                ?>
                <!--</div>-->
                
                <?php

                  if ($canal == 2  and $agente == 5 || $agente == 6 || $agente == 7 || $agente == 8 || $agente == 9 ) {
                     
                      include('vistas/modulos/graficos/graficoVentasAgentesCorporativos.php');
                      include('vistas/modulos/graficos/graficoVentasPorAgente.php');

                  }else if ($canal == 1 and $agente == 2 || $agente == 3 || $agente == 11 || $agente == 12 ) {
                     
                     include('vistas/modulos/graficos/graficoVentasAgentesConversion.php');
                     include('vistas/modulos/graficos/graficoVentasPorAgente.php');

                  }else if ($canal == 4 and $agente == 2 || $agente == 3) {
                     
                     include('vistas/modulos/graficos/graficoVentasAgentesDistribucion.php');
                     include('vistas/modulos/graficos/graficoVentasPorAgente.php');

                  }else if($canal == 0 and $agente == 0){

                     include('vistas/modulos/graficos/graficoVentasAgentesTodos.php');

                     include('vistas/modulos/graficos/graficoVentasGenerales.php');

                  }else if($canal == 1 and $agente == 0){

                    include('vistas/modulos/graficos/graficoVentasAgentesConversion.php');

                  }else if($canal == 2 and $agente == 0){

                    include('vistas/modulos/graficos/graficoVentasAgentesCorporativos.php');

                  }else if($canal == 4 and $agente == 0){

                    include('vistas/modulos/graficos/graficoVentasAgentesDistribucion.php');

                  }else if ($agente == 2 || $agente == 3 || $agente == 5 || $agente == 6 || $agente == 7 || $agente == 8 || $agente == 9 || $agente == 11 || $agente == 12 and $canal == 0) {

                      include('vistas/modulos/graficos/graficoVentasGenerales.php');
                    
                  }

                ?>
             
             
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php include("vistas/modulos/graficos/graficoCotizacionsVsVentas.php") ?>
                </div>


            </div>

        </div>
    </div>
</div>
<script>


    var agenteElegido =  $("#agenteSeleccionado").val();
    document.ready = document.getElementById("agente").value = agenteElegido;
    localStorage.setItem("agente",agenteElegido);

    var canalElegido =  $("#canalSeleccionado").val();
    document.ready = document.getElementById("canal").value = canalElegido;
    localStorage.setItem("canal",canalElegido);

  
  

</script>
