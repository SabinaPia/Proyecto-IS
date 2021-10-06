<?php
require_once 'modelos/evento.php';


class InicioControlador{
    
        private $model_e;
    
    public function __CONSTRUCT(){

        $this->model_e = new Evento(); 

    }
    
    public function irInicio(){
        
        require_once 'vistas/header.php';
        require_once 'vistas/modulos/inicio.php';
        require_once 'vistas/footer.php';
       
    }
}
?>