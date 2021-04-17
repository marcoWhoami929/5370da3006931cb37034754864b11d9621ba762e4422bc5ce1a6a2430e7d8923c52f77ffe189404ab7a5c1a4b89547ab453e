<?php

require_once("controladores/crm.php");
require_once("modelos/crm.php");

?>
<div class='col-lg-6 col-md-6 col-sm-6'>
<figure class="highcharts-figure">
                <div id="graficoVentasPorAgente"></div>

              </figure>

</div>
              

<script type="text/javascript">
  Highcharts.chart('graficoVentasPorAgente', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'VENTAS REALIZADAS'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    
   
    categories: [
       <?php

           
           $table = "ventas";
           $campos = "v.fechaVenta as fecha";

           $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = '".$canal."' and p.idAgente = '".$agente."' ";
        

           $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

           $data = [];
           for ($i=0; $i < count($indicadores); $i++) { 
              
              $data += [$i => $indicadores[$i]["fecha"]];   
           }

           foreach ($data as $key => $val) {
                echo "'$val'".",";
            }

        ?>
    ]
  },
  yAxis: {
    title: {
      text: 'Ventas ($)'
    }
  },
  plotOptions: {
    line: {
      dataLabels: {
        enabled: true
      },
      enableMouseTracking: true
    }
  },
  series: [{
    name: 'Ventas',
    data: [
        
         <?php

           $table = "ventas";
           $campos = " v.montoTotal as monto";

           $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion =  '".$canal."' and p.idAgente = '".$agente."' ";
        

           $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);
           $data = [];
           for ($i=0; $i < count($indicadores); $i++) { 
              
              $data += [$i => $indicadores[$i]["monto"]];   
           }

           foreach ($data as $key => $val) {
                echo "$val".",";
            }
             

        ?>
        ]
  }]
});

</script>