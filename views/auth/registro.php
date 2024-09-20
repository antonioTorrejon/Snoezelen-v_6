<main class="auth">
    <h2 class="auth__encabezado"><?php echo $titulo; ?></h2>
    <p class="auth__descripcion">Regístrate como usuario en Snoezelen</p>

    <?php 
        require_once __DIR__ .'/../templates/alertas.php';
    ?>

    <form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario_label">Nombre</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Tu nombre"
            id="nombre"
            name="nombre"
            value="<?php echo $usuario->nombre; ?>" 
            >
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario_label">Apellidos</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Tus apellidos"
            id="apellido"
            name="apellido"
            value="<?php echo $usuario->apellido; ?>" 
            >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario_label">Email</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Introduce tu email"
            id="email"
            name="email"
            value="<?php echo $usuario->email; ?>" 
            >
        </div>

        <div class="formulario__campo">
        <label for="telefono" class="formulario__label">Telefono</label>
        <input
            type="tel"
            class="formulario__input"
            id="telefono"
            name="telefono"
            placeholder="Tu telefono"
            value="<?php echo $usuario->telefono; ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario_label">Contraseña</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Introduce tu contraseña"
            id="password"
            name="password"
            >
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario_label">Repetir contraseña</label>
            <input 
            type="password"
            class="formulario__input"
            placeholder="Repite tu contraseña"
            id="password2"
            name="password2"
            >
        </div>

        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>

    <div class="acciones">
        <a class="acciones__enlace" href="/login">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/olvide">¿Olvidaste tu contraseña?</a>
    </div>
</main>