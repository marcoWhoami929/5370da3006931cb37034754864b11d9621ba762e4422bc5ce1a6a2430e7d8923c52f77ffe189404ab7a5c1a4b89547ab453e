
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

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2  col-sm-2">
                                        <label class="">Agente</label>
                                        <select class="form-control" id="idAgente" onchange="cargarOportunidades(1);">

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
                                <select class="form-control" id="per_page" onchange="cargarOportunidades(1);">
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
                                        <button type="button" class="btn btn-danger btn-rounded btn-icon" onclick="cargarOportunidades(1);">
                                            <i class="ti-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <button type="button" class="btn btn-danger  btn-icon" id="btnDescargarReporteCartera" onclick="descargarReporteOportunidades();"><i class="fas fa-file-excel" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title mb-0"></p>
                                        <div class="datosOportunidades">

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
    <div class="col-lg-6 col-md-6 col-sm-6">
       <table class="table table-bordered table-striped dt-responsive tableColor"  width="50%">

        <thead class="headColor">

         <tr>
           <th style="border:none">Clasificacion</th>
           <th style="border:none">Monto</th>
           <th style="border:none">Cantidad</th>
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
            $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0";


            $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
            echo "$ ".number_format($totalCerteza["total"],2);
            ?>
        </td>
        <td>
           <?php


           $table = "oportunidades";
           $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
           $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0";


           $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
           echo $totalCerteza["total"];
           ?>
       </td>
       <td>
           <?php


           $table = "oportunidades";
           $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
           $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 4 and p.descartado = 0";

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
      $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0";

      $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
      echo "$ ".number_format($totalCerteza["total"],2);
      ?>
  </td>
  <td>
    <?php


    $table = "oportunidades";
    $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
    $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0  ";

    $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
    echo $totalCerteza["total"];
    ?>
</td>
<td>
    <?php


    $table = "oportunidades";
    $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
    $parametros =  "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza < 7 and o.idCerteza >= 4 and p.descartado = 0  ";

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
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0  ";


       $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
       echo "$ ".number_format($totalCerteza["total"],2);
       ?>
   </td>
   <td>
       <?php


       $table = "oportunidades";
       $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0  ";

       $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
       echo $totalCerteza["total"];
       ?>
   </td>
   <td>
       <?php


       $table = "oportunidades";
       $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE o.idCerteza >= 7 and p.descartado = 0  ";

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
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0  ";

       $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
       echo "<strong>$ ".number_format($totalCerteza["total"],2)."</strong>";
       ?>
   </td>
   <td>
       <?php


       $table = "oportunidades";
       $campos = "IF(COUNT(o.comision) IS NULL,0,COUNT(o.comision)) as total";
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0  ";

       $totalCerteza = ControladorGeneral::ctrObtenerTotalCertezas($table,$campos,$parametros);
       echo "<strong>".$totalCerteza["total"]."</strong>";
       ?>
   </td>
   <td>
       <?php


       $table = "oportunidades";
       $campos = "IF(SUM(o.idCerteza)/count(o.id) * 10 IS NULL, 0,SUM(o.idCerteza)/count(o.id) * 10 ) as total";
       $parametros = "as o INNER JOIN prospectos AS p ON o.idProspecto = p.id  WHERE p.descartado = 0  ";
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
