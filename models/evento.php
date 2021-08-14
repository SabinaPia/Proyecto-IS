<?php
class Evento
{
	private $pdo;
	private $total_registro;
    
    public $id;
    public $titulo;
    public $fecha_ini;
    public $fecha_fin;  
    public $fecha_publ;
    public $url;
    public $n_acceso;
    public $n_edicion;
    public $pais;

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

			$stm = $this->pdo->prepare("SELECT * FROM eventos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar_multiple()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT id_evento, titulo, fecha_ini, fecha_fin, pais,
										categoria, publicador
										FROM eventos
										INNER JOIN categorias_evento
										ON eventos.id_categoria = categorias_evento.id_categoria
										INNER JOIN publicadores
										ON eventos.id_publicador = publicadores.id_publicador
										AND eventos.id_categoria = 1 
										ORDER BY id_evento LIMIT 3;

										SELECT id_evento, titulo, fecha_ini, fecha_fin, pais, 
                  						categoria, publicador
										FROM eventos
										INNER JOIN categorias_evento
										ON eventos.id_categoria = categorias_evento.id_categoria
										INNER JOIN publicadores
										ON eventos.id_publicador = publicadores.id_publicador
										AND eventos.id_categoria = 2 
										ORDER BY id_evento LIMIT 3;

										SELECT id_evento, titulo, fecha_ini, fecha_fin, pais, 
                  						categoria, publicador
										FROM eventos
										INNER JOIN categorias_evento
										ON eventos.id_categoria = categorias_evento.id_categoria
										INNER JOIN publicadores
										ON eventos.id_publicador = publicadores.id_publicador
										AND eventos.id_categoria = 3
										ORDER BY id_evento LIMIT 3;");
										
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Contar()
	{
		try 
		{
			$stm = $this->pdo->prepare(" SELECT COUNT(*) as total_registro FROM eventos");
						
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

        	$stm = $this->pdo->prepare("SELECT id_evento, titulo, publicador, categoria, area
										FROM eventos
										INNER JOIN categorias_evento
										ON eventos.id_categoria = categorias_evento.id_categoria
										INNER JOIN publicadores
										ON eventos.id_publicador = publicadores.id_publicador 
										INNER JOIN areas
										ON eventos.id_area = areas.id_area
										ORDER BY id_evento ASC LIMIT $desde, $por_pagina
			");
			          
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT * FROM eventos 
										INNER JOIN publicadores
										ON eventos.id_publicador = publicadores.id_publicador
										WHERE id_evento = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}
?>