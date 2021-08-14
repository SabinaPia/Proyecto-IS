<?php include_once 'modules/header.php'; ?>

    <section class="seccion contenedor">

        <?php
            
            $busqueda = "";
            $buscar_area = "";
            if(empty($_REQUEST['busqueda']) && empty($_REQUEST['area'])){
                header("location: revistas.php");
            }
            if(!empty($_REQUEST['busqueda'])){
                $busqueda = strtolower($_REQUEST['busqueda']);
                $where = "re.titulo LIKE '%$busqueda%'";
                $buscar = 'busqueda='.$busqueda;
            }
            if(!empty($_REQUEST['area'])){
                $buscar_area = $_REQUEST['area'];
                $where = "re.id_area LIKE $buscar_area";
                $buscar = 'area='.$buscar_area;
            }
        ?>


        <h2>Revistas</h2>

        <form action="buscar_revista.php" method="get" class="buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btr_buscar">
        </form>

        <table>
            <tr>
                <th>Titulo</th>
                <th>Publicador</th>
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

            $sql_registro = " SELECT COUNT(*) as total_registro FROM revistas as re"; 
            $sql_registro .= " WHERE $where"; 

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

        
            $sql = " SELECT id_revista, titulo, publicador, area "; 
                        
            $sql .= " FROM revistas as re";
            $sql .= " INNER JOIN publicadores";
            $sql .= " ON re.id_publicador = publicadores.id_publicador ";
            $sql .= " INNER JOIN areas";
            $sql .= " ON re.id_area = areas.id_area ";
            $sql .= " WHERE $where"; 
            $sql .= " ORDER BY id_revista ASC LIMIT $desde, $por_pagina ";

            $resultado = $conn->query($sql);
            } 
            catch(Exception $e) {
            die('Ha ocurrido un error: ' . $e->getMessage());
            }

        ?>


        <?php while($revista = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
            <tr>
                <td><?php echo $revista['titulo']?></td>
                <td><?php echo $revista['publicador']?></td>
                <td><?php echo $revista['area']?></td>
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