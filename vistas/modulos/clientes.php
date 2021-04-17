<?php
    require_once("controladores/crm.php");
    require_once("modelos/crm.php");

     $url =  'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

                $parametros = parse_url($url);


                if (isset($parametros['query'])) {
                     parse_str($parametros['query'], $parametro);
                     $idAgente = $parametro['agente'];
                     $canal = $parametro['canal'];
                     $inicial = $parametro['inicial'];
                     $final = $parametro['final'];
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
                    <h4 class="page-title">Clientes</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Clientes</h4>
                                    <h5 class="card-subtitle"></h5>
                                    <input type="hidden" id="agenteSeleccionado" value="<?php echo $valor ?>">
                                    <input type="hidden" id="fechaInicial" value="<?php echo $inicial ?>">
                                    <input type="hidden" id="fechaFin" value="<?php echo $final ?>">
                                    <form action="clientes" method="GET" >
                                        <div class="col-lg-12">
                                          <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <span>Agente</span>
                                                <select class="form-control" id="agente" name="agente" onchange="this.form.submit()">

                                                    <option value="0">Todos los Agentes</option>
                                                      <option value="1">Rocio Martinez Morales</option>
                                                      <option value="2">Orlando Raúl Briones Aguirre</option>
                                                      <option value="3">Gerónimo Bautista Escudero</option>
                                                      <option value="4">Jonathan González Sánchez</option>
                                                      <option value="5">San Manuel</option>
                                                      <option value="6">Reforma</option>
                                                      <option value="7">Capu</option>
                                                      <option value="8">Santiago</option>
                                                      <option value="9">Las Torres</option>
                                                      <option value="11">Ivan Herrera</option>
                                                      <option value="12">Jesús García</option>
                                                      <option value="13">Mario Hernández</option>

                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-4 col-md-4 col-sm-4" style="display: none">
                                                <span>Inicio</span>
                                                <input type="date" class="form-control" id="inicial" name="inicial"  >
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4" style="display: none">
                                                <span>Final</span>
                                                <input type="date" class="form-control" id="final" name="final">
                                            </div>

                                          </div>
                                        </div>
                                        
                                    </form>
                                    <br>
                                    <?php 
                                    echo "<a href='vistas/modulos/reportes.php?clientes=prospectos&agente=".$valor."' ><button type='button' class='btn btn-success'>
                                        <i class='fas fa-file-excel fa-2x'></i></button>
                                    </a>";
                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-responsive">

                    <table class="table table-bordered table-striped tablaClientes tableColor" width="100%" id="clientes">

                        <thead class="headColor">

                           <tr>
                             <th style="border:none">#</th>
                             <th style="border:none">Nombre/Taller</th>
                             <th style="border:none">Ticket Promedio</th>
                             <th style="border:none">Ultimo Contacto</th>
                             <th style="border:none">Ejecutivo</th>

                            </tr>

                        </thead>

                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
 <script>


    var agenteElegido =  $("#agenteSeleccionado").val();
    document.ready = document.getElementById("agente").value = agenteElegido;

    var fechaInicial =  $("#fechaInicial").val();
    document.ready = document.getElementById("inicial").value = fechaInicial;
    var fechaFin =  $("#fechaFin").val();
    document.ready = document.getElementById("final").value = fechaFin;



</script>