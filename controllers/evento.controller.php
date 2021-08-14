<?php
require_once 'models/evento.php';
require_once 'models/area.php';
require_once 'models/categoria.php';
require_once 'models/publicador.php';

class eventoController{
    
        private $model_e;
    
    public function __CONSTRUCT(){
        $this->model_e = new Evento();
        $this->model_a = new Area();
        $this->model_c = new Categoria();
        $this->model_p = new Publicador();
   
    }
    
    public function Index(){
        require_once 'views/header.php';
        require_once 'views/modules/inicio.php';
        require_once 'views/footer.php';
       
    }
    
    public function Ver_evento(){
        require_once 'views/header.php';
        require_once 'views/modules/eventos.php';
        require_once 'views/footer.php';
        
    }
    public function Detalle_evento(){
        $evento = new Evento();

        if(isset($_REQUEST['id'])){
            $evento = $this->model_e->Obtener($_REQUEST['id']);
        }

        require_once 'views/header.php';
        require_once 'views/modules/detalle_evento.php';
        require_once 'views/footer.php';
        
    }

    public function Buscar_evento(){
        require_once 'views/header.php';
        require_once 'views/modules/buscar_evento.php';
        require_once 'views/footer.php';
        
    }

    
}