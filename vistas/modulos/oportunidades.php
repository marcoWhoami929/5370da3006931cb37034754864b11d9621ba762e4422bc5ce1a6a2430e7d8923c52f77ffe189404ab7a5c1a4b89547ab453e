
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
                    <h4 class="page-title">Oportunidades</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Oportunidades</li>
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
                                    <h4 class="card-title">Oportunidades</h4>
                                    <h5 class="card-subtitle"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">
                         <table class="table table-bordered table-striped tablaOportunidades tableColor"id="oportunidades" width="100%">

                            <thead class="headColor">

                               <tr>
                                 <th style="border:none">#</th>
                                 <th style="border:none">Nombre<br>/Taller</th>
                                 <th style="border:none">Correo<br>/Telefono</th>
                                 <th style="border:none">Concepto</th>
                                 <th style="border:none">Fase<br>/Origen</th>
                                 <th style="border:none">Monto</th>
                                 <th style="border:none">Comision</th>
                                 <th style="border:none">Certeza</th>
                                 <th style="border:none">Cierre Estimado</th>
                                 <th style="border:none">Ultimo Contacto</th>
                                 <th style="border:none">Productos</th>
                                 <th style="border:none">Ejecutivo</th>

                                </tr> 

                            </thead>

                    </table>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                         <table class="table table-bordered table-striped dt-responsive tableColor"  width="50%">

                            <thead class="headColor">

                               <tr>
                                 <th style="border:none">Clasificacion</th>
                                 <th style="border:none">Monto</th>
                                 <th style="border:none">cantidad</th>
                                 <th style="border:none">Certeza</th>

                                </tr> 

                            </thead>
                            <tbody>
                                <tr>
                                    <td>BAJA</td>
                                    <td>
                                        <?php
                                            require_once("controladores/crm.php");
                                            require_once("modelos/crm.php");

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.monto) IS NULL,0,SUM(o.monto)) as total";
                                            $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";

                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "$ ".number_format($totalCerteza["total"],2);
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";

                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo $totalCerteza["total"];
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "<button type='button' class='btn btn-danger btn-sm'></button>".number_format($totalCerteza["total"],0)."% ";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>MEDIA</td>
                                    <td>
                                          <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.monto) IS NULL,0,SUM(o.monto)) as total";
                                            $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "$ ".number_format($totalCerteza["total"],2);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
                                            $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo $totalCerteza["total"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
                                            $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "<button type='button' class='btn btn-warning btn-sm'></button>".number_format($totalCerteza["total"],0)."% ";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ALTA</td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.monto) IS NULL,0,SUM(o.monto)) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";

                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "$ ".number_format($totalCerteza["total"],2);
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo $totalCerteza["total"];
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "<button type='button' class='btn btn-success btn-sm'></button>".number_format($totalCerteza["total"],0)."%";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>TOTALES</strong></td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.monto) IS NULL,0,SUM(o.monto)) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            echo "<strong>$ ".number_format($totalCerteza["total"],2)."</strong>";
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";
                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                             echo "<strong>".$totalCerteza["total"]."</strong>";
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                          

                                            $table = "oportunidades";
                                            $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
                                            $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0 and p.cliente != 1 and p.oportunidadesCreadas != 0 and o.ventaCerrada = 0";                                           
                                            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
                                            if ($totalCerteza["total"] < 40) {
                                                $porcentaje = "<button type='button' class='btn btn-danger btn-sm'></button>";
                                            }else if($totalCerteza["total"] >= 40 and $totalCerteza["total"] < 70){
                                                 $porcentaje = "<button type='button' class='btn btn-warning btn-sm'></button>";
                                            }else if ( $totalCerteza["total"] >= 70) {
                                                $porcentaje = "<button type='button' class='btn btn-success btn-sm'></button>";
                                            }
                                            echo $porcentaje."<strong>".number_format($totalCerteza["total"],0)."%</strong>";
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
