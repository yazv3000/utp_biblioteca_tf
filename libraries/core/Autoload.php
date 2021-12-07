<?php
// Autoloder carga de forma automática las clases utilizadas.
// Cada vez que se intenta inicializar una clase y esta no existe, se pasas su nombre al autoloader y este es ejecutado.
spl_autoload_register(function ($class) {
    if (file_exists("libraries/".'core/'.$class.'.php')) {
        require_once("libraries/".'core/'.$class.'.php');
    }
});
?>