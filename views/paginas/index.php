<h2 class="dashboard__encabezado"><?php echo $titulo; ?></h1>

<section class="terapias">
<h2 class="terapias__encabezado-inicio">Nuestras disciplinas</h2>
    <div class="disciplinas">
        <div class="disciplinas__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($disciplinas as $disciplina) { ?>
                    <div class="disciplina swiper-slide">
                        <div class="disciplina__informacion">
                            <h2 class="disciplina__nombre"><?php echo $disciplina->nombre; ?></h2>
                            <p>
                                <a class="disciplina__enlace" href="/disciplinas"><?php echo $disciplina->descripcion; ?></a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<section class="resumen">
    <div class="resumen__grid">
        <div data-aos="<?php aos_animacion();?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $profesionalesTotal; ?></p>
            <p class="resumen__texto">Profesionales</p>
        </div>
        <div data-aos="<?php aos_animacion();?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $disciplinasTotal;?></p>
            <p class="resumen__texto">Disciplinas</p>
        </div> 
        <div data-aos="<?php aos_animacion();?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $usuariosTotal;?></p>
            <p class="resumen__texto">Usuarios</p>
        </div>     
        <div data-aos="<?php aos_animacion();?>" class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $ciudadesTotal;?></p>
            <p class="resumen__texto">Ciudades</p>
        </div>             
    </div>
</section>

<section class="profesionales">
    <h2 class="profesionales__encabezado">Profesionales</h1>
    <p class="profesionales__descripcion">Conoce a nuestros profesionales</p>
    
    <div class="profesionales__grid">
        <?php foreach($profesionales_reducido as $profesional) { ?>
            <div data-aos="<?php aos_animacion();?>" class="profesional" id="profesionalId=<?php echo $profesional->id; ?>">
                <picture>
                    <source srcset="../img/profesionales/<?php echo $profesional->imagen; ?>.webp" type="/imagen/webp">
                    <source srcset="../img/profesionales/<?php echo $profesional->imagen; ?>.png" type="/imagen/png">
                    <img class="profesional__imagen" loading="lazy" width="200" height="300" src="../img/profesionales/<?php echo $profesional->imagen; ?>.png" alt="Imagen profesional">
                </picture>
                <div class="profesional__informacion">
                    <h4 class="profesional__nombre">
                        <?php echo $profesional->nombre .' '. $profesional->apellido; ?>
                    </h4>
            
                    <p class="profesional__ubicacion">
                        <?php echo $profesional->ciudad . ', ' . $profesional->provincia; ?>
                    </p>

                    <p class="profesional__disciplina">
                        <?php echo $profesional->disciplina->nombre; ?>
                    </p>

                    <nav class="profesional-sociales">
                        <?php
                            $redes = json_decode($profesional->redes);
                        ?>

                        <?php if (!empty($redes->facebook)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                <i class="fa-brands fa-facebook-f"></i>
                                <span class="profesional-sociales__ocultar">Facebook</span> 
                            </a> 
                        <?php } ?>

                        <?php if (!empty($redes->twitter)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                <i class="fa-brands fa-twitter"></i>
                                <span class="profesional-sociales__ocultar">Twitter</span>
                            </a> 
                        <?php } ?>

                        <?php if (!empty($redes->youtube)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                                <i class="fa-brands fa-youtube"></i>
                                <span class="profesional-sociales__ocultar">YouTube</span>
                            </a>
                        <?php } ?>

                        <?php if (!empty($redes->instagram)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                <i class="fa-brands fa-square-instagram"></i>
                                <span class="profesional-sociales__ocultar">Instagram</span>
                            </a> 
                        <?php } ?>

                        <?php if (!empty($redes->tiktok)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                                <i class="fa-brands fa-tiktok"></i>
                                <span class="profesional-sociales__ocultar">Tiktok</span>
                            </a> 
                        <?php } ?>

                        <?php if (!empty($redes->linkedin)) { ?>
                            <a class="profesional-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->linkedin; ?>">
                                <i class="fa-brands fa-linkedin"></i>
                                <span class="profesional-sociales__ocultar">Linkdln</span>
                            </a>
                        <?php } ?>
                    </nav>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="contenedor-boton">
        <a class="contenedor-boton__boton" href="/profesionales/profesionales">Ver más</a>
    </div>
</section>





