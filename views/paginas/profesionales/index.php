<main class="areaprof">
    <h2 class="areaprof__encabezado"><?php echo $titulo; ?></h1>
    <p class="areaprof__descripcion">Bienvenido/a <?php echo $nombre; ?> a tu área personal</p>

        <div class="areaprof__grid">
        <div class="areaprof__tipo">
            <div class="areaprof__icono">
                <i class="fa-regular fa-calendar-xmark iconosRegistro"></i>
            </div>
            <div class="areaprof__enlace">
                <a class="areaprof__boton" href="/profesionales/citas">Buscar citas</a>
            </div>
        </div>

        <div class="areaprof__tipo">
            <div class="areaprof__icono">
                <i class="fa-regular fa-calendar-days iconosRegistro"></i>
            </div>
            <div class="areaprof__enlace">
                <a class="areaprof__boton" href="/profesionales/citas-total">Ver Todas mis citas</a>
            </div>
        </div>

        <div class="areaprof__tipo">
            <div class="areaprof__icono">
                <i class="fa-solid fa-circle-info iconosRegistro"></i>
            </div>
            <div class="areaprof__enlace">
                <a class="areaprof__boton" href="/profesionales/datos">Datos personales</a>
            </div>
        </div>
        </div>

</main>
