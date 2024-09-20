<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Tu cuenta de usuario en Snoezelen</p>

    <?php 
        require_once __DIR__ .'/../templates/alertas.php';
    ?>

    <?php if(isset($alertas['exito'])) { ?>
        <div class="acciones--centrar">
            <a class="acciones__enlace" href="/login">Iniciar sesión</a>
        </div>
    <?php } ?>
</main>
