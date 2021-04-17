<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

     $url =  'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

                $parametros = parse_url($url);


                if (isset($parametros['query'])) {
                     parse_str($parametros['query'], $parametro);
                     $idAgente = $parametro['agente'];
                     $nombreAgenteElegido = $parametro['nameAgente'];

                     if ($idAgente == 0) {
                         $agente = null;
                         $valor = 0;
                     }else{
                         $agente =  $idAgente;
                         $valor = $idAgente;
                     }

                }else{
                     $valor = 0;
                     $agente = null;

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
                    <h4 class="page-title">Cartera</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cartera</li>
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
                                    <h4 class="card-title">Cartera General</h4>
                                    <h5 class="card-subtitle"></h5>
                                     <input type="hidden" id="agenteElegido" value="<?php echo $valor ?>">
                                        <input type="hidden" id="nameAgente" >
                                        <form action="cartera" method="GET">
                                          <!--<div class="col-md-3" style="float: left;">
                                            <?php
                                              /*if (isset($_POST["fechaIni"])) {
                                                echo '<input type="date" id="fechaIni" name="fechaIni" class="form-control" placeholder="Fecha" value="'.date('Y-m-d', strtotime($_POST["fechaIni"])).'" required>';

                                                echo '<input type="date" id="fechaFin" name="fechaFin" class="form-control" placeholder="Fecha" value="'.date('Y-m-d', strtotime($_POST["fechaFin"])).'" required>';
                                                           
                                              }else {

                                               echo '<input type="date" id="fechaIni" name="fechaIni" class="form-control" placeholder="Fecha" required>';

                                                echo '<input type="date" id="fechaFin" name="fechaFin" class="form-control" placeholder="Fecha" required>';

                                            }*/

                                            ?>

                                          </div>-->
                                              <div class="col-lg-8 col-md-8 col-sm-8">
                                                <span>Agente</span>
                                                <select class="form-control" id="agente" name="agente" onchange="this.form.submit()">

                                                      <option value="0">Todos los Agentes</option>
                                                      <option value="1">Rocio Martinez Morales</option>
                                                      <option value="2">Orlando Raúl Briones Aguirre</option>
                                                      <option value="3">Gerónimo Bautista Escudero</option>
                                                      <option value="4">Jonathan González Sánchez</option>
                                                      <option value="5">San Manuel</option>
                                                      <option value="6">Reforma</option>
                                                      <option value="7">Capu</option>
                                                      <option value="8">Santiago</option>
                                                      <option value="9">Las Torres</option>
                                                      <option value="11">Ivan Herrera</option>
                                                      <option value="12">Jesús García</option>
                                                      <option value="13">Mario Hernández</option>
                                                </select>
                                            </div>
                                        </form>

                                        <?php
                                          if (isset($_POST["agenteElegido"])) {
                                            echo '<a href="vistas/modulos/reportes.php?cartera=prospectos&agenteElegido='.$valor.'">

                                           <button type="button" class="btn btn-success">
                                        <i class="fas fa-file-excel fa-2x"></i></button>

                                          </a>';
                                          }else{
                                            echo '<a href="vistas/modulos/reportes.php?cartera=prospectos&agenteElegido='.$valor.'">

                                               <button type="button" class="btn btn-success">
                                        <i class="fas fa-file-excel fa-2x"></i></button>

                                              </a>';
                                          } ?>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">

                    <table class="table table-bordered table-striped tablaCartera tableColor" width="100%" id="cartera">

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

                    </table>
                </div>

            </div>
            <!--=====================================
            MODAL VISTA GRAFICO
            ======================================-->
            <div id="modalVentasProspectos" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form role="form" method="post" enctype="multipart/form-data">
                        <!-- CABEZA DEL MODAL-->
                            <div class="modal-header" style="background:#1F262D; color:white">

                                <h4 class="modal-title">Ventas</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <!--CUERPO DEL MODAL-->
                            <div class="modal-body">
                                <div class="box-body">

                                    <figure class="highcharts-figure">
                                        <div id="ventasProspectos"></div>
                                    </figure>


                                </div>
                            </div>
                            <!-- PIE DEL MODAL-->
                            <div class="modal-footer">

                                <button type="button" class="btn btn-dark pull-left" data-dismiss="modal">Salir</button>


                            </div>



                        </form>
                    </div>
                </div>
            </div>
            <!-- FIN DE MODAL -->


        </div>
    </div>
</div>
<script>


    var agenteElegido =  $("#agenteElegido").val();
    document.ready = document.getElementById("agente").value = agenteElegido;

    var nameAgente = $('#agente option:selected').attr('nombreAgente');
    document.ready = document.getElementById("nameAgente").value = nameAgente;

</script>
<style type="text/css" media="screen">
#ventasProspectos {
    height: 400px;
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


</style>
