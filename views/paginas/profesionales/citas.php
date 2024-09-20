<main class="citasResumen">
    <h2 class="citasResumen__encabezado"><?php echo $titulo; ?></h2>
    <p class="citasResumen__descripcion">Estas son todas tus citas <?php echo $nombre; ?></p>

    <div class="citasResumen__contenedor">
    <div class="citasResumen__contenedor-boton">
        <a class="citasResumen__boton" href="/profesionales/index">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <div id="app">

            <div class="busqueda">
                <form class="formulario">
                    <div class="formulario__campo">
                        <label for="fecha-filtro" class="formulario__label">Buscar citas por fecha</label>
                        <input 
                        type="date"
                        class="formulario__input"
                        name="fecha-filtro" 
                        id="fecha-filtro"
                        value="<?php echo $fecha; ?>"
                        >
                    </div>
                </form>
            </div>

            <?php
                if(count($citas) === 0){
                    echo "<h2>No hay citas para la fecha seleccionada</h2>";
                }
            ?>

            <div class="citas__contenedor">
                <ul class="citas__listado">
                    <?php foreach ($citas as $cita) { ?>
                        <?php if($cita->profesionalId === $_SESSION['id']) { ?>
                            <h3 class="citas__encabezado--citas">Citas en la fecha seleccionada</h3>
                            <li class="citas__li">
                                <p>ID: <span><?php echo $cita->id; ?></span></p>
                                <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                                <p>Paciente: <span><?php echo $cita->paciente; ?></span></p>
                                <p>Email: <span><?php echo $cita->email; ?></span></p>
                                <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                                <p>Motivo consulta:</p>
                                <span><?php echo $cita->motivo; ?></span>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div id="paso-2" class="seccion">
            <h2 class="citas__encabezado">Mis horarios</h2>
            <p class="citas__descripcion">Comprueba tu disponibilidad horaria</p>
        </div>

        <div id="paso-3" class="seccion">
            <h2 class="citas__encabezado">Mis datos personales</h2>
            <p class="citas__descripcion">Comprueba y edita tus datos personales</p>
        </div>
    </div>
</main>