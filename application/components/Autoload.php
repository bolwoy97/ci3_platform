<?php

spl_autoload_register(function ($class_name) {
    if(strpos($class_name, 'CI_') !== false){
        return;
    }
    //echo $class_name,'<br>'; 
    $array_paths = array(
        '',
       'traits/',
   );

   foreach ($array_paths as $path) {
       $path = APPPATH . $path . $class_name . '.php';
       //echo $path,'<br>'; 
       if (is_file($path)) {
           include_once $path;
           return;
       }
   }

});