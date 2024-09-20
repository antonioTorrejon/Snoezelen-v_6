<main class="usuarios">
    <h2 class="usuarios__encabezado"><?php echo $titulo; ?></h2>
    <p class="usuarios__descripcion">Bienvenido/a <?php echo $nombre; ?> a tu área personal</p>

    <div class="usuarios__grid">
        <div class="usuarios__tipo">
            <div class="usuarios__icono">
                <i class="fa-regular fa-calendar-days iconosRegistro"></i>
            </div>
            <div class="usuarios__enlace">
                <a class="usuarios__boton" href="/citas/index">Nueva cita</a>
            </div>
        </div>

        <div class="usuarios__tipo">
            <div class="usuarios__icono">
                <i class="fa-regular fa-calendar-xmark iconosRegistro"></i>
            </div>
            <div class="usuarios__enlace">
                <a class="usuarios__boton" href="/usuarios/citasConfirmadas">Ver mis citas</a>
            </div>
        </div>

        <div class="usuarios__tipo">
            <div class="usuarios__icono">
                <i class="fa-solid fa-circle-info iconosRegistro"></i>
            </div>
            <div class="usuarios__enlace">
                <a class="usuarios__boton" href="/usuarios/datos">Datos personales</a>
            </div>
        </div>
     </div>

</main>