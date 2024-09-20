<main class="authprof">
    <h2 class="authprof__encabezado"><?php echo $titulo; ?></h2>
    <p class="authprof__descripcion">Introduce un nuevo password</p>

    <?php 
        require_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <?php if($token_valido) { ?>
        <form method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="password" class="formulario_label">Nuevo password</label>
                <input 
                type="password"
                class="formulario__input"
                placeholder="Introduce tu nuevo password"
                id="password"
                name="password"
                >
            </div>

            <input type="submit" class="formulario__submit" value="Guardar password">
        </form>
    <?php } ?>

    <div class="acciones">
        <a class="acciones__enlace" href="/profesionales/login-profesionales">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/profesionales/registro-profesionales">¿Aún no tienes cuenta? Obtener una</a>

    </div>
</main>