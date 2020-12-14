<?php

// Ingresa a cada carpeta de los controlladores y hace un include de cada uno
function controller_autoload($classname){
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('controller_autoload');