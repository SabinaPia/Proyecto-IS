<?php include_once 'modules/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Revistas</h2>

        <form action="?c=evento&a=Buscar_revista" method="get" class="buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btr_buscar">
        </form>

        <table>
            <tr>
                <th>Titulo</th>
                <th>Publicador</th>
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
            $total_pag = $this->model_r->Contar()
        ?>
           
        <?php foreach($this->model_r->Listar_pag() as $revista): ?>
            <tr>
                <td><?php echo $revista->titulo?></td>
                <td><?php echo $revista->publicador?></td>
                <td><?php echo $revista->area?></td>
                <td>
                    <a class="link_detalle" href= "?c=revista&a=Detalle_revista&id=<?php echo $revista->id_revista; ?>">click</a>
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