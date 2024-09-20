<main class="citas">
    <h2 class="citas__encabezado"><?php echo $titulo; ?></h2>
    <p class="citas__descripcion">Sigue los pasos para concertar una cita con el profesional elegido</p>

    <div id="app">
        <nav class="citas__tabs">
            <button class="citas__boton citas__boton-actual" type="button" data-paso="1">Profesionales</button>
            <button class="citas__boton" type="button" data-paso="2">Información cita</button>
            <button class="citas__boton" type="button" data-paso="3">Resumen y verificación</button>
        </nav>

        <div id="paso-1" class="seccion">
            <div class="citas__contenedor-boton">
                <a class="citas__boton-volver" href="/usuarios/index">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                Volver
                </a>
            </div>
            <p class="citas__descripcion">Selecciona el profesional elegido</p>

            <div class="formulario__campo-buscador">
                <label for="profesionales" class="formulario__label">Buscador</label>
                <input
                type="text"
                class="formulario__input"
                id="buscador"
                placeholder="Busca profesional por nombre, apellido, provincia o disciplina"
                >
            </div>
            <div id="profesionales" class="citas__listado-profesionales">
                <?php foreach ($profesionales as $profesional) { ?>
                <div class="profesional-cita" data-id-profesional="<?php echo $profesional->id; ?>">
                    <p class="profesional-cita__disciplina"><?php echo $profesional->disciplina->nombre; ?></p>
                    <div>
                        <picture class="profesional-cita__contenedor-imagen">
                            <source srcset="../img/profesionales/<?php echo $profesional->imagen; ?>.webp" type="/imagen/webp">
                            <source srcset="../img/profesionales/<?php echo $profesional->imagen; ?>.png" type="/imagen/png">
                            <img class="profesional-cita__imagen-profesionales" loading="lazy" width="200" height="300" src="../img/profesionales/<?php echo $profesional->imagen; ?>.png" alt="Imagen profesional">
                        </picture>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>

        <div id="paso-2" class="seccion">
            <p class="citas__descripcion">Revisa tus datos y elige fecha y hora</p>
            <?php include_once __DIR__ . '/formulario.php'; ?>
        </div>

        <div id="paso-3" class="seccion">
            <p class="citas__descripcion">Verifica que la información es correcta y confirma tu cita</p>
            <div class="citas__contenedor-resumen">
            <div class="citas__resumen-cita"></div>
            </div>
        </div>
    </div>
</main>
