<?php
    class Conexion{
        public function Conectar(){
            $pdo = new PDO("mysql:host=localhost:3308; dbname=spep_bd; charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
            return $pdo;
        }

    }    
?>