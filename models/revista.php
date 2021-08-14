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
								ON revistas.id_publicador = revistas.id_publicador
					   			WHERE id_revista = ?");
			          

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

        	$stm = $this->pdo->prepare("SELECT id_revista, titulo, publicador, area
										FROM revistas
										INNER JOIN publicadores
										ON revistas.id_publicador = publicadores.id_publicador 
										INNER JOIN areas
										ON revistas.id_area = areas.id_area
										ORDER BY id_revista ASC LIMIT $desde, $por_pagina
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