<main class="terapias">
    <h2 class="terapias__encabezado"><?php echo $titulo; ?></h2>
    <p class="terapias__descripcion">Conoce un poco más sobre las disciplinas disponibles actualmente</p>
   
    <div id="disciplinas" class="disciplinas">
        <div class="disciplinas__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($disciplinas as $disciplina) { ?>
                    <div class="disciplina swiper-slide">
                        <div class="disciplina__informacion" data-id-disciplina="<?php echo $disciplina->id; ?>">
                            <h2 class="disciplina__nombre"><?php echo $disciplina->nombre; ?></h2>
                            <p class="disciplina__texto"><?php echo $disciplina->descripcion; ?></p>
                            <button class="disciplina__boton" id="botonModal" >Ver mas</button>
                            <dialog id="modal" class="disciplina__modal">
                                <h2 class="disciplina__nombre"><?php echo $disciplina->nombre; ?></h2>
                                <p><?php echo $disciplina->descripcion; ?></p>
                                <button class="disciplina__boton" id="botonCerrar">Cerrar</button>
                            </dialog>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>

<!-- <button class="disciplina__boton" id="verMas" >Ver mas</button>
    <dialog id="modal" class="disciplina__modal">
        <h2 class="disciplina__nombre"><?php echo $disciplina->nombre; ?></h2>
        <p><?php echo $disciplina->descripcion; ?></p>
        <button class="disciplina__boton" id="cerrar">Cerrar</button>
    </dialog> -->
