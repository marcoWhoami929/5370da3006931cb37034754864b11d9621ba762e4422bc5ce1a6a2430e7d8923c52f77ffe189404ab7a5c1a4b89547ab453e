
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
                    <h4 class="page-title">Ventas Por periodo</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ventas</li>
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
                                                <select class="form-control" id="idAgente" onchange="cargarVentasPeriodo(1);">

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
                                            <label class="">Fecha Inicial</label>
                                            <input type="date" class="form-control" id="fechaInicial">
                                           
                                          </div>
                                          <div class="col-lg-2 col-md-2  col-sm-2">
                                            <label class="">Fecha Final</label>
                                            <input type="date" class="form-control" id="fechaFinal">
                                           
                                          </div>
                                        
                                     <div class="col-lg-2 col-md-2  col-sm-2">
                                        <label class="">Mostrar</label>
                                        <select class="form-control" id="per_page" onchange="cargarVentasPeriodo(1);">
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
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon" onclick="cargarVentasPeriodo(1);">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2">
                                        <button type="button" class="btn btn-danger  btn-icon" id="btnDescargarReporteCartera" onclick="descargarReporteVentasPeriodo();"><i class="fas fa-file-excel" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-title mb-0"></p>
                                                <div class="datosVentasPeriodo">

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

         
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">

                    <table class="table table-bordered table-striped dt-responsive tableColor" width="100%">

                        <thead class="headColor">

                           <tr>
                             <th style="border:none">Total</th>
                             <th style="border:none">Promedio Cierre</th>

                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                        error_reporting(E_ALL);
                                        $montoTotal = ControladorGeneral::ctrMostrarVentasTotales();
                                        $acumuladoTotal = 0;
                                        $acumuladoDias = 0;

                                        for($i = 0;$i < count($montoTotal);$i++){

                                            $acumuladoTotal += $montoTotal[$i]["montoTotal"];
                                            $acumuladoDias += $montoTotal[$i]["dias"];

                                        }
                                        $diasTranscurridos = $acumuladoDias / count($montoTotal);

                                        echo "$ ".number_format($acumuladoTotal,2);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $diasTranscurridos." días";
                                    ?>

                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
 <div class="modal fade" id="visualizarProductos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header headColor" style="color: white">
                <h3 class="modal-title" id="exampleModalLabel">Desglose Productos</h3>

                <button type="button" class="close btnCerrarVista" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-lg-12 col-md-12 col-sm-12">

                        <small>Nota: A continuación se detallan los productos cotizados en la oportunidad de venta.</small>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-4 col-sm-4">
                             <h4>Monto Total</h4>
                             <span id="montoTotalOportunidad"></span>
                          </div>

                        </div>


                        <br>
                        <br>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                           <div id="listaProductos" name="listaProductos">

                              <div class="table-responsive">
                                  <table class="table" id="tablaDetalleProductos">
                                    <caption></caption>
                                  </table>
                                </div>

                           </div>
                        </div>
                    </div>

                </div>
              </div>
              <br>
              <div class="modal-footer">

                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="btn btn-success btnCerrarVista" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>

              </div>
            </div>
          </div>
        </div>
