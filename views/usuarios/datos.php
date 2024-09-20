<main class="daos">
    <h2 class="datos__encabezado"><?php echo $titulo; ?></h2>
    <p class="datos__descripcion">Comprueba tus datos personales <?php echo $nombre; ?></p>


<div class="datos__formulario">
    <div class="datos__contenedor-boton">
        <a class="datos__boton" href="/usuarios/index">
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
