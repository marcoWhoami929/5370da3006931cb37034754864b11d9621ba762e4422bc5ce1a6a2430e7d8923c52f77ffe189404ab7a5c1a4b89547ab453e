<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

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
                                                    $parametros = "WHERE oportunidad = 0 and cliente = 0 and descartado = 0";
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
                                                    

                                                    $table = "oportunidades";
                                                    $campos = "COUNT(prosp.id)";
                                                    $parametros = "as opor INNER JOIN prospectos as prosp ON opor.idProspecto = prosp.id WHERE prosp.descartado = 0 and prosp.cliente != 1  and prosp.oportunidadesCreadas != 0 and opor.ventaCerrada = 0";
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
                                                    $parametros = "WHERE cliente = 1 and descartado != 1";
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
                                                    $parametros = "WHERE celular != ''";
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
                                            <h6 class="text-white">Ventas</h6>
                                            <h5 class="text-white">
                                                 <?php 
                                                    

                                                    $table = "ventas";
                                                    $campos = "SUM(montoTotal)";
                                                    $parametros = "";
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
                                                    $parametros = "WHERE descartado = 1";
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

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php include("vistas/modulos/graficos/graficoFunel3D.php") ?>
                </div>

            </div>

        </div> 
    </div>
</div>
