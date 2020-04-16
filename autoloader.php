<?php



function autoloadModel($className) {
    
    $name = explode('\\',strtolower($className));
  
    $filename = __DIR__. "/model/" . end($name) . ".php";
    
    if (is_readable($filename)) {
        require_once $filename;
    } 
}

spl_autoload_register("autoloadModel");



?>