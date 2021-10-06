

<section class="seccion contenedor">
    <table>

        <tr>
            <th>#</th>

            <th>Información</th>
        </tr>
        <tr>
            <td>Titulo:</td>

            <td><?php echo $evento->titulo;?></td>
        </tr>

        <tr>
            <td>Fecha de inicio:</td>

            <td><?php echo $evento->fecha_ini;?></td>
        </tr>

        <tr>
            <td>Fecha final:</td>

            <td><?php echo $evento->fecha_fin;?></td>
        </tr>

        <tr>
            <td>Publicador:</td>

            <td><?php echo $evento->publicador; ?></td>
        </tr>

        <tr>
            <td>Enlace:</td>

            <td><a href="<?php echo $evento->url;?>"><?php echo $evento->url;?></a></td>
        </tr>

        <tr>
            <td>Fecha de publicación:</td>

            <td><?php echo $evento->fecha_publ;?></td>
        </tr>

        <tr>
            <td>Número de edición:</td>

            <td><?php echo $evento->n_edicion?></td>
        </tr>

        <tr>
            <td>Pais:</td>

            <td><?php echo $evento->pais;?></td>
        </tr>

        <tr>
            <td>Descripción:</td>

            <td><?php echo $evento->descripcion;?></td>
        </tr>

    </table>

</section>