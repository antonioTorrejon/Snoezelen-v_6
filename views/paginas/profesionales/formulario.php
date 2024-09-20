<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
        type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre profesional"
        value="<?php echo $profesional->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellidos</label>
        <input
        type="text"
        class="formulario__input"
        id="apellido"
        name="apellido"
        placeholder="Apellidos profesional"
        value="<?php echo $profesional->apellido ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="email" class="formulario__label">Email</label>
        <input
        type="email"
        class="formulario__input"
        id="email"
        name="email"
        placeholder="Email profesional"
        value="<?php echo $profesional->email ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="ciudad" class="formulario__label">Ciudad</label>
        <input
        type="text"
        class="formulario__input"
        id="ciudad"
        name="ciudad"
        placeholder="Ciudad profesional"
        value="<?php echo $profesional->ciudad ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="provincia" class="formulario__label">Provincia</label>
        <input
        type="text"
        class="formulario__input"
        id="provincia"
        name="provincia"
        placeholder="Provincia profesional"
        value="<?php echo $profesional->provincia ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="codigo_postal" class="formulario__label">Código Postal</label>
        <input
        type="text"
        class="formulario__input"
        id="codigo_postal"
        name="codigo_postal"
        placeholder="Código Postal profesional"
        value="<?php echo $profesional->codigo_postal ?? ''; ?>"
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
        <label for="imagen" class="formulario__label">Imagen</label>
        <input
        type="file"
        class="formulario__input formulario__input--file"
        id="imagen"
        name="imagen"
        >
    </div>

    <?php if(isset($profesional->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/profesionales/' . $profesional->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/profesionales/' . $profesional->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/profesionales/' . $profesional->imagen; ?>.png" alt="Imagen profesional">
            </picture>
        </div>
    <?php } ?>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información extra</legend>

    <div class="formulario__campo">
        <label for="tags_input" class="formulario__label">Especialidades (separadas por comas)</label>
        <input
        type="text"
        class="formulario__input"
        id="tags_input"
        placeholder="Ej. infantil, adolescentes, geriátrica, deportiva..."
        >

        <div id="tags" class="formulario__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $profesional->tags ?? ''; ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Redes sociales</legend>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[facebook]"
            placeholder="Facebook"
            value="<?php echo $redes->facebook ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[twitter]"
            placeholder="Twitter"
            value="<?php echo $redes->twitter ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[youtube]"
            placeholder="Youtube"
            value="<?php echo $redes->youtube ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[instagram]"
            placeholder="Instagram"
            value="<?php echo $redes->instagram ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[tiktok]"
            placeholder="TikTok"
            value="<?php echo $redes->tiktok ?? ''; ?>"
            >
        </div>
    </div>

    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-linkedin"></i>
            </div>
            <input
            type="text"
            class="formulario__input--sociales"
            name="redes[linkedin]"
            placeholder="Linkedln"
            value="<?php echo $redes->linkedin ?? ''; ?>"
            >
        </div>
    </div>

</fieldset>