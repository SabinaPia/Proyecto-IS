<?php
require_once 'modelos/evento.php';

class EventoControlador{
    
    private $model_e;
    
    public function __CONSTRUCT(){

        $this->model_e = new Evento();
 
    }
    
    public function irEventos(){

        require_once 'vistas/header.php';
        require_once 'vistas/modulos/eventos.php';
        require_once 'vistas/footer.php';
        
    }

    public function irEvento(){

        $evento = new Evento();

        if(isset($_REQUEST['id'])){
            $evento = $this->model_e->mostrarEvento($_REQUEST['id']);
        }

        require_once 'views/header.php';
        require_once 'views/modulos/detalle_evento.php';
        require_once 'views/footer.php';
        
    }

    public function Buscar_evento(){
        require_once 'views/header.php';
        require_once 'views/modulos/buscar_evento.php';
        require_once 'views/footer.php';
        
    }

    
}