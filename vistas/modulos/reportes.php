<?php

require_once "../../controladores/reportes.php";
require_once "../../modelos/reportes.php";

$reporteSeguimientos = new ControladorReportes();
$reporteSeguimientos -> ctrReporteSeguimientos();

?>