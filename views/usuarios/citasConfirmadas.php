<main class="citasResumen">
    <h2 class="citasResumen__encabezado"><?php echo $titulo; ?></h2>
    <p class="citasResumen__descripcion">Estas son todas tus citas <?php echo $nombre; ?></p>

    <div class="citasResumen__contenedor">
    <div class="citasResumen__contenedor-boton">
        <a class="citasResumen__boton" href="/usuarios/index">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php if(!empty($citas)) { ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Fecha</th>
                    <th scope="col" class="tabla__th">Hora</th>
                    <th scope="col" class="tabla__th">Profesional</th>
                    <th scope="col" class="tabla__th">Motivo de consulta</th>
                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>

            <tbody class="tabla__tbody">
                <?php foreach($citas as $cita) { ?>
                    <tr class="tabla__tr">
                        <td id="fechaCita" class="tabla__td">
                            <?php
                            $fecha=$cita->fecha; 
                            $fechaFormateada = date("d/m/Y", strtotime($fecha));
                            echo $fechaFormateada;
                            ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $cita->hora; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $cita->profesional->nombre. " ". $cita->profesional->apellido; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $cita->motivo; ?>
                        </td>
                        <td>
                            <form method="POST" action="/usuarios/citasConfirmadas/eliminar" class="tabla__formulario">
                                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                <button class="tabla__accion tabla__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No tienes ninguna cita</p>
    <?php } ?>
    <?php
        echo $paginacion;
    ?>
</div>

</main>