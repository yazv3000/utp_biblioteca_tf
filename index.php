<?php

require_once("config/Config.php");      // configuración y credenciales base de batos
require_once("helpers/Helpers.php");

$url = isset($_GET['url']) ? $_GET['url'] : "Home/home";    // si no, llama el método home de la clase Home
$arrUrl = explode("/", $url);

$controller = $arrUrl[0];
$methop = $arrUrl[0];
$params = "";

// Método
if (isset($arrUrl[1])) {
    if ($arrUrl[1] != "") {
        $methop = $arrUrl[1];
    }
}

// Parámetros
if (isset($arrUrl[2])) {
    if ($arrUrl[2] != "") {
        for ($i=2; $i < count($arrUrl); $i++) { 
            $params .= $arrUrl[$i]. ',';
        }
        $params = trim($params, ',');
    }
}
require_once("libraries/core/Autoload.php");
require_once("libraries/core/Load.php");
?>
