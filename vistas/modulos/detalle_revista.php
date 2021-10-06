
<section class="seccion contenedor">
    <table>

        <tr>
            <th>#</th>

            <th>Información</th>
        </tr>
        <tr>
            <td>Titulo:</td>

            <td><?php echo $revista->titulo;?></td>
        </tr>

        <tr>
            <td>Periodo:</td>

            <td><?php echo $revista->periodo;?></td>
        </tr>

        <tr>
            <td>Publicador:</td>

            <td><?php echo $revista->publicador; ?></td>
        </tr>

        <tr>
            <td>Enlace:</td>

            <td><a href="<?php echo $revista->url;?>"><?php echo $revista->url;?></a></td>
        </tr>

        
        <tr>
            <td>Editor en Jefe:</td>

            <td><?php echo $revista->editor_jefe;?></td>
        </tr>

        <tr>
            <td>Descripción:</td>

            <td><?php echo $revista->descripcion;?></td>
        </tr>

    </table>

</section>