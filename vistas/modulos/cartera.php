
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

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2  col-sm-2">
                                        <label class="">Agente</label>
                                        <select class="form-control" id="idAgente" onchange="cargarCartera(1);">

                                           <option value="">Todos los Agentes</option>
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
                                   <div class="col-lg-2 col-md-2  col-sm-2">
                                    <label class="">Clasificacion</label>
                                    <select class="form-control" id="clasificacion" onchange="cargarCartera(1);">

                                       <option value="">Todo</option>
                                       <option value="1">Conversion Swam</option>
                                       <option value="2">Clientes Corporativos</option>
                                       <option value="3">Clientes Tiendas</option>
                                       <option value="4">Clientes Distribucion</option>

                                   </select>
                               </div>
                               <div class="col-lg-2 col-md-2  col-sm-2">
                                <label class="">Fase</label>
                                <select class="form-control" id="fase" onchange="cargarCartera(1);">

                                   <option value="">Todos</option>
                                   <option value="1">Prospecto</option>
                                   <option value="2">Oportunidad</option>
                                   <option value="3">Cliente</option>


                               </select>
                           </div>
                           <div class="col-lg-2 col-md-2  col-sm-2">
                            <label class="">Tipo cliente</label>
                            <select class="form-control" id="tipo" onchange="cargarCartera(1);">

                               <option value="">Todos</option>
                               <option value="1">Prospecto (Mayor 80%)</option>
                               <option value="2">Cliente Nuevo</option>
                               <option value="3">Cliente Mantenimiento</option>
                               <option value="4">Recuperacion</option>
                               <option value="5">Conversion SWAM</option>


                           </select>
                       </div>
                       <div class="col-lg-2 col-md-2  col-sm-2">
                        <label class="">Mostrar</label>
                        <select class="form-control" id="per_page" onchange="cargarCartera(1);">
                            <option>5</option>
                            <option>10</option>
                            <option selected="">15</option>
                            <option>20</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4  col-sm-4">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <label class="">Buscar por Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button type="button" class="btn btn-danger btn-rounded btn-icon" onclick="cargarCartera(1);">
                                    <i class="ti-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-danger  btn-icon" id="btnDescargarReporteCartera" onclick="descargarReporteCartera();"><i class="fas fa-file-excel" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title mb-0"></p>
                                <div class="datosCartera">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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
