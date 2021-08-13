
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
        <h4 class="page-title">TimeLine</h4>
        <div class="ml-auto text-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">TimeLine</li>
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
                <h4 class="card-title">TimeLine</h4>
                <h5 class="card-subtitle">A continuación se detalle todos los seguimientos realizados a cada uno de los prospectos.</h5>
                <select class="js-example-basic-multiple" id="buscarTimeline">
                  <option value="">Elegir Prospecto</option>
                  <?php
                  error_reporting(E_ALL);
                  require_once("controladores/crm.php");
                  require_once("modelos/crm.php");

                  $mostrarProspectosSeguimientos = ControladorGeneral::ctrMostrarProspectosConSeguimientos();

                  foreach ($mostrarProspectosSeguimientos as $key => $value) {
                   echo "<option value=".$value["id"].">".$value["nombreCompleto"]."</option>";
                 }

                 ?>
                </select>
               
               <a id="vinculoDescargarReporte"><button type="button" class="btn btn-success" style="display: none" id="btnDescargarReporteTimeLline">
                                        <i class="fas fa-file-excel fa-2x"></i></button></a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <section id="conference-timeline">
        <div class="timeline-start"><h4>Inicio</h4></div>
        <div class="conference-center-line"></div>
        <div class="conference-timeline-content">
            <div class="timelineSection" id="timelineSection">
                      
            </div>

        </div>
        <div class="timeline-end"></div>
      </section>


    </div>

  </div> 
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>