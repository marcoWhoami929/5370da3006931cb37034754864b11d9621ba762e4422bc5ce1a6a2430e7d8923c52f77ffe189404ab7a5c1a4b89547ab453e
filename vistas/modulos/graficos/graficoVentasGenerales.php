<?php

require_once("controladores/crm.php");
require_once("modelos/crm.php");

?>
<div class='col-lg-6 col-md-6 col-sm-6'>
<figure class="highcharts-figure">
                <div id="graficoVentasGenerales"></div>

              </figure>

</div>
              

<script type="text/javascript">
	Highcharts.chart('graficoVentasGenerales', {
  chart: {
    type: 'line'
  },
  title: {
    text: 'Ventas'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
  	
   
    categories: [
       'Julio','Agosto','Septiembre','Octubre'
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
    name: 'Conversion Swam',
    data: [
    		
         <?php

          if ($canal == 0 and $agente != 0 ) {

                $table = "ventas";
           $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

           $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 1 and v.idAgente = '".$agente."' GROUP by SUBSTRING(v.fechaVenta,6,2)";
        

           $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

           
           $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
           $data = [];
           for ( $i = 0; $i < count($indicadores); $i++ ) {


              $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
            }

            for ($i=0; $i < count($meses); $i++) { 
                 if (array_key_exists($meses[$i],$data)) {


                 }else{

                    $data += [$meses[$i] => "0"];    

                 }
            }
            ksort($data);
             foreach ($data as $key => $val) {
                echo "$val".",";
            }

          }else{


              $table = "ventas";
               $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

               $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 1 GROUP by SUBSTRING(v.fechaVenta,6,2)";
            

               $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

               
               $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
               $data = [];
               for ( $i = 0; $i < count($indicadores); $i++ ) {


                  $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
                }

                for ($i=0; $i < count($meses); $i++) { 
                     if (array_key_exists($meses[$i],$data)) {


                     }else{

                        $data += [$meses[$i] => "0"];    

                     }
                }
                ksort($data);
                 foreach ($data as $key => $val) {
                    echo "$val".",";
                }
          }

           

        ?>
    		]
  },
  	{
    name: 'Corporativos',
    data: [
          
          <?php

            if ($canal == 0 and $agente != 0 ) {

                $table = "ventas";
           $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

           $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 2 and v.idAgente = '".$agente."' GROUP by SUBSTRING(v.fechaVenta,6,2)";
        

           $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

           
           $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
           $data = [];
           for ( $i = 0; $i < count($indicadores); $i++ ) {


              $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
            }

            for ($i=0; $i < count($meses); $i++) { 
                 if (array_key_exists($meses[$i],$data)) {


                 }else{

                    $data += [$meses[$i] => "0"];    

                 }
            }
            ksort($data);
             foreach ($data as $key => $val) {
                echo "$val".",";
            }

          }else{


              $table = "ventas";
               $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

               $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 2 GROUP by SUBSTRING(v.fechaVenta,6,2)";
            

               $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

               
               $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
               $data = [];
               for ( $i = 0; $i < count($indicadores); $i++ ) {


                  $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
                }

                for ($i=0; $i < count($meses); $i++) { 
                     if (array_key_exists($meses[$i],$data)) {


                     }else{

                        $data += [$meses[$i] => "0"];    

                     }
                }
                ksort($data);
                 foreach ($data as $key => $val) {
                    echo "$val".",";
                }
          }

        ?>
    	  ]
  },
  	{
    name: 'Distribución',
    data: [
    		   <?php

            if ($canal == 0 and $agente != 0 ) {

                $table = "ventas";
           $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

           $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 4 and v.idAgente = '".$agente."' GROUP by SUBSTRING(v.fechaVenta,6,2)";
        

           $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

           
           $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
           $data = [];
           for ( $i = 0; $i < count($indicadores); $i++ ) {


              $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
            }

            for ($i=0; $i < count($meses); $i++) { 
                 if (array_key_exists($meses[$i],$data)) {


                 }else{

                    $data += [$meses[$i] => "0"];    

                 }
            }
            ksort($data);
             foreach ($data as $key => $val) {
                echo "$val".",";
            }

          }else{


              $table = "ventas";
               $campos = "sum(v.montoTotal) as monto,SUBSTRING(v.fechaVenta,6,2) as fecha";

               $parametros = "as v inner join prospectos as p ON v.idOportunidad = p.id WHERE SUBSTRING(v.fechaVenta,1,10) BETWEEN '".$inicial."' and '".$final."' and p.clasificacion = 4 GROUP by SUBSTRING(v.fechaVenta,6,2)";
            

               $indicadores = ControladorGeneral::ctrObtenerIndicadoresGraficos($table,$campos,$parametros);

               
               $meses = [0=>'07',1=>'08',2=>'09',3=>'10'];
               $data = [];
               for ( $i = 0; $i < count($indicadores); $i++ ) {


                  $data += [$indicadores[$i]["fecha"] => $indicadores[$i]["monto"]];        
                }

                for ($i=0; $i < count($meses); $i++) { 
                     if (array_key_exists($meses[$i],$data)) {


                     }else{

                        $data += [$meses[$i] => "0"];    

                     }
                }
                ksort($data);
                 foreach ($data as $key => $val) {
                    echo "$val".",";
                }
          }

        ?>
    	 ]
  }]
});

</script>