   <?php
   error_reporting(E_ALL);
   require_once("controladores/crm.php");
   require_once("modelos/crm.php");
   
   $url =  'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

   $parametros = parse_url($url);
   

   if (isset($parametros['query'])) {
     parse_str($parametros['query'], $parametro);
     $idAgente = $parametro['elegirAgente'];
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
   
   $eventos = ControladorGeneral::ctrMostrarListaEventos($agente);
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
       <h4 class="page-title">Mis Recordatorios</h4>
       <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Tablero</a></li>
          <li class="breadcrumb-item active" aria-current="page">Calendario</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="col-6">
    <input type="hidden" id="valorElegido" value="<?php echo $valor ?>">
    <form action="calendario" method="GET" >
      <select class="form-control" id="elegirAgente" name="elegirAgente" onchange="this.form.submit()">
       
        <option value="0">Todos los Agentes</option>
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
        <option value="14">Gabriel Andrade</option>
        <option value="16">Jose Luis Texis</option>
        <option value="17">Marcela</option>
      </select>
      
    </form>
    
  </div>
</div>
</div>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-12">
   <div class="card">
    <div class="">
     <div class="row">
      <div class="col-lg-3 border-right p-r-0">
       <div class="card-body border-bottom">
        <h4 class="card-title m-t-10">Eventos</h4>
      </div>
      <div class="card-body">
        <div class="row">
         <div class="col-md-12">
          <div id="calendar-events" class="">
           <div class="m-b-20"><button type='button' class='btn btn-primary btn-sm'><i class='fa fa-calendar'></i></button> <strong>Citas</strong></div>
           <br>
           <div class="m-b-20"><button type='button' class='btn btn-success btn-sm'><i class='fa fa-phone-volume'></i></button> <strong>Llamadas</strong></div>
           <br>
           <div class="m-b-20"><button type='button' class='btn btn-danger btn-sm'><i class='fa fa-map-marked-alt'></i></button> <strong>Visitas</strong></div>
           <br>
           <div class="m-b-20"><button type='button' class='btn btn-warning btn-sm'><i class='fa fa-fill-drip'></i></button> <strong>Demostraciones</strong></div>
           <br>
           <div class="m-b-20"> <button type='button' class='btn btn-info btn-sm'><i class='fa fa-stopwatch'></i></button> <strong>Recordatorios</strong></div>

         </div>

       </div>
     </div>
   </div>
 </div>
 <div class="col-lg-9">
   <div class="card-body b-l calender-sidebar">
    <div id="calendar"></div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>


<!--MODALS-->

<!---MODAL DETALLE EVENTO-->
<div class="modal fade" id="ModalDetalleEvento" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header headColor" style="color: white">
        <h3 class="modal-title" id="exampleModalLabel">Detalle Evento</h3>

        <button type="button" class="close btnCerrarVistas" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-12">
            <!--<input type="text" name="asunto" class="form-control" id="asunto" placeholder="Asunto" disabled>-->
            <textarea class="form-control" name="asunto" id="asunto" rows="4" cols="50"></textarea>
          </div>
          <label for="title" class="col-sm-2 control-label">Contacto</label>
          <div class="col-sm-12">
            <input type="text" name="contacto" class="form-control" id="contacto" placeholder="Contacto" disabled>
          </div>
          <label for="title" class="col-sm-2 control-label">Ejecutivo</label>
          <div class="col-sm-12">
            <input type="text" name="agente" class="form-control" id="agente" placeholder="" disabled>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-lg-6">
                <label for="title" class="col-sm-2 control-label">Fecha</label>
                <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" disabled>
              </div>
              
              <div class="col-lg-6">
               <label for="title" class="col-sm-2 control-label">Hora</label>
               <input type="text" name="hora" class="form-control" id="hora" placeholder="" disabled>
             </div>
           </div>
           
         </div>
         <div class="col-sm-12" >
          <div class="table-responsive">
            <table class="table" id="tablaDetalleProductosDemo">
             
            </table>
          </div>
        </div>
        <div class="col-lg-12">
          <label for="title" class="col-sm-2 control-label">Descripción</label>
          <textarea class="form-control" id="descripcion" rows="10" cols="50" disabled></textarea>
        </div>
        
      </div>

      
      
      
    </div>
    <div class="modal-footer">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <button type="button" class="btn btn-success btnCerrarVistas" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    
  </div>
</div>
</div>
<!--MODALS-->

</div>
</div>
</div>
<script type="text/javascript">
  var elemento =  $("#valorElegido").val();
  document.ready = document.getElementById("elegirAgente").value = elemento;
</script>
<script type="text/javascript">

  $(function() {

   var date = new Date();
   var yyyy = date.getFullYear().toString();
   var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
   var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
   
   $('#calendar').fullCalendar({
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    buttonText: {
      today:    'Hoy',
      month:    'Mes',
      week:     'Semana',
      day:      'Día',
      list:     'Lista'
    },
    header: {
      locale: 'es',
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,listDay,agendaDay,agendaFiveDay'
      

    },
    defaultDate: yyyy+"-"+mm+"-"+dd,
    editable: false,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            
            eventRender: function(event, element) {
              element.bind('dblclick', function() {
                $('#ModalDetalleEvento #asunto').val(event.title);
                $('#ModalDetalleEvento #contacto').val(event.contacto);     
                $('#ModalDetalleEvento #descripcion').val(event.descripcion);  
                $('#ModalDetalleEvento #agente').val(event.agente);     
                $('#ModalDetalleEvento #fecha').val(event.fecha);     
                $('#ModalDetalleEvento #hora').val(event.hora); 

                if (event.color == "#FFB848") {
                  var listaCabeceras = ['Producto'];

                  body = document.getElementById("tablaDetalleProductosDemo");

                  thead = document.createElement("thead");
                  thead.setAttribute('style','background:#008B8B;color: white');

                  theadTr = document.createElement("tr");

                  for (var h = 0; h < listaCabeceras.length; h++) {
                    
                    var celdaThead = document.createElement("th");
                    var textoCeldaThead = document.createTextNode(listaCabeceras[h]);
                    celdaThead.appendChild(textoCeldaThead);
                    theadTr.appendChild(celdaThead);

                  }
                  
                  thead.appendChild(theadTr);
                  
                  tblBody = document.createElement("tbody");

                  var  productos = event.productos;
                  var  productos = productos.split(',');
                  
                  
                          // Crea las celdas
                          for (var i = 0; i <  productos.length; i++) {
                            // Crea las hileras de la tabla
                            var hilera = document.createElement("tr");
                            
                            var celda = document.createElement("td");
                            var textoCelda = document.createTextNode(productos[i]);
                            celda.appendChild(textoCelda);
                            hilera.appendChild(celda);
                            
                            
                            // agrega la hilera al final de la tabla (al final del elemento tblbody)
                            tblBody.appendChild(hilera);
                          }
                          
                          // appends <table> into <body>
                          body.appendChild(tblBody);
                          body.appendChild(thead);
                          
                        }

                        $('#ModalDetalleEvento').modal('show');
                      });
            },
            
            events: [
            <?php 

            function eliminarEspacios($cadena)
            {
              return preg_replace("/\s+/", " ", trim($cadena));
            }


            foreach($eventos as $event): 
              
              $fechaInicio = $event["fecha"]." ".$event["hora"];
              $fechaFinal = $event["fecha"]." ".$event["hora"];
              if($fechaInicio[1] == '00:00:00'){
                $fechaInicio = $fechaInicio[0];
              }else{
                $fechaInicio = $event["fecha"]." ".$event["hora"];
              }
              if($fechaFinal[1] == '00:00:00'){
                $fechaFinal = $fechaFinal[0];
              }else{
                $fechaFinal = $event["fecha"]." ".$event["hora"];
              }

              $evento = $event["evento"];
              switch ($evento) {
                case 'citas':
                $evento =  "#7460EE";
                break;
                case 'llamada':
                $evento =  "#28B779";
                break;
                case 'visitas':
                $evento =  "#DA542E";
                break;
                case 'demostraciones':
                $evento =  "#FFB848";
                
                break;
                case 'recordatorios':
                $evento =  "#2255A4";
                break;

              }
              ?>
              {
                id: '<?php echo $event['id']; ?>',
                title: '<?php echo  eliminarEspacios($event['asunto']) ?>',
                start: '<?php echo $fechaInicio; ?>',
                end: '<?php echo $fechaFinal; ?>',
                color: '<?php echo $evento ?>',
                contacto:'<?php echo  eliminarEspacios($event['prospecto'])?>',
                agente:'<?php echo $event['agente']?>',
                fecha:'<?php echo $event['fecha']?>',
                hora:'<?php echo $event['hora']?>',
                productos:'<?php echo eliminarEspacios($event['productos'])?>',
                descripcion:'<?php echo eliminarEspacios($event['descripcion']) ?>'
              },
            <?php endforeach; ?>
            ]
          });
   
   
 });

</script>
