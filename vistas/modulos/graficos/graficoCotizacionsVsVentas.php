<?php

require_once("controladores/crm.php");
require_once("modelos/crm.php");

?>
<div class='col-lg-6 col-md-6 col-sm-6'>
<figure class="highcharts-figure">
  <div id="ventasCanales"></div>

</figure>
</div>
<script type="text/javascript">
  Highcharts.chart('ventasCanales', {
    chart: {
     type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
      text: 'OPORTUNIDADES VS VENTAS'
    },
    tooltip: {
      pointFormat: '{point.name}: <b>${point.y:.2f}</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      
       pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
      name: 'Brands',
      colorByPoint: true,
      data: [{
        name: 'Oportunidades',
        y:
        <?php

        $table = "oportunidades";
        $campos = "SUM(o.monto)";

        if ($idAgente == 0) {
          if ($valorCanal == 0) {


           $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4) and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

         }else{


          $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

        }
      }else{
        if ($valorCanal == 0) {


         $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion in (1,2,4)  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

       }else{

        $parametros = "as o INNER JOIN prospectos as p ON  o.idProspecto = p.id  where p.clasificacion = ".$canal."  and o.idAgente = ".$idAgente." and SUBSTRING(o.fecha,1,10) BETWEEN '".$inicial."' and '".$final."'";

      }

    }

    $indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

    echo $indicadores["total"];

    ?>,
    sliced: true,
    selected: true
  },{
    name: 'Ventas',
    y:   <?php

    $table = "ventas";
    $campos = "SUM(v.montoTotal)";

    if ($idAgente == 0) {
      if ($valorCanal == 0) {


       $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion  in (1,2,4) and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

     }else{


       $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

     }
   }else{
    if ($valorCanal == 0) {


     $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion in (1,2,4) and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

   }else{


    $parametros = "as v INNER JOIN prospectos as p ON  v.idOportunidad = p.id  where v.estatusVenta != 0 and p.clasificacion = ".$canal." and v.idAgente = ".$idAgente." and SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."'";

  }

}


$indicadores = ControladorGeneral::ctrObtenerIndicadores($table,$campos,$parametros);

echo $indicadores["total"];

?>,
sliced: true,
selected: true
}]
}]
});
</script>
<style media="screen">
  .highcharts-figure, .highcharts-data-table table {
    min-width: 320px;
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


  input[type="number"] {
    min-width: 50px;
  }
</style>
