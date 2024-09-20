<h2 class="dashboard__encabezado"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor">
    <?php if(!empty($citas)) { ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Fecha</th>
                    <th scope="col" class="tabla__th">Hora</th>
                    <th scope="col" class="tabla__th">Profesional</th>
                    <th scope="col" class="tabla__th">Motivo</th>
                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>

            <tbody class="tabla__tbody">
                <?php foreach($citas as $cita) { ?>
                    <tr class="tabla__tr">
                        <td class="tabla__td">
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
                        <td class="tabla__td--acciones">
                            <a class="tabla__accion tabla__accion--editar" href="/admin/citas/editar?id=<?php echo $cita->id; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/citas/eliminar" class="tabla__formulario">
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
        <p class="text-center">No hay ninguna disciplina registrada aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>
