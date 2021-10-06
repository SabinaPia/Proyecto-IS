<?php
require_once "conexion.php";

class Area
{
	private $conexion;
    
    public $id;
    public $nombre;

	public function __CONSTRUCT()
	{ 
		try
		{
			$this->$conexion = new MysqlConexion();   
			$conexion->Conectar();   
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->conexion->prepare("SELECT * FROM areas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->conexion
			          ->prepare("SELECT * FROM areas WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}

?>