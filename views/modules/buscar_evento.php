<?php include_once 'views/header.php'; ?>

    <section class="seccion contenedor">

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