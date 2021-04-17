<?php

    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

?>
<div class='col-lg-6 col-md-6 col-sm-6'>
<figure class="highcharts-figure">
    <div id="ventasAgentesCorporativos"></div>
    
</figure>
</div>
<script type="text/javascript">
	Highcharts.chart('ventasAgentesCorporativos', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'VENTAS CORPORATIVOS'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        
        pointFormat: '{point.name}: <b>${point.y:.2f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}: <b>{point.percentage:.1f}%</b>'

            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Venta',

        data: [
            ['San Manuel', 
            <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 5 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                   if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }

            ?>],
            ['Reforma',
             <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 6 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                   if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }

            ?>],
            ['Santiago', 
             <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 8 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                 if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }
                 

            ?>],
            ['Capu',
             <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 7 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                   if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }

            ?>],
            ['Las Torres',
             <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 9 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                   if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }

            ?>],
            ['Iván Herrera',
             <?php 

                $table = "ventas";
                 $campos = "SUM(v.montoTotal)";
                 $parametros = " as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where p.clasificacion = 2 and v.idAgente = 11 and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";
                 $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

                   if ($indicadores["total"] == 0) {
                  echo 0;
                 }else{
                  echo $indicadores["total"];
                 }

            ?>]
        ]
    }]
});
</script>

<style type="text/css" media="screen">
	#ventasAgentesCorporativos {
  height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
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