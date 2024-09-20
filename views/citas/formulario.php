<form class="formulario citas__formulario">
    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">Nombre</label>
            <input
                class="formulario__input"
                id="nombre"
                type="text"
                placeholder="Tu nombre"
                value="<?php echo $nombre . " " . $apellido; ?>"
                disabled
                >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="email">Email</label>
            <input
                class="formulario__input"
                id="email"
                type="email"
                placeholder="Tu email"
                value="<?php echo $email; ?>"
                disabled
                >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="fecha">Fecha</label>
            <input
                class="formulario__input"
                id="fecha"
                type="date"
                min="<?php echo date('Y-m-d', strtotime('+3 day')); ?>"
                >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="hora">Hora</label>
            <input
                class="formulario__input"
                id="hora"
                type="time"
                >
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Motivo consulta</label>
        <textarea class="formulario__input" id="motivo" placeholder="Motivo consulta" rows="8"></textarea>
    </div>
    <input type="hidden" id="idUsuario" value="<?php echo $id; ?>">
    
</form>