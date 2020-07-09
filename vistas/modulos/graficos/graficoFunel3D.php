<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

?>
<figure class="highcharts-figure">
    <div id="embudo"></div>

</figure>

<script type="text/javascript">
 Highcharts.chart('embudo', {
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
        text: 'Datos Generales'
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
                                                   

                 $table = "prospectos";
                 $campos = "COUNT(id)";
                 $parametros = "WHERE oportunidad = 0 and cliente = 0 and descartado = 0";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                 echo $indicadores["total"];

                                           

             ?>],
            ['Oportunidades', 
            <?php 
                 $table = "oportunidades";
                 $campos = "COUNT(prosp.id)";
                 $parametros = "as opor INNER JOIN prospectos as prosp ON opor.idProspecto = prosp.id WHERE prosp.descartado = 0 and prosp.cliente != 1  and prosp.oportunidadesCreadas != 0 and opor.ventaCerrada = 0";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                 echo $indicadores["total"];
             ?>],
            ['Clientes', 
            <?php 
                 $table = "prospectos";
                 $campos = "COUNT(id)";
                 $parametros = "WHERE cliente = 1 and descartado != 1";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                 echo $indicadores["total"];

             ?>]
        ]
    }]
});


</script>

<style type="text/css" media="screen">

#embudo {
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
