<h2 class="dashboard__encabezado"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/profesionales/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir profesional
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($profesionales)) { ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Nombre</th>
                    <th scope="col" class="tabla__th">Ciudad</th>
                    <th scope="col" class="tabla__th">Provincia</th>
                    <th scope="col" class="tabla__th">Disciplina</th>
                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>

            <tbody class="tabla__tbody">
                <?php foreach($profesionales as $profesional) { ?>
                    <tr class="tabla__tr">
                        <td class="tabla__td">
                            <?php echo $profesional->nombre. " ". $profesional->apellido; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $profesional->ciudad; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $profesional->provincia; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $profesional->disciplina->nombre; ?>
                        </td>
                        <td class="tabla__td--acciones">
                            <a class="tabla__accion tabla__accion--editar" href="/admin/profesionales/editar?id=<?php echo $profesional->id; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/profesionales/eliminar" class="tabla__formulario">
                                <input type="hidden" name="id" value="<?php echo $profesional->id; ?>">
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
        <p class="text-center">No hay ningún profesional registrado aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>