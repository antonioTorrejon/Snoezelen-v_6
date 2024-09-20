<h2 class="dashboard__encabezado"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor">
    <?php if(!empty($usuarios)) { ?>
        <table class="tabla">
            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Nombre</th>
                    <th scope="col" class="tabla__th">Email</th>
                    <th scope="col" class="tabla__th">Teléfono</th>
                    <th scope="col" class="tabla__th">Administrador</th>
                    <th scope="col" class="tabla__th"></th>

                    <th scope="col" class="tabla__th"></th>
                </tr>
            </thead>

            <tbody class="tabla__tbody">
                <?php foreach($usuarios as $usuario) { ?>
                    <tr class="tabla__tr">
                        <td class="tabla__td">
                            <?php echo $usuario->nombre. " ". $usuario->apellido; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $usuario->email; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo $usuario->telefono; ?>
                        </td>
                        <td class="tabla__td">
                            <?php echo ($usuario->admin) ? 'Sí' : 'No'; ?>
                        </td>
                        <td class="tabla__td--acciones">
                            <a class="tabla__accion tabla__accion--editar" href="/admin/registrados/editar?id=<?php echo $usuario->id; ?>">
                            <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/registrados/eliminar" class="tabla__formulario">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
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
        <p class="text-center">No hay ningún usuario registrado aún</p>
    <?php } ?>
</div>

<?php
    echo $paginacion;
?>