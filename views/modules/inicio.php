
<section class="seccion contenedor">
    <h2>Sobre nosotros </h2>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam nemo impedit vero, temporibus nostrum, at quidem itaque numquam consectetur dolore non nobis et culpa tempora possimus doloribus velit exercitationem. Sint.
    </p>
</section>

<section class="contenedor">
  <div class="programa-evento">
    <h2>Eventos y Publicaciones más importantes de esta Semana</h2>
    
    <nav class="menu-evento">
      <?php foreach($this->model_c->Listar() as $cat):  ?>
        <a href="#<?php echo strtolower($cat->categoria); ?>">
          <i class="fas <?php echo $cat->icono; ?>" aria-hidden="true" ></i> <?php echo $cat->categoria; ?>
        </a>
      <?php endforeach;?>
    </nav>

        <?php $i = 0; ?>
        <?php foreach($this->model_e->Listar_multiple() as $evento): ?>
          <?php if( $i % 3 == 0) {?>
            <div id="<?php echo strtolower($evento->categoria); ?>" class="info-curso clearfix">
          <?php } ?>
              <div class="detalle-evento">
                <h3><?php echo utf8_encode($evento->titulo); ?></h3>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento->fecha_ini; ?></p>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento->fecha_fin; ?></p>
                <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $evento->publicador; ?></p>
                <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $evento->pais; ?></p>
                <a href="?c=evento&a=Detalle_evento&id=<?php echo $evento->id_evento; ?>" class="button float-center">Más información</a> <!--button float-rigth cambiamos a url-->
              </div>
              
          <?php if($i % 3 == 2 ): ?> 
            </div>
          <?php endif; ?>
        <?php $i++; ?>
        <?php endforeach; ?>
  </div>
</section>

<section class="orgs seccion contenedor">
  <h2>Editores u Organizadores </h2>

  <ul class="lista-orgs clearfix">
    <?php foreach($this->model_p->Listar() as $pub): ?>
      <li>
        <div class="org">
          <img src="views/img/publicadores/<?php echo $pub->imagen ?>" alt="img publicador">
          <p> <?php echo $pub->publicador?></p>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

</section>

<div class="contador parallax">
  <div class="contenedor">
    <ul class="resumen-evento clearfix">
      <li><p class="numero">12</p>Workshop</li>
      <li><p class="numero">23</p>Conferencias</li>
      <li><p class="numero">53</p>Simposios</li>
      <li><p class="numero">53</p>Revistas</li>
    </ul>
  </div>
</div>

