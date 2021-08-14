<?php include_once 'views/header.php'; ?>

    <section class="seccion contenedor">

        <?php
        
            $busqueda = "";
            $buscar_categoria = "";
            $buscar_area = "";
            if(empty($_REQUEST['busqueda']) && empty($_REQUEST['categoria']) && empty($_REQUEST['area'])){
                header("location: eventos.php");
            }
            if(!empty($_REQUEST['busqueda'])){
                $busqueda = strtolower($_REQUEST['busqueda']);
                $where = "ev.titulo LIKE '%$busqueda%'";
                $buscar = 'busqueda='.$busqueda;
            }
            if(!empty($_REQUEST['categoria'])){
                $buscar_categoria = $_REQUEST['categoria'];
                $where = "ev.id_categoria LIKE $buscar_categoria";
                $buscar = 'categoria='.$buscar_categoria;
            }
            if(!empty($_REQUEST['area'])){
                $buscar_area = $_REQUEST['area'];
                $where = "ev.id_area LIKE $buscar_area";
                $buscar = 'area='.$buscar_area;
            }
        ?>

        <h2>Eventos Próximos</h2>

        <form action="buscar_evento.php" method="get" class="buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
            <input type="submit" value="Buscar" class="btr_buscar">
        </form>


        <table>
            <tr>
                <th>Titulo</th>
                <th>Publicador</th>
                <th>
                <?php
                
                    $cat = 0;
                    if(!empty($_REQUEST['categoria'])){
                        $cat = $_REQUEST['categoria'];
                    }
                    
                    try {

                    require_once('includes/funciones/bd_conexion.php');
            
                    $sql = " SELECT * FROM categorias_evento ORDER BY categoria ASC; "; 
                    $resultado = $conn->query($sql);
                    } 
                    catch(Exception $e) {
                        die('Ha ocurrido un error: ' . $e->getMessage());
                    }

                ?>
                <select name="categoria" id="buscar_categoria">
                    <option value="" selected>Categoria</option>
                    <?php 
                        if($resultado > 0) {
                            while($categoria = $resultado->fetch_array(MYSQLI_ASSOC)){
                                if($cat == $categoria['id_categoria']) {
                    ?>      
                            <option value= "<?php echo $categoria['id_categoria']; ?>" selected> <?php echo $categoria['categoria'] ?></option>
                    <?php 
                                }else {           
                    ?>
                            <option value= "<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['categoria'] ?></option>
                    <?php
                            
                                }
                            }
                        }
                    ?>
                    
                </select>

                </th>
                <th>
                <?php
                
                    $ar = 0;
                    if(!empty($_REQUEST['area'])){
                        $ar = $_REQUEST['area'];
                    }
                    
                    try {

                    require_once('includes/funciones/bd_conexion.php');
            
                    $sql = " SELECT * FROM areas ORDER BY area ASC; "; 
                    $resultado = $conn->query($sql);
                    } 
                    catch(Exception $e) {
                        die('Ha ocurrido un error: ' . $e->getMessage());
                    }

                ?>
                <select name="area" id="buscar_area">
                    <option value="" selected>Area</option>
                    <?php 
                        if($resultado > 0) {
                            while($area = $resultado->fetch_array(MYSQLI_ASSOC)){
                                if($ar == $area['id_area']) {
                    ?>      
                            <option value= "<?php echo $area['id_area']; ?>" selected> <?php echo $area['area'] ?></option>
                    <?php 
                                }else {           
                    ?>
                            <option value= "<?php echo $area['id_area']; ?>"> <?php echo $area['area'] ?></option>
                    <?php
                            
                                }
                            }
                        }
                    ?>
                    
                </select>

                </th>
                <th>Detalle</th>
            </tr>

        <?php

            try {

            require_once('includes/funciones/bd_conexion.php');

            $sql_registro = " SELECT COUNT(*) as total_registro FROM eventos as ev";
                                                    
            $sql_registro .= " WHERE $where "; 

            $resultado_registro = $conn->query($sql_registro);
            $resultado_registros = $resultado_registro->fetch_array(MYSQLI_ASSOC);
            $total_registro = $resultado_registros['total_registro'];

            $por_pagina = 7; 
            
            if(empty($_GET['pagina'])){
                $pagina = 1;
            }else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_pag = ceil($total_registro / $por_pagina);

        
            $sql = " SELECT id_evento, titulo, publicador, categoria, area "; 
                        
            $sql .= " FROM eventos as ev ";
            $sql .= " INNER JOIN categorias_evento ";
            $sql .= " ON ev.id_categoria = categorias_evento.id_categoria "; 
            $sql .= " INNER JOIN publicadores";
            $sql .= " ON ev.id_publicador = publicadores.id_publicador ";
            $sql .= " INNER JOIN areas";
            $sql .= " ON ev.id_area = areas.id_area ";
            $sql .= " WHERE $where"; 
            $sql .= " ORDER BY id_evento ASC LIMIT $desde, $por_pagina ";

            $resultado = $conn->query($sql);
            } 
            catch(Exception $e) {
            die('Ha ocurrido un error: ' . $e->getMessage());
            }

        ?>


        <?php while($evento = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
            <tr>
                <td><?php echo $evento['titulo']?></td>
                <td><?php echo $evento['publicador']?></td>
                <td><?php echo $evento['categoria']?></td>
                <td><?php echo $evento['area']?></td>
                <td>
                    <a class="link_detalle" href= "#">click</a>
                </td>
            </tr>
        <?php } ?>

        </table>
        
        <?php 
        if($total_pag != 0){
        ?>
            <div class="paginador">
                <ul>
                <?php 
                    if($pagina != 1) {
                ?>
                    <li><a href="?pagina=<?php echo 1; ?>&<?php echo $buscar; ?>">|<</a></li>
                    <li><a href="?pagina=<?php echo $pagina - 1; ?>&<?php echo $buscar; ?>"><<</a></li>
                <?php 
                    }

                    for($i = 1; $i <= $total_pag; $i++){

                        if($i == $pagina){
                            echo '<li class="pag_seleccionada">' .$i. '</li>';
                        } else {
                            echo '<li><a href="?pagina=' .$i.'&'.$buscar.'">' .$i. '</a></li>';
                        }
                    }

                    if($pagina != $total_pag){
                ?>
                    <li><a href="?pagina=<?php echo $pagina + 1; ?>&<?php echo $buscar; ?>">>></a></li>
                    <li><a href="?pagina=<?php echo $total_pag; ?>&<?php echo $buscar; ?>">>|</a></li>

                <?php } ?>
                </ul>
            </div>
        <?php 
        }
        ?>               
    </section>

<?php include_once 'modules/footer.php'; ?>