<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

?>
<figure class="highcharts-figure">
    <div id="funnel"></div>

</figure>

<script type="text/javascript">
 Highcharts.chart('funnel', {
    chart: {
        type: 'funnel3d',
        options3d: {
            enabled: true,
            alpha: 10,
            depth: 50,
            viewDistance: 50
        }
    },
    title: {
        text: 'Conversión de Cartera'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> ({point.y:,.0f})',
                allowOverlap: true,
                y: 10
            },
            neckWidth: '30%',
            neckHeight: '25%',
            width: '80%',
            height: '80%'
        }
    },
    series: [{
        name: '',
        data: [
            ['Prospectos', 
            <?php 
                
                if ($agente == null) {

                     $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE descartado = 0 and habilitado = 1";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];

                }else{
                    $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE descartado = 0 and habilitado = 1  and idAgente = $agente";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];

                }                      

                 
                                           

             ?>],
            ['Oportunidades', 
            <?php 
                if ($agente == null) {

                     $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE oportunidad = 1 and descartado = 0  and habilitado = 1";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];
                }else{

                     $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE oportunidad = 1 and descartado = 0  and habilitado = 1 and idAgente = $agente";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];

                }
                 
             ?>],
            ['Clientes', 
            <?php 
                if ($agente == null) {


                     $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE cliente = 1 and descartado = 0 and habilitado = 1";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];
                }else{



                     $table = "prospectos";
                     $campos = "COUNT(id)";
                     $parametros = "WHERE cliente = 1 and descartado = 0 and habilitado = 1 and idAgente = $agente";
                     $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                     echo $indicadores["total"];
                }

             ?>]
        ]
    }]
});


</script>

<style type="text/css" media="screen">

#funnel {
    height: 420px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 600px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
