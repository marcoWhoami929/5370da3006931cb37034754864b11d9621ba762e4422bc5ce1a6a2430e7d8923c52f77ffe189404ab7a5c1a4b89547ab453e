
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
                                <div>
                                    <h4 class="card-title">Ventas Por periodo</h4>
                                    <h5 class="card-subtitle"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">

                    <table class="table table-bordered table-striped dt-responsive tablaVentas tableColor" width="100%" id="ventas">

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

                    </table>
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
