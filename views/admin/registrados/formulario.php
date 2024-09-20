<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre usuario"
        value="<?php echo $usuario->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellidos</label>
        <input
        type="text"
        class="formulario__input"
        id="apellido"
        name="apellido"
        placeholder="Apellidos usuario"
        value="<?php echo $usuario->apellido ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">Email</label>
        <input
        type="email"
        class="formulario__input"
        id="email"
        name="email"
        placeholder="Email usuario"
        value="<?php echo $usuario->email ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="telefono" class="formulario__label">Telefono</label>
        <input
            type="tel"
            class="formulario__input"
            id="telefono"
            name="telefono"
            placeholder="Telefono usuario"
            value="<?php echo $usuario->telefono; ?>"
            >
    </div>

</fieldset>