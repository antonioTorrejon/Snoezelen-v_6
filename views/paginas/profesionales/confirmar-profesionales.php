<main class="authprof">
    <h2 class="authprof__encabezado"><?php echo $titulo; ?></h2>
    <p class="authprof__descripcion">Tu cuenta de profesional en Snoezelen</p>

    <?php 
        require_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <?php if(isset($alertas['exito'])) { ?>
        <div class="acciones--centrar">
            <a class="acciones__enlace-prof" href="/profesionales/finRegistro?id=<?php echo $profesional->id; ?>">Finaliza tu registro</a>
        </div>
    <?php } ?>
</main>
