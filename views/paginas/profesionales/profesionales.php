<main>
    <h2 class="profesionales__encabezado"><?php echo $titulo; ?></h1>
    <p class="profesionales__descripcion">Conoce a los todos los profesionales registrados actualmente</p>

    <div class="profesionales__registro">
        <p class="profesionales__texto-registro">
            ¿Eres un profesional y quieres trabajar con nosotros? 
        </p>
        <a  class="profesionales__enlace" href="/profesionales/registro-profesionales"> Regístrate </a>
    </div>

    <div class="formulario__campo-buscador">
        <label for="profesionales" class="formulario__label">Buscador</label>
        <input
            type="text"
            class="formulario__input"
            id="profesionales"
            placeholder="Busca profesional por nombre, apellido, provincia, disciplina o tag"
        >
        
    </div>

    <div class="profesionales__grid">
    <?php foreach($profesionales as $profesional) { ?>
        <div class="profesional" id="profesionalId=<?php echo $profesional->id; ?>">
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

                <ul class="profesional__listado-tags">
                    <?php 
                        $tags = explode(',', $profesional->tags); 
                        foreach ($tags as $tag) { ?>
                            <li class="profesional__tag">
                                <?php echo $tag; ?>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    </div>
</main>