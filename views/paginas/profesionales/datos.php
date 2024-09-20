<main class="usuarios">
    <h2 class="usuarios__encabezado"><?php echo $titulo; ?></h2>
    <p class="usuarios__descripcion"> <?php echo $nombre; ?> estos son tus datos personales</p>

    <div class="datos__formulario">
        <div class="datos__contenedor-boton">
            <a class="datos__boton" href="/profesionales/index">
                <i class="fa-solid fa-circle-arrow-left"></i>
                Volver
            </a>
        </div>
        <?php
        include_once __DIR__ .'/../../templates/alertas.php';
         ?>

        <form method="POST" enctype="multipart/form-data" class="formulario"">
            <?php include_once __DIR__ . '/formulario.php'; ?>

            <input class="formulario__submit formulario__submit--registrar" type="submit" value="Guardar cambios">
        </form>
    </div>
    
</main>