<?php

    //Solicitar archvo de declaracion de constantes
    require_once('config/config.php');
        // Archivos que se cargaran
/*
    require_once 'librerias/Core.php';
    require_once 'librerias/Controlador.php';
    
*/
    spl_autoload_register(function($clase){
        require_once('librerias/'.$clase.'.php');
    })

?>
