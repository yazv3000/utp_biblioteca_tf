<?php

$controllerFile = "controllers/".$controller.".php";

if (file_exists($controllerFile)) { // Si el controlador exite, lo requirá
    
    require_once($controllerFile);
    
    $controller = new $controller();
    
    if (method_exists($controller, $methop)) {  // Si el método exite, lo ejecutará
        $controller->{$methop}($params);
    } else {
        require_once("controllers/Error.php");  
    }                                           // Si no existe la clase de controlador o el método, cargará al archivo Error.php
} else {
    require_once("controllers/Error.php");
}

?>