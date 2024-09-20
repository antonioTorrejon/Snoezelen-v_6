<main class="authprof">
    <h2 class="authprof__encabezado"><?php echo $titulo; ?></h2>
    <p class="authprof__descripcion">Inicia tu sesión como profesional en Snoezelen</p>

    <?php 
        require_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <form method="POST" action="/profesionales/login-profesionales" class="formulario">
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
        <div class="formulario__campo">
            <label for="password" class="formulario_label">Password</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Introduce tu contraseña"
            id="password"
            name="password"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar sesión">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/profesionales/registro-profesionales">¿Aún no tienes cuenta? Obtener una</a>
        <a class="acciones__enlace" href="/profesionales/olvide-profesionales">¿Olvidaste tu contraseña?</a>
    </div>
</main>