<?php include_once 'views/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Eventos Próximos</h2>

        <form action="?c=evento&a=Buscar_evento" method="get" class="buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
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
                    foreach($this->model_c->Listar() as $cat):
                    ?>      
                        <option value="<?php echo $cat->id_categoria; ?>"> <?php echo $cat->categoria ?></option>
                    <?php
                    endforeach;
                        
                    ?>
                    
                </select>

                </th>
                <th>
               
                <select name="area" id="buscar_area">
                    <option value="" selected>Area</option>
                    <?php 
                        foreach($this->model_a->Listar() as $area):
                                if($ar == $area->id_area) {
                    ?>      
                            <option value= "<?php echo $area->id_area; ?>" selected> <?php echo $area->area ?></option>
                    <?php 
                                }else {           
                    ?>
                            <option value= "<?php echo $area->id_area; ?>"> <?php echo $area->area ?></option>
                    <?php                          
                                }
                        endforeach;
                    ?>
                    
                </select>
                </th>
                <th>Detalle</th>
            </tr>

        <?php  
            $total_pag = $this->model_e->Contar()
        ?>
           
        <?php foreach($this->model_e->Listar_pag() as $evento): ?>
            <tr>
                <td><?php echo $evento->titulo?></td>
                <td><?php echo $evento->publicador?></td>
                <td><?php echo $evento->categoria?></td>
                <td><?php echo $evento->area?></td>
                <td>
                    <a class="link_detalle" href= "?c=evento&a=Detalle_evento&id=<?php echo $evento->id_evento; ?>">click</a>
                </td>
            </tr>
        <?php endforeach;?>

        </table>
        
        <div class="paginador">
            <ul>
            <?php 
                if($pagina != 1) {
            ?>
                <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina - 1; ?>"><<</a></li>
            <?php 
                }

                for($i = 1; $i <= $total_pag; $i++){

                    if($i == $pagina){
                        echo '<li class="pag_seleccionada">' .$i. '</li>';
                    } else {
                        echo '<li><a href="?pagina=' .$i.'">' .$i. '</a></li>';
                    }
                }

                if($pagina != $total_pag){
            ?>
                <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                <li><a href="?pagina=<?php echo $total_pag; ?>">>|</a></li>

            <?php } ?>
            </ul>
        </div>

    </section>

<?php include_once 'modules/footer.php'; ?>