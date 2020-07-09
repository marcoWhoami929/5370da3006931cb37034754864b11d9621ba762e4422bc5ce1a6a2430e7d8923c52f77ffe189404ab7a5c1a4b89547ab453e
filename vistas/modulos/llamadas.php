
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
                    <h4 class="page-title">Llamadas </h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Llamadas </li>
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
                                    
                                    <i class='fa fa-flag-checkered fa-2x' style="color: red;"></i><strong>Pendiente Por Cerrar</strong>
                                    <i class='fa fa-flag-checkered fa-2x' style="color: green;"></i><strong>Cerrado</strong>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">

                    <table class="table table-bordered table-striped dt-responsive tablaLlamadas tableColor" width="100%" id="llamadas" >

                        <thead class="headColor">

                            <tr>
                            
                             <th style="border:none">Folio Evento</th>
                             <th style="border:none">Contacto</th>
                             <th style="border:none">Asunto</th>
                             <th style="border:none">Descripción</th>
                             <th style="border:none">Fecha</th>
                             <th style="border:none">Hora</th>
                             <th style="border:none">Estatus</th>
                             <th style="border:none">Detalle</th>
                             <th style="border:none">Agente</th>
                            </tr> 

                        </thead>

                    </table>
                </div>

            </div>

        </div> 
    </div>
</div>
<div class="modal fade" id="informacionLlamadas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header headColor" style="color: white">
                <h3 class="modal-title" id="exampleModalLabel">Detalle de Evento Finalizado</h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                   <label for="title" class="col-sm-2 control-label">Detalle</label>
                   <div class="col-sm-12">
                       <textarea class="form-control" id="detalleFinalizacion" rows="10" cols="50" disabled></textarea>
                   </div>
                          
                </div>
              </div>
              <br>
              <div class="modal-footer">
          
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                      </div>
                  </div>   
                   
              </div>
            </div>
          </div>
        </div>
