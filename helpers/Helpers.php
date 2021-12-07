<?php

function base_url(){    // Retorno la url base de la página
    return BASE_URL;
}

function encabezado($data=""){
    $VistaH = "views/template/header.php";
    require_once($VistaH);
}

function pie($data=""){
    $VistaP = "views/template/footer.php";
    require_once($VistaP);
}

?>