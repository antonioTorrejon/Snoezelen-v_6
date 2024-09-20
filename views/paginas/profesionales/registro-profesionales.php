<main class="authprof">
    <h2 class="authprof__encabezado"><?php echo $titulo; ?></h2>
    <p class="authprof__descripcion">Regístrate como profesional en Snoazelen</p>


<div class="formulario">

    <?php
        include_once __DIR__ .'/../../templates/alertas.php';
    ?>

    <form method="POST" action="/profesionales/registro-profesionales" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario_label">Nombre</label>
            <input 
            type="text"
            class="formulario__input"
            placeholder="Tu nombre"
            id="nombre"
            name="nombre"
            value="<?php echo $profesional->nombre; ?>" 
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
            value="<?php echo $profesional->apellido; ?>" 
            >
        </div>

        <div class="formulario__campo">
            <label for="disciplina" class="formulario__label">Disciplina</label>
            <select class="formulario__select" 
                name="disciplinas_id" 
                id="disciplina">
                <option selected value="">-- Seleccione --</option>
                <?php foreach($disciplinas as $disciplina) { ?>
                    <option
                        class="formulario__option" 
                        <?php echo $profesional->disciplinas_id === $disciplina->id ? 'selected' : ''; ?>
                        value="<?php echo s($disciplina->id); ?>"> 
                        <?php echo s($disciplina->nombre); ?> 
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario_label">Email</label>
            <input 
            type="email"
            class="formulario__input"
            placeholder="Introduce tu email"
            id="email"
            name="email"
            value="<?php echo $profesional->email; ?>" 
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
        <a class="acciones__enlace" href="/profesionaes/login-profesionales">¿Ya tienes cuenta? Inicia sesión</a>
        <a class="acciones__enlace" href="/profesionales/olvide-profesionales">¿Olvidaste tu contraseña?</a>
    </div>



</div>

</main>




