<?php
require_once 'configuracion/configuracion.php';

interface BDConexion{

    public function Conectar();
     
}

class MysqlConexion implements BDConexion{

    private $conexion;

    public function Conectar(){

        try{

            $this->$conexion = new PDO("mysql:host=".BD_HOST."; dbname=".BD_NOMBRE, BD_USUARIO, BD_CONTRASENA);
            $this->$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            	
            return $this->$conexion;

        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }

}    

?>