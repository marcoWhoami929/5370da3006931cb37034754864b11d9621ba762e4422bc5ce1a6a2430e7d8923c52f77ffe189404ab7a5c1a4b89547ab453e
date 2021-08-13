
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
                    <h4 class="page-title">Historial</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Historial</li>
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
                                                <select class="form-control" id="idAgente" onchange="cargarSeguimientos(1);">

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
                                                <label class="">Accion</label>
                                                <select class="form-control" id="accion" onchange="cargarSeguimientos(1);">

                                                   <option value="">Todas las acciones</option>
                                                   <?php
                                                      error_reporting(E_ALL);
                                                      require_once("controladores/crm.php");
                                                      require_once("modelos/crm.php");

                                                      $mostrarAccionesSeguimientos = ControladorGeneral::ctrMostrarAccionesSeguimientos();

                                                      foreach ($mostrarAccionesSeguimientos as $key => $value) {
                                                       echo "<option value=".$value["id"].">".$value["accion"]."</option>";
                                                     }

                                                     ?>

                                               </select>
                                           </div>
                                           <div class="col-lg-2 col-md-2  col-sm-2">
                                            <label class="">Fecha Inicial</label>
                                            <input type="date" class="form-control" id="fechaInicial">

                                        </div>
                                        <div class="col-lg-2 col-md-2  col-sm-2">
                                            <label class="">Fecha Final</label>
                                            <input type="date" class="form-control" id="fechaFinal">

                                        </div>

                                        <div class="col-lg-2 col-md-2  col-sm-2">
                                            <label class="">Mostrar</label>
                                            <select class="form-control" id="per_page" onchange="cargarSeguimientos(1);">
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
                                                    <button type="button" class="btn btn-danger btn-rounded btn-icon" onclick="cargarSeguimientos(1);">
                                                        <i class="ti-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-md-2">
                                            <button type="button" class="btn btn-danger  btn-icon" id="btnDescargarReporteCartera" onclick="descargarReporteSeguimientos();"><i class="fas fa-file-excel" aria-hidden="true"></i></button>
                                        </div>
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="card-title mb-0"></p>
                                                    <div class="datosSeguimientos">

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
      

        </div> 
    </div>
</div>
