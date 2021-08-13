$(function () {

  var url = window.location.pathname;

  var ruta = url.split("/");
  switch (ruta[2]) {
 
    case "cartera":
      cargarCartera(1);
      break;
    case "prospectos":
      cargarProspectos(1);
      break;
    case "oportunidades":
      cargarOportunidades(1);
      break;
    case "clientes":
      cargarClientes(1);
      break;
    case "ventasPorPeriodo":
      cargarVentasPeriodo(1);
      break;
    case "eventosCalendario":
      cargarEventos(1);
      break;
    case "bitacora":
      cargarBitacora(1);
      break;
    case "historial":
      cargarSeguimientos(1);
      break;
   
   
  }
});
function cargarCartera(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var clasificacion = $("#clasificacion").val(); 
  var fase = $("#fase").val();
  var tipo = $("#tipo").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "cartera",
    page: page,
    query: query,
    idAgente: idAgente,
    clasificacion:clasificacion,
    fase:fase,
    tipo:tipo,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosCartera").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteCartera(){
    var idAgente = $("#idAgente").val();
    var tabla = 'prospectos';
    var clasificacion = $("#clasificacion").val(); 
    var fase = $("#fase").val();
    var tipo = $("#tipo").val();
    location.href = "vistas/modulos/reporteador.php?reporteCartera="+tabla+"&idAgente="+idAgente+"&clasificacion="+clasificacion+"&fase="+fase+"&tipo="+tipo;
}
function cargarProspectos(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var comentarios = $("#comentarios").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "prospectos",
    page: page,
    query: query,
    idAgente: idAgente,
    comentarios: comentarios,
    fechaInicial:fechaInicial,
    fechaFinal:fechaFinal,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosProspectos").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteProspectos(){
    var idAgente = $("#idAgente").val();
    var tabla = 'prospectos';
    var comentarios = $("#comentarios").val(); 
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteProspectos="+tabla+"&idAgente="+idAgente+"&comentarios="+comentarios+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
}
function cargarOportunidades(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "oportunidades",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial: fechaInicial,
    fechaFinal: fechaFinal,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosOportunidades").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteOportunidades(){
    var idAgente = $("#idAgente").val();
    var tabla = 'oportunidades';
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteOportunidades="+tabla+"&idAgente="+idAgente+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
}
function cargarClientes(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();

  var per_page = $("#per_page").val();
  var parametros = {
    action: "clientes",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial:fechaInicial,
    fechaFinal:fechaFinal,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosClientes").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteClientes(){
    var idAgente = $("#idAgente").val();
    var tabla = 'oportunidades';

   
    location.href = "vistas/modulos/reporteador.php?reporteClientes="+tabla+"&idAgente="+idAgente;
}
function cargarVentasPeriodo(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "ventasPeriodo",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial: fechaInicial,
    fechaFinal: fechaFinal,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosVentasPeriodo").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteVentasPeriodo(){
    var idAgente = $("#idAgente").val();
    var tabla = 'ventas';
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteVentasPeriodo="+tabla+"&idAgente="+idAgente+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
}
function cargarEventos(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var evento = $("#evento").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "eventos",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial: fechaInicial,
    fechaFinal: fechaFinal,
    evento: evento,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosEventosCalendario").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteEventos(){
    var idAgente = $("#idAgente").val();
    var tabla = 'eventos';
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
    var evento = $("#evento").val();
    var nombre = $("#nombre").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteEventos="+tabla+"&idAgente="+idAgente+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&evento="+evento+"&nombre="+nombre;
}
function cargarBitacora(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "bitacora",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial: fechaInicial,
    fechaFinal: fechaFinal,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosBitacora").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteBitacora(){
    var idAgente = $("#idAgente").val();
    var tabla = 'bitacora';
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
    var nombre = $("#nombre").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteBitacora="+tabla+"&idAgente="+idAgente+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&nombre="+nombre;
}
function cargarSeguimientos(page) {
  var query = $("#nombre").val();
  var idAgente = $("#idAgente").val();
  var fechaInicial = $("#fechaInicial").val();
  var fechaFinal = $("#fechaFinal").val();
  var accion = $("#accion").val();
  var per_page = $("#per_page").val();
  var parametros = {
    action: "seguimientos",
    page: page,
    query: query,
    idAgente: idAgente,
    fechaInicial: fechaInicial,
    fechaFinal: fechaFinal,
    accion:accion,
    per_page: per_page,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "ajax/functions.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("Cargando...");
    },
    success: function (data) {
      $(".datosSeguimientos").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
function descargarReporteSeguimientos(){
    var idAgente = $("#idAgente").val();
    var tabla = 'seguimientos';
    var fechaInicial = $("#fechaInicial").val();
    var fechaFinal = $("#fechaFinal").val();
    var nombre = $("#nombre").val();
    var accion = $("#accion").val();
   
    location.href = "vistas/modulos/reporteador.php?reporteSeguimientos="+tabla+"&idAgente="+idAgente+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal+"&nombre="+nombre+"&accion="+accion;
}