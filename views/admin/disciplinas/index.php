<h2 class="dashboard__encabezado"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/disciplinas/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir disciplina
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($disciplinas)) { ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Nombre</th>
                    <th scope="col" class="tabla__th">Descripción</th>
                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>

            <tbody class="tabla__tbody">
                <?php foreach($disciplinas as $disciplina) { ?>
                    <tr class="tabla__tr">
                        <td class="tabla__td">
                            <?php echo $disciplina->nombre; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $disciplina->descripcion; ?>
                        </td>
                        <td class="tabla__td--acciones">
                            <a class="tabla__accion tabla__accion--editar" href="/admin/disciplinas/editar?id=<?php echo $disciplina->id; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/disciplinas/eliminar" class="tabla__formulario">
                                <input type="hidden" name="id" value="<?php echo $disciplina->id; ?>">
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