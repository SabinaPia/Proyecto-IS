<?php
require_once 'models/revista.php';
require_once 'models/area.php';
require_once 'models/publicador.php';
class revistaController{
    
    private $model_r;
    
    public function __CONSTRUCT(){
        $this->model_r = new Revista();
        $this->model_a = new Area();
        $this->model_p = new Publicador();
    }
    
    public function Index(){
        require_once 'views/header.php';
        require_once 'views/modules/inicio.php';
        require_once 'views/footer.php';
       
    }
    
    public function Ver_revista(){
        $revista = new Revista();

        require_once 'views/header.php';
        require_once 'views/modules/revistas.php';
        require_once 'views/footer.php';
    }

    public function Detalle_revista(){
        $revista = new Revista();

        if(isset($_REQUEST['id'])){
            $revista = $this->model_r->Obtener($_REQUEST['id']);
        }
        require_once 'views/header.php';
        require_once 'views/modules/detalle_revista.php';
        require_once 'views/footer.php';
        
    }

    public function Buscar_revista(){
        $cliente = new Revista();

        require_once 'views/header.php';
        require_once 'views/modules/buscar_revistar.php';
        
    }
    
}