<?php
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRM</title>

  <link rel="icon" href="vistas/assets/images/icono.png">

   <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!--=====================================
  PLUGINS DE CSS
  ======================================-->
 
  <!-- Custom CSS -->

  <link href="vistas/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
  <link href="vistas/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
  <link href="vistas/dist/css/style.min.css" rel="stylesheet">
  <link href="vistas/dist/css/plantilla.css" rel="stylesheet">
  <link href="vistas/dist/css/all.min.css" rel="stylesheet">  
  <link href="vistas/assets/libs/flot/css/float-chart.css" rel="stylesheet">
  <link href="vistas/dist/css/formeter.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="vistas/dist/css/generales.css">
  <link href="vistas/dist/css/bootstrap-tagsinput.css" rel="stylesheet">

 
  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
    <script src="vistas/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="vistas/dist/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="vistas/dist/js/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="vistas/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="vistas/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vistas/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="vistas/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="vistas/dist/js/waves.js"></script>
    <script src="vistas/dist/js/sidebarmenu.js"></script>
    <script src="vistas/dist/js/custom.min.js"></script>
    <script src="vistas/assets/libs/flot/excanvas.js"></script>
    <script src="vistas/assets/libs/flot/jquery.flot.js"></script>
    <script src="vistas/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="vistas/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="vistas/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="vistas/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="vistas/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="vistas/dist/js/pages/chart/chart-page-init.js"></script>
    <!-- SweetAlert 2 https://sweetalert2.github.io/-->
    <script src="vistas/assets/libs/sweetalert2/sweetalert2.all.js"></script>

    <!----HIGHCHARTS------------------------>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script>
    <script src="https://code.highcharts.com/modules/funnel3d.js"></script>

    <script src="vistas/dist/js/all.min.js"></script>
    <script src="vistas/dist/js/formeter.js"></script>
     <script src="vistas/dist/js/bootstrap-tagsinput.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/df-number-format/2.1.6/jquery.number.js"></script>
  

    
		
</head>

<body>
  <div id="main-wrapper">
 
<?php

 if(isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok"){


    /*=============================================
     CABEZOTE
     =============================================*/
      include "modulos/cabezote.php";
  

    /*=============================================
     LATERAL
     =============================================*/

     include "modulos/lateral.php";

     /*=============================================
     CONTENIDO
     =============================================*/

     if(isset($_GET["ruta"])){

          $carpeta = "vistas/modulos/";
          $class = $carpeta . $_GET["ruta"]. '.php';


          if (!file_exists($class)) {
              include "modulos/404.php";
          }else{

            include "modulos/".$_GET["ruta"].".php";
            

          }   

     }else{

       include "modulos/dashboard.php";

     }

     /*=============================================
     FOOTER
     =============================================*/
     echo '<footer class="main-footer" style="width: auto;">';

     include "modulos/footer.php";


    echo '
    </footer>
    </div>';

 }else{

  include "modulos/login.php";

 }
 
?>


<!--=====================================
JS PERSONALIZADO
======================================-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <script src="vistas/dist/js/plantilla.js"></script>
  <script src="vistas/js/gestorCrm.js"></script>
   <!-- FULL CALENDAR-->
  <script src="vistas/assets/libs/moment/min/moment.min.js"></script>
  <script src="vistas/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="vistas/dist/js/pages/calendar/cal-init.js"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_dlGznsov-uJDQUmmsHIR_vsA103iiLc"></script>

  </div>
</body>
</html>