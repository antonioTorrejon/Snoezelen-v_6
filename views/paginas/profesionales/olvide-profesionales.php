<main class="authprof">
    <h2 class="authprof__encabezado"><?php echo $titulo; ?></h2>
    <p class="authprof__descripcion">Recupera tu acceso como profesional a Snoezelen</p>

    <?php 
        require_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <form method="POST" action="/profesionales/olvide-profesionales" class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario_label">Email</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Introduce tu email"
            id="email"
            name="email"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Enviar instrucciones">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/profesionales/login-profesionales">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/profesionales/registro-profesionales">¿Aún no tienes cuenta? Obtener una</a>

    </div>
</main>