
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
                    <h4 class="page-title">VISTAS DEL SISTEMA</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Vistas</li>
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
                                    <h4 class="card-title">Creación de Vistas</h4>
                                    <h5 class="card-subtitle"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        
                            <div class="d-lg-flex align-items-center">
                                
                               
                                    <?php

                                        error_reporting(E_ALL);

                                        $tables = array('agentesventas','clientes','oportunidades','prospectos','ventas','seguimientos','postventa');
                                  
                                     
                                        for($i=0;$i<count($tables);$i++){
                                           
                                            $table = $tables[$i];
                                           
                                            $showColumns = ControladorGeneral::ctrShowViews($table);
                                        
  
                                            echo '<div class="card w-25 dragViews">
                                            <h5 class="card-header primary-color white-text"></h5>
                                            <div class="card-body"><table id="view'.$i.'" class="views">
                                            <thead>
                                            <tr>
                                                <th>'.$table.'</th>
                                            </tr>
                                            </thead>   
                                            ';
                                            for($j=0;$j<count($showColumns);$j++){
    
                                                echo '<tr>
                                                        <td>'.$showColumns[$j]["Field"].'</td> 
                                                    </tr>';
                                            }
                                            echo '</table></div>
                                            </div>';

                                        }

                                    ?>
                               
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
                             <th style="border:none">Correo/Telefono</th>
                             <th style="border:none">Fase/Origen</th>
                             <th style="border:none">Monto</th>
                             <th style="border:none">Tiket Promedio</th>
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
