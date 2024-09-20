<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información disciplina</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre disciplina"
        value="<?php echo $disciplina->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción disciplina"
            rows="8"
        ><?php echo $disciplina->descripcion; ?></textarea>
    </div>

</fieldset>