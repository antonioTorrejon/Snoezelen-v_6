<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información citas</legend>

    <div class="formulario__campo">
        <label for="fecha" class="formulario__label">Fecha</label>
        <input
        type="date"
        class="formulario__input"
        id="fecha"
        name="fecha"
        placeholder="Fecha cita"
        value="<?php echo $cita->fecha ?? ''; ?>"
        >
    </div>
    <div class="formulario__campo">
        <label for="hora" class="formulario__label">Hora</label>
        <input
        type="time"
        class="formulario__input"
        id="hora"
        name="hora"
        placeholder="Hora cita"
        value="<?php echo $cita->hora ?? ''; ?>"
        >
    </div>
    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre profesional</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre profesional"
        value="<?php echo $profesional->nombre. " ". $profesional->apellido; ?>"
        disabled
        >
    </div>

    <div class="formulario__campo">
        <label for="motivo" class="formulario__label">Motivo consulta</label>
        <textarea
            class="formulario__input"
            id="motivo"
            name="motivo"
            placeholder="Motivo consulta"
            rows="8"
        ><?php echo $cita->motivo; ?></textarea>
    </div>

</fieldset>