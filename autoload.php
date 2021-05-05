<?php 

session_start();
spl_autoload_register('autoload');

require_once('./bootstrap.php');
include('./views/includes/alert.php');

function autoload($class_name){
    $array_paths = array(
        'database/',
        'app/classes/',
        'models/',
        'controllers/'
    );
    $extension = '.php';

    foreach ($array_paths as $path){
        $fullPath = $path . $class_name . $extension;

        if(is_file($fullPath)){
            include_once $fullPath;
        }
    }
}