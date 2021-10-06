<?php

class Revista
{
	private $pdo;
    private $total_registro;

    public $id;
    public $titulo;
    public $editor_jefe;
    public $url;  
    public $periodo;
    public $descripcion;
    public $n_acceso;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Conexion::Conectar();     
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

			$stm = $this->pdo->prepare("SELECT * FROM revistas");
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
			$stm = $this->pdo
			          ->prepare("SELECT * FROM revistas
					  			INNER JOIN publicadores
								ON revistas.publicador_id = publicadores.id
					   			WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Contar()
	{
		try 
		{
			$stm = $this->pdo->prepare(" SELECT COUNT(*) as total_registro FROM revistas");
						
			$stm->execute();
			$total_registro = $stm->fetch(PDO::FETCH_OBJ);

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Listar_pag()
	{
		try 
		{
			$result = array();
			$por_pagina = 7;
            $pagina = 1;
			/*
            if(empty($_GET['pagina']))
                $pagina = 1;
            else
                $pagina = $_GET['pagina'];
            }*/

            $desde = ($pagina-1) * $por_pagina;
            $total_pag = ceil($total_registro / $por_pagina);

        	$stm = $this->pdo->prepare("SELECT revistas.id, titulo, publicadores.nombre, areas.nombre
										FROM revistas
										INNER JOIN publicadores
										ON revistas.publicador_id= publicadores.id
										INNER JOIN areas
										ON revistas.id = areas.id
										ORDER BY id  ASC LIMIT $desde, $por_pagina
			");
			          
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

?>