<?php

/**************CONTROLADORES*******************/
require_once "controladores/plantilla.php";
require_once "controladores/administradores.php";
require_once "controladores/crm.php";


/***************MODELOS*******************/

require_once "modelos/administradores.php";
require_once "modelos/crm.php";
require_once "modelos/rutas.php";



$plantilla = new ControladorPlantilla();
$plantilla -> plantilla();