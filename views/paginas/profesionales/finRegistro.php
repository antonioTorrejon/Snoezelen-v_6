<h2 class="authprof__encabezado"><?php echo $titulo; ?></h1>

<div class="authprof__formulario">
    <?php
        include_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <form method="POST" enctype="multipart/form-data" class="formulario"">
        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Guardar cambios">
    </form>
</div>