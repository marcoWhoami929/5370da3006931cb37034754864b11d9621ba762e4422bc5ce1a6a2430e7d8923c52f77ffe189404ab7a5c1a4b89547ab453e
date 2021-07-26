/*=============================================
TABLA PROSPECTOS
=============================================*/
$(document).ready(function(){

  var agenteSeleccion = $("#agenteSeleccionado").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFin = $("#fechaFin").val();

  if (agenteSeleccion != "") {
    var agenteElegido = agenteSeleccion;
  } else{
    var agenteElegido = "";
  }
  if (fechaInicial != "") {
    var fechaInicio = fechaInicial;
  } else{
    var fechaInicio = "";
  }
  if (fechaFin != "") {
    var fechaFinal = fechaFin;
  } else{
    var fechaFinal = "";
  }

tablaProspectos = $(".tablaProspectos").DataTable({
   //"ajax":"ajax/tablaProspectos.ajax.php?agente="+agenteElegido+"&fechaInicial="+fechaInicio+"&fechaFin="+fechaFinal,
   "ajax":"ajax/tablaProspectos.ajax.php?agente="+agenteElegido,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
});
/*=============================================
TABLA CARTERA
=============================================*/
$(document).ready(function(){
  var agenteSeleccion = $("#agenteElegido").val();

  if (agenteSeleccion != "") {
    var agenteElegido = agenteSeleccion;
  } else{
    var agenteElegido = "";
  }
  tablaCartera = $(".tablaCartera").DataTable({
   "ajax":"ajax/tablaCartera.ajax.php?agenteElegido="+agenteElegido,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});

});
/*=============================================
TABLA OPORTUNIDADES
=============================================*/
$(document).ready(function(){

  var agenteSeleccion = $("#agenteSeleccionado").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFin = $("#fechaFin").val();

  if (agenteSeleccion != "") {
    var agenteElegido = agenteSeleccion;
  } else{
    var agenteElegido = "";
  }
  if (fechaInicial != "") {
    var fechaInicio = fechaInicial;
  } else{
    var fechaInicio = "";
  }
  if (fechaFin != "") {
    var fechaFinal = fechaFin;
  } else{
    var fechaFinal = "";
  }

  tablaOportunidades = $(".tablaOportunidades").DataTable({
   "ajax":"ajax/tablaOportunidades.ajax.php?idAgente="+agenteElegido+"&fechaInicial="+fechaInicio+"&fechaFin="+fechaFinal,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
});

/*=============================================
TABLA CLIENTES
=============================================*/
$(document).ready(function(){

  var agenteSeleccion = $("#agenteSeleccionado").val();

  if (agenteSeleccion != "") {
    var agenteElegido = agenteSeleccion;
  } else{
    var agenteElegido = "";
  }

  tablaClientes = $(".tablaClientes").DataTable({
   "ajax":"ajax/tablaClientes.ajax.php?agente="+agenteElegido,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
});
/*=============================================
TABLA VENTAS
=============================================*/
$(document).ready(function(){

  var agenteSeleccion = $("#agenteSeleccionado").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFin = $("#fechaFin").val();

  if (agenteSeleccion != "") {
    var agenteElegido = agenteSeleccion;
  } else{
    var agenteElegido = "";
  }
  if (fechaInicial != "") {
    var fechaInicio = fechaInicial;
  } else{
    var fechaInicio = "";
  }
  if (fechaFin != "") {
    var fechaFinal = fechaFin;
  } else{
    var fechaFinal = "";
  }

  tablaVentas = $(".tablaVentas").DataTable({
   "ajax":"ajax/tablaVentasPorPeriodo.ajax.php?idAgente="+agenteElegido+"&fechaInicial="+fechaInicio+"&fechaFin="+fechaFinal,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
});

/*=============================================
TABLA PENDIENTES
=============================================*/

tablaPendientes = $(".tablaPendientes").DataTable({
   "ajax":"ajax/tablaPendientes.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/*=============================================
TABLA EVENTOS
=============================================*/

tablaEventos = $(".tablaEventos").DataTable({
   "ajax":"ajax/tablaEventos.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/**
 * MOSTRAR TABLAS DE EVENTOS DEPENDIENDO
 * DEL TIPO DE SELECCION EN EL MENU
 * SE CARGA LA TABLA QUE ES LLAMADA EN EL
 * MENU
 *
 *
 */

String.prototype.capitalize = function(){
  return this.charAt(0).toUpperCase() + this.slice(1);
}

var tabla = localStorage.getItem("eventos");

if (tabla == "llamadas") {

    var tablaOrigen = "llamada";

}else{

    var tablaOrigen = tabla;
}
 $("#"+tabla).DataTable({
   "ajax":"ajax/tablaEventosCalendario.ajax.php?tabla="+tablaOrigen,
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/*
OBTENER DETALLES DEL EVENTO
 */
$("#"+tabla).on("click",".btnDetalleEvento",function(){

      var idEvento = $(this).attr("idEvento");
      var tablaEvento = $(this).attr("tabla");

      var datos = new FormData();
      datos.append('idEvento',idEvento);
      datos.append('tablaEvento',tablaEvento);

      $.ajax({
        url: "ajax/functions.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

              var resp = JSON.parse(respuesta);
              $("#detalle"+tabla.capitalize()).modal('show');

              if (tabla == "citas" || tabla == "demostraciones") {

                if (tabla == "citas") {
                  $("#detalleUbicacion").val(resp[0]["ubicacion"]);
                  $("#detalleLatitud").val(resp[0]["latitud"]);
                  $("#detalleLongitud").val(resp[0]["longitud"]);
                  $("#detalleInvitados").val(resp[0]["invitados"]);

                  initMap(resp[0]["latitud"],resp[0]["longitud"]);
                  localStorage.setItem("latitudProspecto",resp[0]["latitud"]);
                  localStorage.setItem("longitudProspecto",resp[0]["longitud"]);

                }else if (tabla == "demostraciones"){

                  $("#detalleUbicacion").val(resp[0]["ubicacion"]);
                  $("#detalleLatitud").val(resp[0]["latitud"]);
                  $("#detalleLongitud").val(resp[0]["longitud"]);

                   initMap(resp[0]["latitud"],resp[0]["longitud"]);

                  localStorage.setItem("latitudProspecto",resp[0]["latitud"]);
                  localStorage.setItem("longitudProspecto",resp[0]["longitud"]);

                  var listaCabeceras = ['Producto'];

                  body = document.getElementById("tablaDetalleProductosDemostracion");

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

                  var  productos = resp[0]["productos"];
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

              }else{

                  $("#detalleUbicacion").val(resp[0]["ubicacion"]);
                  $("#detalleLatitud").val(resp[0]["latitud"]);
                  $("#detalleLongitud").val(resp[0]["longitud"]);

                  initMap(resp[0]["latitud"],resp[0]["longitud"]);

                  localStorage.setItem("latitudProspecto",resp[0]["latitud"]);
                  localStorage.setItem("longitudProspecto",resp[0]["longitud"]);

              }


            }
        });


});
function initMap(latitud,longitud) {
    var locationRio = {lat: 19.011903, lng: -98.205545};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: locationRio,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      icon : image
    });


    var image = {
      url: 'vistas/img/plantilla/paint.png', //ruta de la imagen
      size: new google.maps.Size(40, 60), //tamaño de la imagen
      origin: new google.maps.Point(0,0), //origen de la iamgen
      //el ancla de la imagen, el punto donde esta marcando, en nuestro caso el centro inferior.
      anchor: new google.maps.Point(20, 60)
    };

    var directionsService = new google.maps.DirectionsService;
    var directionsRenderer = new google.maps.DirectionsRenderer({
      draggable: true,
      map: map,
      panel: document.getElementById('right-panel')
    });

    directionsRenderer.addListener('directions_changed', function() {
      computeTotalDistance(directionsRenderer.getDirections());


    });
    var latitudProspecto = latitud;
    var longitudProspecto = longitud;
    var direccionesProspecto = ''+latitudProspecto+','+longitudProspecto+'';

    var latitudAgente = 19.011903;
    var longitudAgente =-98.205545;
    var coordenadaAgente = ''+latitudAgente+','+longitudAgente+'';

    displayRoute(''+coordenadaAgente+'', ''+direccionesProspecto+'', directionsService,
    directionsRenderer);

  }

  function displayRoute(origin, destination, service, display) {
    document.getElementById('right-panel').innerHTML="";
    service.route({
      origin: origin,
      destination: destination,

      travelMode: 'DRIVING',
      avoidTolls: true
    }, function(response, status) {
      if (status === 'OK') {
        display.setDirections(response);
      } else {
        console.log('Could not display directions due to: ' + status);
      }
    });
  }

  function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
      total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    document.getElementById('total').innerHTML = total + ' km';
  }
$(".btnCerrarVistaEventos").on("click", function() {
        //localStorage.removeItem("latitudProspecto");
        //localStorage.removeItem("longitudProspecto");


});

/**
 * OBTENER EL DETALLE DE LA FINALIZACION DEL EVENTO DE QUE TRATO EL EVENTO
 */
$("#"+tabla).on("click",".btnDetalleFinalizado",function(){

      var idEvento = $(this).attr("idEvento");
      var tablaEvento = $(this).attr("tabla");

      var datos = new FormData();
      datos.append('idEventoFinalizado',idEvento);
      datos.append('tablaEventoFinalizado',tablaEvento);


       $.ajax({
        url: "ajax/functions.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {

              var resp = JSON.parse(respuesta);
              $("#informacion"+tabla.capitalize()).modal('show');

              $("#detalleFinalizacion").val(resp["detalle"]);



            }
        });


});
/*=============================================
TABLA DESCARTADOS
=============================================*/

tablaDescartados = $(".tablaDescartados").DataTable({
   "ajax":"ajax/tablaDescartados.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/*=============================================
TABLA BITACORA
=============================================*/

tablaBitacora = $(".tablaBitacora").DataTable({
   "ajax":"ajax/tablaBitacora.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/*=============================================
TABLA BITACORA
=============================================*/

tablaHistorial = $(".tablaHistorial").DataTable({
   "ajax":"ajax/tablaHistorialSeguimientos.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});
/*=============================================
TABLA DIRECTORIO
=============================================*/

tablaDirectorio = $(".tablaDirectorio").DataTable({
   "ajax":"ajax/tablaDirectorio.ajax.php",
   "deferRender": true,
   "retrieve": true,
   "processing": true,
   "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

});


/*
MOSTRAR LA LISTA DE PRODUCTOS EN OPORTUNIDADES Y VENTAS
 */


$(".tablaOportunidades").on("click",".btnVisualizarProductos",function(){

    var idOportunidad = $(this).attr("idOportunidad");
    var tablaOportunidad = "oportunidades";

    var datos = new FormData();
    datos.append('idOportunidad',idOportunidad);
    datos.append('tablaOportunidad',tablaOportunidad);
    $.ajax({

    url:"ajax/functions.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){


            var montoTotal = respuesta["monto"];

            var monto = document.getElementById("montoTotalOportunidad");
            monto.innerHTML = '$'+' '+montoTotal;

            monto.setAttribute("style", "font-size:19px;font-weight:bold;color:#008B8B");


            var listaCabeceras = ['Codigo','Descripcion','Cantidad','Precio'];

            body = document.getElementById("tablaDetalleProductos");

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

            var  codigos = respuesta["codigos"];
            var  codigos = codigos.split(',');

            var  productos = respuesta["productos"];
            var  productos = productos.split(',');

            var  cantidades = respuesta["cantidades"];
            var  cantidades = cantidades.split(',');

            var  precios = respuesta["precios"];
            var  precios = precios.split(',');
            // Crea las celdas
            for (var i = 0; i <  codigos.length; i++) {
              // Crea las hileras de la tabla
              var hilera = document.createElement("tr");

                  var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(codigos[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                  var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(productos[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                   var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(cantidades[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                  var celda = document.createElement("td");
                  var precio = precios[i]*1;
                  var textoCelda = document.createTextNode("$ "+precio.toFixed(2));
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);

              // agrega la hilera al final de la tabla (al final del elemento tblbody)
              tblBody.appendChild(hilera);
            }

            // appends <table> into <body>
            body.appendChild(tblBody);
            body.appendChild(thead);

        }



  })



});
$(".tablaVentas").on("click",".btnVisualizarProductos",function(){

    var idOportunidad = $(this).attr("idOportunidad");
    var tablaOportunidad = "oportunidades";

    var datos = new FormData();
    datos.append('idOportunidad',idOportunidad);
    datos.append('tablaOportunidad',tablaOportunidad);
    $.ajax({

    url:"ajax/functions.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){


            var montoTotal = respuesta["monto"];

            var monto = document.getElementById("montoTotalOportunidad");
            monto.innerHTML = '$'+' '+montoTotal;

            monto.setAttribute("style", "font-size:19px;font-weight:bold;color:#008B8B");


            var listaCabeceras = ['Codigo','Descripcion','Cantidad','Precio'];

            body = document.getElementById("tablaDetalleProductos");

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

            var  codigos = respuesta["codigos"];
            var  codigos = codigos.split(',');

            var  productos = respuesta["productos"];
            var  productos = productos.split(',');

            var  cantidades = respuesta["cantidades"];
            var  cantidades = cantidades.split(',');

            var  precios = respuesta["precios"];
            var  precios = precios.split(',');
            // Crea las celdas
            for (var i = 0; i <  codigos.length; i++) {
              // Crea las hileras de la tabla
              var hilera = document.createElement("tr");

                  var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(codigos[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                  var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(productos[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                   var celda = document.createElement("td");
                  var textoCelda = document.createTextNode(cantidades[i]);
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);
                  var celda = document.createElement("td");
                  var precio = precios[i]*1;
                  var textoCelda = document.createTextNode("$ "+precio.toFixed(2));
                  celda.appendChild(textoCelda);
                  hilera.appendChild(celda);

              // agrega la hilera al final de la tabla (al final del elemento tblbody)
              tblBody.appendChild(hilera);
            }

            // appends <table> into <body>
            body.appendChild(tblBody);
            body.appendChild(thead);

        }



  })



});
$(".btnCerrarVista").on("click", function() {

        var nodos = document.getElementById('tablaDetalleProductos');
        while (nodos.firstChild) {
          nodos.removeChild(nodos.firstChild);
        }
});
$(".btnCerrarVistaEventos").on("click", function() {

        var nodos = document.getElementById('tablaDetalleProductosDemostracion');
        while (nodos.firstChild) {
          nodos.removeChild(nodos.firstChild);
        }
});
$(".btnCerrarVistas").on("click", function() {

        var nodos = document.getElementById('tablaDetalleProductosDemo');
        while (nodos.firstChild) {
          nodos.removeChild(nodos.firstChild);
        }
});
/*
BUSCAR EL TIMELINE DEL USUARIO INDICADO
 */
$("#buscarTimeline").change(function() {

    var id = document.getElementById("buscarTimeline").value;

    var datos = new FormData();
    datos.append('idProspectoTimeline',id);

     var button = document.getElementById("btnDescargarReporteTimeLline");
     button.style.display = '';

    var elemento = document.getElementById("vinculoDescargarReporte");
    elemento.setAttribute("href", "vistas/modulos/reportes.php?reporteTimeline=seguimientos&idProspecto="+id+"");

     $.ajax({

    url:"ajax/functions.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){

         var json = respuesta;


         $("#timelineSection").html("");
         for (var i = 0; i < json.length; i++) {
           if (i % 2 == 0) {
              var clase = "left";
           }else{
              var clase = "right";
           }
           var acum = i+1;

           var fecha = json[i]["fecha"];

           var año = fecha.substring(0,4);
           var mes = fecha.substring(5,7);
           var dia = fecha.substring(8,10);;

           const date = new Date(año, mes-1, dia);
           const month = date.toLocaleString('es-MX', { month: 'long' });

           /*CAMBIO REALILZADO*/
           var fechaAlta = moment('2020-07-24 09:00:00',"YYYY-MM-DD HH:mm:ss");
           var fechaSeguimiento = moment(json[i]["fecha"],"YYYY-MM-DD HH:mm:ss");


            var ms = moment(fechaSeguimiento,"DD/MM/YYYY HH:mm:ss").diff(moment(fechaAlta,"DD/MM/YYYY HH:mm:ss"));
            var d = moment.duration(ms);

            if (d.months() == 1) {

                var nombreMes = "mes";
            }else{
                var nombreMes = "meses";
            }
            var tiempoTranscurrido = d.months()+" "+nombreMes+" "+ d.days()+" dias"+  d.hours()+ " horas "+ d.minutes()+" minutos"+" y "+d.seconds()+" segundos";


           var seguimiento = `<div class="timeline-article">
                                            <div class="content-`+clase+`-container">
                                              <div class="content-`+clase+`">
                                                <p>`+json[i]["titulo"]+`<span class="article-number">`+acum+`</span></p>
                                              </div>
                                              <span class="timeline-author">`+json[i]["fecha"]+`</span>
                                              <span class="timeline-author" style="font-weigth:bold">`+tiempoTranscurrido+`</span>
                                            </div>

                                            <div class="meta-date">
                                              <span class="date">`+mes+`</span>
                                              <span class="month">`+month+`</span>
                                            </div>
                                          </div>

                                         `;
                                      $("#timelineSection").append(seguimiento);
         }




    }



  })


});

/*=============================================
HABILITAR PROSPECTO A AGENTE
=============================================*/
$(".tablaProspectos").on("click", ".btnHabilitarProspecto", function(){

  var idProspecto = $(this).attr("idProspecto");
  var estadoProspecto= $(this).attr("estadoProspecto");

  var datos = new FormData();
    datos.append("idProspectoHabilitado", idProspecto);
    datos.append("estadoProspecto", estadoProspecto);

    $.ajax({

    url:"ajax/functions.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        console.log("respuesta", respuesta);
      }

    })

    if(estadoProspecto== 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('<i class="fa fa-power-off"></i>Deshabilitado');
      $(this).attr('estadoProspecto',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('<i class="fa fa-power-off"></i>Habilitado');
      $(this).attr('estadoProspecto',0);

    }

})
/********/
function setValue(){
  var inicio = $("#inicial").val();
  var final = $("#final").val();
  localStorage.setItem("inicioDashboard",inicio);
  localStorage.setItem("finalDashboard",final);
}

$(document).ready(function(){
  var URLactual = window.location;
  var url =  /^(\w+):\/\/([^\/]+)([^]+)$/.exec(URLactual);
  var [,protocolo,servidor,path] = url;

  let busqueda = path.indexOf("dashboard");
  let busqueda2 = path.indexOf("oportunidades");
  
  if (busqueda !== -1 || busqueda2 !== -1) {
    var inicio = localStorage.getItem("inicioDashboard");
    var final = localStorage.getItem("finalDashboard");

    document.getElementById("inicial").value = inicio;
    document.getElementById("final").value = final;
  }else {
    /*
    var fechaInicio = "2020-07-24";
    var fechaFinal = fechaActual();
    var inicio = localStorage.getItem("inicioDashboard");
    var final = localStorage.getItem("finalDashboard");

    document.getElementById("inicial").value = inicio;
    document.getElementById("final").value = final;
    */

  }

})

/***OBTENER LA FECHA ACTUAL****/

function fechaActual(){
   var hoy = new Date();
   var dd = hoy.getDate();
   var mm = hoy.getMonth()+1;
   var yyyy = hoy.getFullYear();

   if(dd<10) {
    dd='0'+dd;
    }

    if(mm<10) {
        mm='0'+mm;
    }

   return yyyy+'-'+mm+'-'+dd;
}
/**
  * VER GRAFICO EN TABLA CARTERA
  */
 $(".tablaCartera").on("click", ".btnVerGraficoVentas", function(){

  var idCartera = $(this).attr("idCartera");

  $.ajax({
        type: "POST",
        url: "vistas/modulos/graficos/graficoVentasProspectos.php",
        data: "idCartera="+idCartera,
        beforeSend: function(objeto){

        },
        success: function(data){

          var datos = JSON.parse(data);

          var myDateFormat = '%e/%m/%y';

          var cantidad = datos.length;
          var monto1 = datos[0][1] * 1;

          var fecha = fechaActual();
          

          Highcharts.chart('ventasProspectos', {
              chart: {
                  type: 'scatter',
                  zoomType: 'xy'
              },
              title: {
                  text: 'VENTAS'
              },
              subtitle: {
                  text: 'Periodo: 2020-07-24 AL '+fecha+''
              },
              xAxis: {
                  title: {
                      enabled: true,
                      text: 'Fecha'
                  },
                  type: 'datetime',
                  dateTimeLabelFormats: {
                    millisecond: myDateFormat,
                          second: myDateFormat,
                          minute: myDateFormat,
                          hour: myDateFormat,
                          day: myDateFormat,
                          week: myDateFormat,
                          month: myDateFormat,
                          year: myDateFormat
                  },

              },
              yAxis: {
                  title: {
                      text: 'MONTO ($)'
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'left',
                  verticalAlign: 'top',
                  x: 100,
                  y: 100,
                  floating: true,
                  backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
                  borderWidth: 1
              },
              plotOptions: {
                  scatter: {
                      marker: {
                          radius: 5,
                          states: {
                              hover: {
                                  enabled: true,
                                  lineColor: 'rgb(100,100,100)'
                              }
                          }
                      },
                      states: {
                          hover: {
                              marker: {
                                  enabled: false
                              }
                          }
                      },
                      tooltip: {
                          headerFormat: '<b>{series.name}</b><br>',
                          pointFormat: ' {point.y} monto'
                      }
                  }
              },
              series: [{
                  name: ""+datos[0][2]+"",
                  color: 'rgba(223, 83, 83, .5)',
                  type: 'spline',

                  marker: {
                         lineWidth: 2,
                         lineColor: Highcharts.getOptions().colors[3],
                         fillColor: 'white'
                  },
                  data: (function() {
                   var data = [];

                   for (var i = 0; i < datos.length; i++) {
                         data.push([Date.parse(datos[i][0]), datos[i][1] * 1]);
                              
                   }
                   return data;
                                        
                })()
                  /*
                  data: [
                  for (var i = 0; i < datos.length; i++) {

                    [Date.parse(datos[0][0]), datos[0][1] * 1],
                  [Date.parse(datos[1][0]), datos[1][1] * 1],
                  [Date.parse(datos[2][0]), datos[2][1] * 1],
                  [Date.parse(datos[3][0]), datos[3][1] * 1],
                  [Date.parse(datos[4][0]), datos[4][1] * 1],
                  [Date.parse(datos[5][0]), datos[5][1] * 1],
                  [Date.parse(datos[6][0]), datos[6][1] * 1],
                  [Date.parse(datos[7][0]), datos[7][1] * 1],
                  [Date.parse(datos[8][0]), datos[8][1] * 1]
                    
                  }
              ]
              */

              }]
          });


        }
  });

});
