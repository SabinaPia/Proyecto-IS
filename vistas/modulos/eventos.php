
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
                        <option value="<?php echo $cat->id; ?>"> 
                        <?php echo $cat->nombre ?></option>
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
                                if($ar == $area->id) 
                                {
                    ?>      
                                    <option value= "<?php echo $area->id; ?>" selected> 
                                    <?php echo $area->area ?></option>
                    <?php 
                                }
                                else 
                                {           
                    ?>
                                    <option value= "<?php echo $area->id; ?>"> 
                                    <?php echo $area->nombre ?></option>
                    <?php                          
                                }
                        endforeach;
                    ?>    
                </select>
                </th>

                <th>Detalle</th>
            </tr>

            <?php foreach($this->model_e->Listar() as $evento): ?>
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
    </section>