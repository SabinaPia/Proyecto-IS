<?php
    require_once 'modelos/conexion.php';


    if(!isset($_REQUEST['c']))
    {
        require_once "controladores/inicio.controlador.php";
        $controlador = new InicioControlador();
        call_user_func(array($controlador, "irInicio" ));  
    }
    else
    {
        
        $controlador = strtolower($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'irInicio';
        
        require_once "controladores/$controlador.controlador.php";
        $controlador = ucwords($controlador)."Controlador";
        $controlador = new $controlador; 
        call_user_func(array($controlador, $accion));

    }
    
?> 