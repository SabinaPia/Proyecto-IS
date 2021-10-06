<?php
require_once "conexion.php";

class Categoria
{
	private $conexion;
    
    public $id;
    public $nombre;
    public $icono;
 

	public function __CONSTRUCT()
	{
		try
		{
			$this->$conexion = new MysqlConexion();   
			$this->$conexion->Conectar();
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

			$stm = $this->conexion->prepare("SELECT * FROM categorias");
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
			$stm = $this->conexion->prepare("SELECT * FROM categorias WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}

?>