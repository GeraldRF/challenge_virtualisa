<?php
include "../BS/ServiciosProvincia.php";
$servicios = new ServiciosProvincia();

echo json_encode($servicios->obtenerProvincias());


exit();